<?php
/**
 * pizza.nu api integration
 * 
 * @package pizzasugen
 * @subpackage libraries
 * @todo Lots. 
 */

class PizzaNu {
  
  
  private $spots = array();
  
  function getCount() {
    return count($this->spots);
  }
  
  /**
   * @returns array   An array of Spot items
   */
  function getSpots() {
    return $this->spots;
  }
  
  private function getSessionKey() {
  	
	$args = array(
		'api_key' => PIZZANU_API_KEY,
		'auth_token' => md5(PIZZANU_PASSWORD),
		'method' => 'auth.getMobileSession',
		'username' => PIZZANU_USERNAME
	);
	
	$sig = $this->getSignature($args);
	
	$url = sprintf("https://pizza.nu/api/1.2/rest?%s&sig=%s", http_build_query($args), $sig);
	
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    
    $data = curl_exec($ch);

	$data = @json_decode($data, true);
		
	return is_array($data) && $data['@attributes']['status'] == "ok" ? $data['session_key'] : false;		
  }
  
  private function getSignature($args) {
	
	$request_str = '';
	foreach ($args as $key => $value) {
		$request_str .= $key . '=' . $value;
	}
		
	$sig = $request_str . PIZZANU_SECRET_KEY;
	return md5($sig);	  	
  }
  
  
  function __construct($latitude, $longitude, $radius = DEFAULT_RADIUS) {
    	    			
	$args = array(
		'api_key' => PIZZANU_API_KEY,
		'latitude' => $latitude,
		'longitude' => $longitude, 
		'max_distance' => DEFAULT_RADIUS,
		'method' => 'library.getRestaurantsByCoordinates',
		'session_key' => $this->getSessionKey()
	); // insert the actual arguments for your request in place of these example args (alphabetically sorted)
		
	$sig = $this->getSignature($args);
			
	$url = sprintf("https://pizza.nu/api/1.2/rest?%s&sig=%s", http_build_query($args), $sig);
                  
    $ch = curl_init();
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_URL, $url);
    
    $data = curl_exec($ch);
	
    $data = @json_decode($data, true);
      
    if (!is_array($data) || $data['@attributes']['status'] != "ok") {
      return false;
    }
	
	foreach ($data['restaurants']['restaurant'] as $restaurant) {
		$this->spots[] = new Spot($restaurant['@attributes']['name'], $restaurant['@attributes']['name'], $restaurant['coordinates']['latitude'], $restaurant['coordinates']['longitude'], $restaurant['distance'], "http://pizza.nu/?sida=meny&action=setPizzeria&pizzeriaId=" . $restaurant['@attributes']['id'], 0);
	}	
  }
}