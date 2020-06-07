<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


use ControlHorasExtras\PHP_MVC\Models\User;

class UserController{

    
    public function indexAction($req, $res, $service, $app){

        $user = new User();
        
        $data = [
            "usuarios" => $user->getAll()
        ];

        return $app->twig->render('user/index.html', $data);
    }
}

?>