<?php

/**
 * Reportar todos los errores criticos de PHP
 */
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);




date_default_timezone_set('America/Caracas');


/**
 * Autoload de las clases para el correcto funcionamiento
 */

require_once __DIR__ . '/../app/Bootstrap.php';
require_once __DIR__ . '/../app/Routes.php';
?>