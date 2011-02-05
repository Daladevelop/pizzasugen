<?php
/**
 * Foursquare api integration
 * 
 * @package pizzasugen
 * @subpackage libraries
 * @todo Lots. 
 */

class Foursquare {
  
  private $accessToken = FOURSQUARE_ACCESS_TOKEN;
  
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
  
  function __construct($latitude, $longitude, $radius = DEFAULT_RADIUS) {
        
    $url = sprintf("https://api.foursquare.com/v2/venues/search?ll=%s,%s&oauth_token=%s&limit=50&query=pizza",
            $latitude, 
            $longitude,  
            $this->accessToken);
                  
    $ch = curl_init($url);
    
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $data = curl_exec($ch);
        
    $data = @json_decode($data);
      
    if (!is_object($data) || $data->meta->code != 200) {
      return false;
    }
      
    foreach ($data->response->groups as $group) {
      
      foreach ($group->items as $item) {
    
        foreach ($item->categories as $category) {
          
          if ($category->name == "Pizza") {
            
            $this->spots[] = new Spot($item->name, 
                              $item->name, 
                              $item->location->lat, 
                              $item->location->lng, 
                              $item->location->distance, 
                              "http://foursquare.com/venue/" . $item->id,
                              $item->stats->checkinsCount);
                              
            break;
          }   
        }
      }
    }    
  }
}