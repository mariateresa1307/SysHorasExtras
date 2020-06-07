<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


use ControlHorasExtras\PHP_MVC\Models\Home;

class HomeController
{

    
    public function indexAction($req, $res, $service, $app){

        
        return $app->twig->render('home/index.html', $data);
    }
}

?>