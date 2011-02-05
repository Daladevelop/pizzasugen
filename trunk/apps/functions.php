<?php
	function find_spots($latitude, $longitude, $radius = DEFAULT_RADIUS) {
		$spots = array();
		
		$gowalla = new Gowalla($latitude, $longitude, $radius);
		$foursquare = new Foursquare($latitude, $longitude, $radius);
		
		if($gowalla->getCount() > 0) {
			array_merge($spots, $gowalla->getSpots());
		}
		
		if($foursquare->getCount() > 0) {
			array_merge($spots, $foursquare->getSpots());
		}
		
		return $spots;
	}
?>