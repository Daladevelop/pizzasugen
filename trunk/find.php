<?php
	require_once('apps/loader.php');
	
	if(isset($_GET['lat'], $_GET['lng']) && is_numeric($_GET['lat']) && is_numeric($_GET['lng'])) {
		$latitude= $_GET['lat'];
		$longitude = $_GET['lng'];
		
		$key = str_replace('.', '', round($latitude, 2) . round($longitude, 2));
		$file = 'search/' . $key . '.html';
		
		if(!file_exists($file) || filemtime($file) - time() > 86400) {
			$spots = find_spots($latitude, $longitude);
			
			$html = '<div class="section result">';
			
			if (count($spots)>0) {
				$html .= 'Vi hittade ' . count($spots) . ' pizzerior i din närhet.<ul>';
			
				foreach($spots as $spot) {
					$html .= '<li class="pizzeria"><a href="'. $spot->getURL() .'">'. $spot->getName() .'</a>, cirka ' . $spot->getDistance() . ' meter ifrån dig.</li>';
				}
			
				$html .= '</ul>';
			} else {
				$html .= 'Kunde inte hitta några pizzerior i din närhet. Ta en banan, och var glad.';
			}
			
			$html .= '</div>';
			
			$handle = fopen($file, 'w');
			$header = get_html_header();
			$footer = get_html_footer();
			fwrite($handle, $header.$html.$footer );
			
		}
		
		$response['spots'] = count($spots);
		$response['key'] = $key;
		
		echo json_encode($response);
	}
?>