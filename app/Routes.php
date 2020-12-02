<?php

use \Klein\Klein;

use \ControlHorasExtras\PHP_MVC\Controllers\UserController;
use \ControlHorasExtras\PHP_MVC\Controllers\LoginController;
use \ControlHorasExtras\PHP_MVC\Controllers\FuncionarioController;
use \ControlHorasExtras\PHP_MVC\Controllers\HomeController;
use \ControlHorasExtras\PHP_MVC\Controllers\HrasExtrasController;
use \ControlHorasExtras\PHP_MVC\Controllers\ConfiguracionController;
use \ControlHorasExtras\PHP_MVC\Controllers\EstructuraController;

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
$configuracionCtrl = new ConfiguracionController();
$estructuraCtrl = new EstructuraController();
$organigramaCtrl = new EstructuraController();



$router->respond(function ($request, $response, $service, $app) use($config) {
    $app->register('base_url', function() use($config){
        return $config["base_url"];
    });
});

$router->respond("{$base_url}/assets/[*]", function($request, $response, $service, $app) {
    $dir = preg_replace("/^\/.*assets/", "", $request->pathname());
    return $response->file("../public/assets/{$dir}");
});


// pagina de inicio
$router->respond('GET', "{$base_url}/", function($request, $response, $service, $app) use($base_url) {
    return $response->redirect("{$base_url}/login");
});




/**
 * Definicion de rutas
 */
$router->respond('GET', "{$base_url}/login", [$loginCtrl, 'indexAction']);
$router->respond('POST', "{$base_url}/login", [$loginCtrl, 'validarLogin']);
$router->respond('POST',"{$base_url}/login/funcionario", [$loginCtrl, 'registrarMoviemientoDiario']);

$router->respond('GET', "{$base_url}/user", [$userCtrl, 'indexAction']);
$router->respond('POST', "{$base_url}/user/guardar", [$userCtrl, 'guardar']);
$router->respond('POST', "{$base_url}/user/obtnerUsuarioPorId", [$userCtrl, 'obtnerUsuarioPorId']);

$router->respond('GET', "{$base_url}/funcionario", [$funcionarioCtrl,'indexAction']);
$router->respond('POST', "{$base_url}/funcionario/guardar", [$funcionarioCtrl, 'guardar']);
$router->respond('POST', "{$base_url}/funcionario/obtnerUsuarioPorId", [$funcionarioCtrl, 'obtnerFuncionarioPorId']);


$router->respond('GET', "{$base_url}/home", [$homeCtrl,'indexAction']);
$router->respond('GET', "{$base_url}/HrasExtras", [$hrasextrasCtrl,'indexAction']);
$router->respond('GET', "{$base_url}/configuracion", [$configuracionCtrl, 'indexAction']);
$router->respond('GET', "{$base_url}/misionVision", [$estructuraCtrl, 'misionAction']);
$router->respond('GET', "{$base_url}/organigrama", [$organigramaCtrl, 'organigramaAction']);
$router->respond('GET', "{$base_url}/aprobadas", [$hrasextrasCtrl, 'aprobadasAction']);
$router->respond('GET', "{$base_url}/revision", [$hrasextrasCtrl, 'revisionAction']);

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