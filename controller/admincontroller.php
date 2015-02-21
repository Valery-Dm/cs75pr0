<?php
	require_once('../controller/controller.php');
	
	function save_changes( $postitems, $id ){
		$file = '../controller/threeaces_changes.xml';
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
		echo $changes;
		echo '<pre>';
		var_dump($items);
		print_r($postitems); 
		echo '</pre>';
	}
?>
