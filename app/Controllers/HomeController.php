<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


use ControlHorasExtras\PHP_MVC\Models\Home;

class HomeController
{

    
    public function indexAction($req, $res, $service, $app){

        $data = ["base_url" =>  $app->base_url];
        
        return $service->render('home/index.phtml', $data);
    }
}

?>