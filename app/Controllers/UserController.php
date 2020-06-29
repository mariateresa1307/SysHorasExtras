<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


use ControlHorasExtras\PHP_MVC\Models\User;

class UserController{
    private $base_url;


    public function __construct(){
        $ax =  json_decode(file_get_contents("../config.json"), true);
        $this->base_url = $ax["base_url"];
    }  


    public function indexAction($req, $res, $service, $app){
        
        $user = new User();
        
        $data = [
            "usuarios" => $user->getAll(),
            "base_url" => $this->base_url
        ];

        return $service->render('user/index.phtml', $data);
    }
}

?>