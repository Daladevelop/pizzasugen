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
      
      // Only remove the item if lat/lng is provided so that we can do a new search
      if (strtotime($db_data[0]['time']) < (time() - CACHE_LIFETIME) && is_numeric($latitude) && is_numeric($longitude)) {
          
        $sql = "DELETE FROM `pizzasugen` WHERE `key` = ?";
        $statement = $pdo->prepare($sql);
        $statement->execute(array($key));
        
      } else {
        return array(
          'latitude' => $db_data[0]['latitude'], 
          'longitude' => $db_data[0]['longitude'],
          'spot_data' => unserialize($db_data[0]['spot_data'])
        );       
      }            
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

/**
 * @link http://www.codewalkers.com/c/a/Miscellaneous-Code/Calculate-Distance-Between-Two-Points/
 * @param float $lat1 
 * @param float $lon1
 * @param float $lat2
 * @param float $lon2
 * @return int Distance rounded
 */
function distance($lat1, $lon1, $lat2, $lon2) { 

  $theta = $lon1 - $lon2; 
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) + cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta)); 
  $dist = acos($dist); 
  $dist = rad2deg($dist); 
  $meters = $dist * 111189.57696; // 60 * 1.1515 * 1.609344 * 1000
  
  return round($meters);
}