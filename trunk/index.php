<?php
	require_once('apps/loader.php');
?>

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
	
	<div class="section result">
	<?php
		/*
			Display a list of nearby pizza places if GET['sugen'] is set.
		*/
		if (isset($_GET['sugen'])) {
			$long = $_GET['lng'];
			$lat = $_GET['lat'];
			$spots = find_spots($lat, $long);
			
			if (count($spots)>0) {
				echo 'Vi hittade ' . count($spots) . ' pizzerior i din närhet.
				<ul>';
			
				foreach($spots as $spot) {
					echo '<li class="pizzeria"><a href="'. $spot->getURL() .'">'. $spot->getName() .'</a>, cirka ' . $spot->getDistance() . ' meter ifrån dig.</li>';
				}
			
				echo '</ul>';
			} else {
				echo 'Kunde inte hitta några pizzerior i din närhet. Ta en banan, och var glad.';
			}
		}
	?>
	</div>
	
	<div class="section">
		<h2>Är du pizzasugen?</h2>
		Skicka ett tweet med hash-taggen <strong>#pizzasugen</strong> och skicka med
		geolocation-data så kommer du få ett svar som talar om vilka
		pizzerior som finns i närheten.
	</div>
</body>

</html>