<?php
	function render($template, $data=array()){
		$path = __DIR__ . '/../templates/' . $template . '.php';
		if (file_exists($path))
		{
			extract($data);
			require($path);
		}
	}
	
	$xml = simplexml_load_file('../controller/threeaces.xml');
	$data = array( 
	  'company_name' => 'about/title',
	  'company_address' => 'about/address',
	  'company_phone' => 'about/phone',
	  'categories' => 'menu/category/name'
	);
	echo '<br/>';
	foreach( $data as $variable_name => $xpath ) {
		$data["$variable_name"] = $xml->xpath($xpath);
		
	}
	
?>
