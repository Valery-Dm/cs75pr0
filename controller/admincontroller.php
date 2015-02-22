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
		$changes = 0;
		
		// delete category if required
		if( $postitems['newcategory'] == '0' ){
			
			unset( $category[0] );
			$changes++;
			
		} else {
		
			$i = 0;
			foreach( $category->item as $item ){

				if( $postitems['name'][$i] == '0' ){
					
					// mark item for delete
					$fordelete[] = $i;
					
				} else {
					
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
					
				}
				$i++;
			}
			
			// delete marked items
			if( count($fordelete) > 0 ){
				foreach( $fordelete as $del ){
					unset( $category->item[$del] );
					$changes++;
				}
			}
			
			// rename category in the end
			if( $category->name != $postitems['newcategory'] ){
				$category->name = $postitems['newcategory'];
				$changes++;
			}
		}
		
		// pass changes counter to global array so it can be shown on the main admin's page
		$_SESSION['changes'] += $changes;
		// save file
		$xml->asXML($file);
	}
?>
