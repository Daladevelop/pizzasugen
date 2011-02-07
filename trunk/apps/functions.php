<?php
function find_spots($latitude, $longitude, $radius = DEFAULT_RADIUS) {
	$spots = array();
	
	$gowalla = new Gowalla($latitude, $longitude, $radius);
	$foursquare = new Foursquare($latitude, $longitude, $radius);
	
	if($gowalla->getCount() > 0) {
		$spots = array_merge($spots, $gowalla->getSpots());
	}
	
	if($foursquare->getCount() > 0) {
		$spots = array_merge($spots, $foursquare->getSpots());
	}
	
	return $spots;
}

function get_spots($key, $latitude = null, $longitude = null) {
  
  global $pdo;

  $sql = 'SELECT * FROM `pizzasugen` WHERE `key` = ? LIMIT 1';    
  $statement = $pdo->prepare($sql);    
  
  if ($statement->execute(array($key))) {
    
    $db_data = $statement->fetchAll();
    
    if (count($db_data) > 0) {
            
      return unserialize($db_data[0]['spot_data']);
    } 
  }
  
  if (is_numeric($latitude) && is_numeric($longitude)) {
    $spots = find_spots($latitude, $longitude);
                
    $sql = 'INSERT INTO  `pizzasugen` (`key`, `spots`, `spot_data`) VALUES (?, ?, ?)';
    $statement = $pdo->prepare($sql);
    
    $statement->execute(array($key, count($spots), serialize($spots)));
    
    return $spots;      
  } else {
    return array();
  }
}

function create_key($latitude, $longitude) {
    
  $seed  = str_replace(".", "", $latitude . $longitude);
  $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
  $key   = "";

  srand($seed);
  
  for ($x = 0; $x < KEY_LENGTH; $x++) {
    $key .= $chars[ rand( 0, strlen($chars) ) ];
  }
  
  return $key;  
}
