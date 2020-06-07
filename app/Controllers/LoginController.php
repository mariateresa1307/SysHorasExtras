<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


class LoginController{
    private $base_url;

    public function __construct(){
        $ax =  json_decode(file_get_contents("../config.json"), true);
        $this->base_url = $ax["base_url"];
    }  

   
    public function indexAction($req, $res, $service, $app){
        $data = ["base_url" =>  $this->base_url];
        
        return $app->twig->render('login/index.html', $data);
    }
}

?>