<?php

use \Klein\Klein;

use \ControlHorasExtras\PHP_MVC\Controllers\UserController;
use \ControlHorasExtras\PHP_MVC\Controllers\LoginController;
use \ControlHorasExtras\PHP_MVC\Controllers\HomeController;
use \ControlHorasExtras\PHP_MVC\Controllers\HorasController;

/** 
 *  Preparar la URL base del proyecto para el sistema de rutas.
 *  Solo elimina el protocolo, dominio y puerto del string.
 */
$config = json_decode(file_get_contents("../config.json"), true);
$base_url = preg_replace("/http.*(\d\d\d)/", "", $config["base_url"]);


/**
 * Instanaciar las clases usadas 
 */
$router = new Klein();
$userCtrl = new UserController();
$loginCtrl = new LoginController();
$homeCtrl = new HomeController();
$horasCtrl = new HorasController();

$router->respond(function ($request, $response, $service, $app) use ($router) {
    $app->register('twig', function () {
        $loader = new Twig_Loader_Filesystem('./');
        return new Twig_Environment($loader);
    });
});



$router->respond("{$base_url}/assets/[*]", function($request, $response, $service, $app) {
    $dir = preg_replace("/^\/.*assets/", "", $request->pathname());
    return $response->file("../public/assets/{$dir}");
});



/**
 * Definicion de rutas
 */
$router->respond('GET', "{$base_url}/test", [$userCtrl, 'indexAction']);
$router->respond('GET', "{$base_url}/login", [$loginCtrl, 'indexAction']);
$router->respond('GET', "{$base_url}/home", [$homeCtrl, 'indexAction']);
$router->respond('GET', "{$base_url}/horas", [$horasCtrl, 'indexAction']);

# 404 Not Found
// Using exact code behaviors via switch/case
$router->onHttpError(function ($code, $router) {
    switch ($code) {
        case 404:
            $router->response()->body(
                'Pagina no encontrada'
            );
            break;
        case 405:
            $router->response()->body(
                'NO puedes hacer eso!'
            );
            break;
        default:
            $router->response()->body(
                'ocurrio un error '. $code
            );
    }
});



$router->dispatch();


?>