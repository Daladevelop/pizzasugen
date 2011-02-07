<?php
	define('GOWALLA_API_KEY', 'd4c50ca60731423eb4d72d088dbe780b');
	define('GOWALLA_SECRET_KEY', 'e95feac52e744046a61fd5dacc889b3f');
	define('FOURSQUARE_ACCESS_TOKEN', 'JB0U4S3YPMPCYB0WOU04R2FP5KWGCJJAVATS3WXCZMMPMVFX');
	define('DEFAULT_RADIUS', 5000);
	define('DB_TABLE', 'pizzasugen');
	
	define('DB_HOST', 'localhost');
	define('DB_NAME', 'pizzasugen');
	define('DB_USER', 'pizzasugen');
	define('DB_PASS', '9WmlWgdlT_RabaHYMWq6bd9N');
	define('DB_PREFIX', 'ps_');
	
	require_once('libraries/spot.php');
	require_once('libraries/iSpotProvider.php');
	require_once('libraries/gowalla.php');
	require_once('libraries/foursquare.php');
	require_once('functions.php');
?>