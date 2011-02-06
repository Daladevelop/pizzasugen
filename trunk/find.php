<?php
	require_once('apps/loader.php');
	
	if(isset($_GET['lat'], $_GET['lng']) && is_numeric($_GET['lat']) && is_numeric($_GET['lng'])) {
		$latitude= $_GET['lat'];
		$longitude = $_GET['lng'];
		$spots = find_spots($latitude, $longitude);
		
		$response['spots'] = count($spots);
		$response['key'] = str_replace('.', '', round($latitude, 2) . round($longitude, 2));
		
		echo json_encode($response);
	}
?>