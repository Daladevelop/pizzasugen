<?php
	require_once('apps/loader.php');
	
	if(isset($_GET['lat'], $_GET['lng']) && is_numeric($_GET['lat']) && is_numeric($_GET['lng'])) {
		$latitude= $_GET['lat'];
		$longitude = $_GET['lng'];
		
		$key = str_replace('.', '', round($latitude, 2) . round($longitude, 2));
		$file = 'search/' . $key . '.html';
		
		mysql_connect(DB_HOST, DB_USER, DB_PASS);
		@mysql_select_db(DB_NAME) or die('Kunde inte ansluta till databasen.');		
		$sql = 'SELECT * FROM ' . DB_PREFIX . 'pizzasugen WHERE `key`=\''.$key.'\' LIMIT 1';
		$result = mysql_query($sql);
		$result = mysql_fetch_object($result);
		if (( !method_exists($result, 'key')) || (strtotime($result->time) - time() > 86400)) {
			$spots = find_spots($latitude, $longitude);
			
			$html = '<div class="section result">';
			
			if(count($spots) > 0) {
				$html .= 'Vi hittade ' . count($spots) . ' pizzerior i din närhet.<ul>';
			
				foreach($spots as $spot) {
					$html .= '<li class="pizzeria"><a href="'. $spot->getURL() .'">'. htmlspecialchars($spot->getName()) .'</a>, cirka ' . $spot->getDistance() . ' meter ifrån dig.</li>';
				}
			
				$html .= '</ul>';
			} else {
				$html .= 'Kunde inte hitta några pizzerior i din närhet. Ta en banan och var glad.';
			}
			
			$html .= '</div>';
			
			
			
			$handle = fopen($file, 'w');
			$header = get_html_header();
			$footer = get_html_footer();
			fwrite($handle, $header . $html . $footer );
			
			$numberofspots = count($spots);
			
			$sql = 'INSERT INTO  `'.DB_NAME.'`.`'.DB_PREFIX.'pizzasugen` (`key`, `spots`, `time`) VALUES (\''.$key.'\', \''.$numberofspots.'\', CURRENT_TIMESTAMP)';
			mysql_query($sql);
			
		} else {
			$numberofspots = $result->spots;
		} 
		
		mysql_close();
		
		$response['spots'] = $numberofspots;
		$response['key'] = $key;
		
		echo json_encode($response);
	}
?>