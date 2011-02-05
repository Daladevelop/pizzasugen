<?php
	require_once('apps/loader.php');
	
	if(isset($_GET['lat'], $_GET['lng'])) {
		$latitude= $_GET['lat'];
		$longitude = $_GET['lng'];
		$spots = find_spots($lat, $long);
		
		$response['spots'] = count($spots);
		$response['key'] = '';
	}
?>