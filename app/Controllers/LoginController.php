<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


use ControlHorasExtras\PHP_MVC\Models\Login;

class LoginController
{

    
    public function indexAction($req, $res, $service, $app){

        
        return $app->twig->render('login/index.html', $data);
    }
}

?>