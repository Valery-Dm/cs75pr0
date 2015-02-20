<?php
	require_once('../controller/controller.php');
	
	function save_changes($adminitems, $data=array(), $items=array()){
		echo '<pre>';
		print_r($adminitems); 
		print_r($data);
		print_r($items);
		echo '</pre>';
	}
?>
