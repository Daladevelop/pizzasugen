<?php

require_once('apps/loader.php');

header("Content-type: application/json");

if(isset($_GET['lat'], $_GET['lng']) && is_numeric($_GET['lat']) && is_numeric($_GET['lng'])) {
	$latitude= $_GET['lat'];
	$longitude = $_GET['lng'];
	
	$key = create_key($latitude, $longitude);
  
  $spots = get_spots($key, $latitude, $longitude);
								
	$response['spots'] = count($spots['spot_data']);
	$response['key'] = $key;
	
	echo json_encode($response);
}