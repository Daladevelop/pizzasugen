<?php
	class Spot {
		private $name;
		private $latitude;
		private $longitude;
		private $distance;
		private $url;
		private $checkins;
		
		public function __construct($name, $latitude, $longitude, $distance, $url, $checkins) {
			$this->name = $name;
			$this->latitude = $latitude;
			$this->longitude = $longitude;
			$this->distance = $distance;
			$this->url = $url;
			$this->checkins = $checkins;
		}
		
		public function getName() {
			return $this->name;
		}
		
		public function getLatitude() {
			return $this->latitude;
		}
		
		public function getLongitude() {
			return $this->longitude;
		}
		
		public function getDistance() {
			return $this->distance;
		}
		
		public function getURL() {
			return $this->url;
		}
		
		public function getCheckins() {
			return $this->checkins;
		}
	}
?>