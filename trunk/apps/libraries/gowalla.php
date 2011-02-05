<?php
	class Gowalla {
		private $latitude;
		private $longitude;
		private $radius;
		private $number;
		private $spots;
		
		function __construct($latitude, $longitude, $radius) {
			// Initial values
			$this->number = 0;
			$this->spots = false;
			
			// Set Gowalla url
			$url = 'http://api.gowalla.com/spots?lat=' . $latitude . '&lng=' . $longitude . '&radius=' . $radius . '&category_id=7';
			
			// Save coordinates
			$this->latitude = $latitude;
			$this->longitude = $longitude;
			$this->radius = $radius;
			
			// Get spots with cURL
			$curl = curl_init();
			curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($curl, CURLOPT_URL, $url);
			curl_setopt($curl, CURLOPT_USERAGENT, 'GowallaAPI: 1.0/Pizzasugen w/ Curl ' . curl_version());
			curl_setopt($curl, CURLOPT_HTTPHEADER, array(
				'X-Gowalla-API-Key: ' . GOWALLA_API_KEY,
				'Content-Type: application/json',
				'Accept: application/json'
			));
			
			$data = curl_exec($curl);
			curl_close($curl);
			
			// Extact spots in category "Pizza"
			$response = json_decode($data);
			$spots = array();
			
			if(count($response->spots) > 0) {
				foreach($response->spots as $spot) {
					if($spot->spot_categories[0]->name == 'Pizza') {
						$spots[] = new Spot($spot->name, $spot->description, $spot->lat, $spot->lng, $spot->radius_meters, 'http://gowalla.com' . $spot->url, $spot->checkins_count);
					}
				}
			}
			
			// Save number of extracted spots
			$this->number = count($spots);
			
			$this->spots = $spots;
		}
		
		public function getCount() {
			return $this->number;
		}
		
		public function getSpots() {
			return $this->spots;
		}
	}
?>