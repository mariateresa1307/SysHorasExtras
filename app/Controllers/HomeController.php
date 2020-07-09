<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


use ControlHorasExtras\PHP_MVC\Models\Home;

class HomeController
{

    
    public function indexAction($req, $res, $service, $app){

        
        return $service->render('home/index.html', $data);
    }
}

?>