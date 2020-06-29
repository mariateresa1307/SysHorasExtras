<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


use ControlHorasExtras\PHP_MVC\Models\User;

class UserController{

    public function indexAction($req, $res, $service, $app){
        


        
        $user = new User();
        
        $data = [
            "title" => "Usuarios",
            "usuarios" => $user->getAll(),
            "base_url" => $app->base_url
        ];

        
        return $service->render('user/index.phtml', $data);
    }
}

?>