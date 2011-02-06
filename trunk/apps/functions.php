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
	
	function get_html_header() {
		$html = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
    				<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    				<meta name="viewport" content="width=device-width" />
					<title>Pizzasugen</title>
					<link rel="stylesheet" href="styles/style.css" />
				</head>
			<body>
				<h1>#Pizzasugen?</h1>
				';
		return $html;
	}
	
	function get_html_footer() {
		$html = '
			<div class="section">
				<h2>Är du pizzasugen?</h2>
				Skicka ett tweet med hash-taggen <strong>#pizzasugen</strong> och skicka med
				geolocation-data så kommer du få ett svar som talar om vilka
				pizzerior som finns i närheten.
			</div>
		</body>
		</html>';
	}
?>