<?php
	require_once('../controller/controller.php');

	// will create new empty category or item
	function create_element( $id, $new ){
		global $file;
		$xml = simplexml_load_file($file);
		
		// select category or create new one
		if( $new == 'category' ){
			$category = $xml->menu->addChild('category');
			$category->addChild('name', 'Undefined Category');
		} elseif( $new == 'item' ){
			$category = $xml->menu->category[$id];
		}
		
		// create new item
		$items = $category->addChild('item');
		$item = $items->addchild('name', 'Undefined Item');
		$price = $items->addChild('price');
		$price->addChild('small', '0.00');
		$price->addChild('large', '0.00');
		
		// needs DOMDocument to save nicely formatted xml
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml->asXML());
		$dom->save($file);
	}
	
	// if any modifications have been made will write them into xml file
	function save_changes( $postitems, $id ){
		global $file;
		$xml = simplexml_load_file( $file );
		$category = $xml->menu->category[$id];
		$i = 0;
		$changes = 0;
		foreach( $category->item as $item ){
			if( $item->name != $postitems['name'][$i] ){
				$item->name = htmlspecialchars( $postitems['name'][$i] );
				$changes++;
			}
			if( $item->price->small != $postitems['small'][$i] ){
				$item->price->small = number_format( $postitems['small'][$i], 2 );
				$changes++;
			}
			if( $item->price->large != $postitems['large'][$i] ){
				$item->price->large = number_format( $postitems['large'][$i], 2 );
				$changes++;
			}
			$i++;
		}
		if( $category->name != $postitems['newcategory'] ){
			$category->name = $postitems['newcategory'];
			$changes++;
		}
		// pass changes counter to global array so it can be shown on the main admin page
		$_SESSION['changes'] += $changes;
		// save file
		$xml->asXML($file);
	}
?>
