<?php

require_once 'config.php';

try {
    $pdo = new PDO(DB_DSN, DB_USER, DB_PASS);
} catch (Exception $exception) {
    die("Unable to connect to the database. Please check my configuration");
}

require_once('libraries/spot.php');
require_once('libraries/iSpotProvider.php');
require_once('libraries/gowalla.php');
require_once('libraries/foursquare.php');
require_once('libraries/pizzanu.php');
require_once('functions.php');
