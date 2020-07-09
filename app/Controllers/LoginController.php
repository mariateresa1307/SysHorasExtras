<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


class LoginController{
   
    public function indexAction($req, $res, $service, $app){
        $data = ["base_url" =>  $app->base_url];
        
        return $app->twig->render('login/index.phtml', $data);
    }
}

?>