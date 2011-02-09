<?php
	define('GOWALLA_API_KEY', 'd4c50ca60731423eb4d72d088dbe780b');
	define('GOWALLA_SECRET_KEY', 'e95feac52e744046a61fd5dacc889b3f');
	define('FOURSQUARE_ACCESS_TOKEN', 'JB0U4S3YPMPCYB0WOU04R2FP5KWGCJJAVATS3WXCZMMPMVFX');
	define('DEFAULT_RADIUS', 5000);
  define('KEY_LENGTH', 8);
  define('CACHE_LIFETIME', 60*60*4); // Save items in DB max 4h 
	
	define('DB_USER', 'pizzasugen');
	define('DB_PASS', '9WmlWgdlT_RabaHYMWq6bd9N');
  define('DB_DSN', 'mysql:dbname=pizzasugen;host=127.0.0.1');
  
  try {
    $pdo = new PDO(DB_DSN, DB_USER, DB_PASS);    
  } catch (Exception $exception) {
    die("Unable to connect to the database. Please check my configuration");
  }
	
	require_once('libraries/spot.php');
	require_once('libraries/iSpotProvider.php');
	require_once('libraries/gowalla.php');
	require_once('libraries/foursquare.php');
	require_once('functions.php');
