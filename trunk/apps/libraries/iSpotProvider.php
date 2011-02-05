<?php

/**
 * Interface for the classes providing the spots
 * @package pizzasugen
 * @subpackage interfaces
 */

/**
 * @todo Documentation
 */ 
interface iSpotProvider {
  
  /**
   * Initialize object
   * 
   * @param float $latitude   Latitude
   * @param float $longitude  Longitude
   * @param int $radius       Search radius in meters
   */
  public function __construct($latitude, $longitude, $radius = DEFAULT_RADIUS);
  
  /**
   * Return number of search result
   * @return integer
   */
  public function getCount();
  
  /**
   * Return the found spots
   * @return array|boolean  Returns array on success and boolean on failure
   */
  public function getSpots();  
}