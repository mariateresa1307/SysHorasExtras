<?php

/**
 * Reportar todos los errores criticos de PHP
 */

/*
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


*/
session_start();
date_default_timezone_set('America/Caracas');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true");
header("Access-Control-Max-Age: 1000");
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type, Origin, Cache-Control, Pragma, Authorization, Accept, Accept-Encoding");
header("Access-Control-Allow-Methods: PUT, POST, GET, OPTIONS, DELETE");


/**
 * Autoload de las clases para el correcto funcionamiento
 */

require_once __DIR__ . '/../app/Bootstrap.php';
require_once __DIR__ . '/../app/Routes.php';
?>