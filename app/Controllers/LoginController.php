<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


use ControlHorasExtras\PHP_MVC\Models\Login;

class LoginController{
   

    public function indexAction($req, $res, $service, $app){
        
        $data = ["base_url" =>  $app->base_url];
        
        
        return $service->render('login/index.phtml', $data);
    }
}

?>