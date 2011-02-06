<?php
	require_once('apps/loader.php');
	
	if(isset($_GET['lat'], $_GET['lng']) && is_numeric($_GET['lat']) && is_numeric($_GET['lng'])) {
		$latitude= $_GET['lat'];
		$longitude = $_GET['lng'];
		
		$key = str_replace('.', '', round($latitude, 2) . round($longitude, 2));
		$file = 'search/' . $key . '.html';
		
		if(!file_exists($file) || filemtime($file) - time() > 86400) {
			$spots = find_spots($latitude, $longitude);
		}
		
		$response['spots'] = count($spots);
		$response['key'] = $key;
		
		echo json_encode($response);
	}
?>