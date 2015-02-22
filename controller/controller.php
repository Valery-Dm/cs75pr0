<?php
	// call for templates, can pass some data
	function render($template, $data=array()){
		$path = __DIR__ . '/../templates/' . $template . '.php';
		if (file_exists($path))
		{
			extract($data);
			require($path);
		}
	}
	
	// create the message to be placed inside basket button
	function message(){
		if (isset($_SESSION['total']) and $_SESSION['total'] > 0) {
			$_SESSION['message'] = "Your order is $";
		} else {
			$_SESSION['message'] = 'Shopping cart is empty';
			$_SESSION['total'] = '';
		}
	}
	
	// main function for buy and recalculate
	function buy($data=array(), $recalculate=false){
		// this will be executed for buy option
		if( !$recalculate ){
			$same = false;
			// if it's not the first buy
			if( isset($_SESSION['basket']) ){
				$i = 0;
				foreach( $_SESSION['basket'] as $item ){
					// don't add existing item just change quantity
					if( $item['item'] == $data['item']
						and $item['type'] == $data['type'] ){
							$_SESSION['basket'][$i]['quantity'] += $data['quantity'];
							// set 'the same' key to true
							$same = true;
					}
					$i++;
				}
			}
			// add new items at the end of array
			if( !$same ){
				$_SESSION['basket'][] = $data;
			}
		}
		// calculate total
		$total = 0;
		foreach ($_SESSION['basket'] as $basket){
			$total += $basket['price'] * $basket['quantity'];
		}
		// set new total to session
		$_SESSION['total'] = number_format($total, 2);
		// should call it here to trigger new message on first buy
		message();
	}
	
	// function will be called by Re-calculate button in Shopping Card
	function recalculate($data=array()){
		// remove last keyword-field
		array_pop($data);
		$i = 0;
		foreach( $data as $number ){
			if( $number == 0 ){
				// delete item if its quantity set to 0
				unset($_SESSION['basket'][$i]);
			} else {
				// otherwise just change the quantity
				$_SESSION['basket'][$i]['quantity'] = $number;
			}
			$i++;
		}
		// call for actual calculation
		buy($_SESSION['basket'], true);
	}
	
	// clear session data and set initial message
	function checkout(){
		$orders_file = '../controller/orders.xml';
		$orders = simplexml_load_file($orders_file);
		
		// create new node
		$order = $orders->addChild('order');
		$order->addChild('time', time());
		$order->addChild('total', $_SESSION['total']);
		$items = $order->addChild('items');
		foreach( $_SESSION['basket'] as $index ){
			
			$items->addChild('name', htmlspecialchars($index['item']) . ': ' . $index['type']);		
			$items->addChild('quantity', $index['quantity']);
			$items->addChild('price', number_format($index['quantity'] * $index['price'], 2));	
			
		}
		
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($orders->asXML());
		$dom->save($orders_file);
		
		session_destroy();
		message();
	}
	
	
	$file = '../controller/threeaces_changes.xml';
	// extract data from xml
	$xml = simplexml_load_file($file);
	// create lines for xpath
	$data = array( 
	  'company_name' => 'about/title',
	  'company_address' => 'about/address',
	  'company_phone' => 'about/phone',
	  'categories' => 'menu/category/name',
	  'items' => 'menu/category/name'
	);
	// create data array with company info and categories names
	foreach( $data as $variable_name => $xpath ) {
		$data["$variable_name"] = $xml->xpath($xpath);
		
	}
	// create array with menu items
	while(list(,$node) = each($data['items'])){
		$items[] = $node->xpath('preceding-sibling::* | following-sibling::*');
	}
	
	// start here
	session_start();
	// initial messages
	message();
?>
