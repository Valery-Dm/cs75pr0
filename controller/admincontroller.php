<?php
	require_once('../controller/controller.php');

	function create_element( $id, $new ){
		global $file;
		$xml = simplexml_load_file($file);
		if( $new == 'category' ){
			$category = $xml->menu->addChild('category');
			$category->addChild('name', 'Undefined Category');
		} elseif( $new == 'item' ){
			$category = $xml->menu->category[$id];
		}
		$items = $category->addChild('item');
		$item = $items->addchild('name', 'Undefined Item');
		$price = $items->addChild('price');
		$price->addChild('small', '0.00');
		$price->addChild('large', '0.00');
		
		// needs $dom to save nicely formatted xml
		$dom = new DOMDocument('1.0');
		$dom->preserveWhiteSpace = false;
		$dom->formatOutput = true;
		$dom->loadXML($xml->asXML());
		$dom->save($file);
	}
	
	function save_changes( $postitems, $id ){
		global $file;
		$xml = simplexml_load_file( $file );
		$category = $xml->menu->category[$id];
		$i = 0;
		$changes = 0;
		foreach( $category->item as $item ){
			$items[] = $item;
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
		$_SESSION['changes'] += $changes;
		$xml->asXML($file);
		
		echo '<pre>';
		var_dump($items);
		print_r($postitems); 
		echo '</pre>';
		
	}
?>
