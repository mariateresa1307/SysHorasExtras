<?php

use \Klein\Klein;

use \ControlHorasExtras\PHP_MVC\Controllers\UserController;
use \ControlHorasExtras\PHP_MVC\Controllers\LoginController;
use \ControlHorasExtras\PHP_MVC\Controllers\FuncionarioController;
use \ControlHorasExtras\PHP_MVC\Controllers\HomeController;
use \ControlHorasExtras\PHP_MVC\Controllers\HrasExtrasController;
/** 
 *  Preparar la URL base del proyecto para el sistema de rutas.
 *  Solo elimina el protocolo, dominio y puerto del string.
 */
$config = json_decode(file_get_contents("../config.json"), true);
$base_url = preg_replace("/^http.*(\d\d\d)/", "", $config["base_url"]);


/**
 * Instanaciar las clases usadas 
 */
$router = new Klein();
$userCtrl = new UserController();
$loginCtrl = new LoginController();
$funcionarioCtrl = new FuncionarioController();
$homeCtrl = new HomeController();
$hrasextrasCtrl = new HrasExtrasController();

$router->respond(function ($request, $response, $service, $app) use($config) {
    $app->register('base_url', function() use($config){
        return $config["base_url"];
    });
});

$router->respond("{$base_url}/assets/[*]", function($request, $response, $service, $app) {
    $dir = preg_replace("/^\/.*assets/", "", $request->pathname());
    return $response->file("../public/assets/{$dir}");
});


/**
 * Definicion de rutas
 */
$router->respond('GET', "{$base_url}/user", [$userCtrl, 'indexAction']);
$router->respond('GET', "{$base_url}/login", [$loginCtrl, 'indexAction']);
$router->respond('GET', "{$base_url}/funcionario", [$funcionarioCtrl,'indexAction']);
$router->respond('GET', "{$base_url}/home", [$homeCtrl,'indexAction']);
$router->respond('GET', "{$base_url}/HrasExtras", [$hrasextrasCtrl,'indexAction']);

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