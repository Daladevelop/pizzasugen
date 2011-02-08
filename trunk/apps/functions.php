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
            
      return array(
        'latitude' => $db_data[0]['latitude'], 
        'longitude' => $db_data[0]['longitude'],
        'spot_data' => unserialize($db_data[0]['spot_data'])
      );
    } 
  }
  
  if (is_numeric($latitude) && is_numeric($longitude)) {
    $spots = find_spots($latitude, $longitude);
                
    $sql = 'INSERT INTO  `pizzasugen` (`key`, `spots`, `spot_data`, `latitude`, `longitude`, `time`) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)';
    $statement = $pdo->prepare($sql);
    
    $statement->execute(array($key, count($spots), serialize($spots), $latitude, $longitude));
    
    return array(
        'latitude' => $latitude, 
        'longitude' => $longitude,
        'spot_data' => $spots
    );      
  } else {
    return array();
  }
}

function create_key($latitude, $longitude) {
    
  $input  = str_replace(".", "", $latitude . $longitude);

  return base_convert($input, 10, 36);  
}
