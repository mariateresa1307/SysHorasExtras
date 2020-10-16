<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


class FuncionarioController{

    public function indexAction($req, $res, $service, $app){

        $data = [
            "title" => "Funcionario",
            "base_url" => $app->base_url
        ];

        
        return $service->render('funcionario/index.phtml', $data);
    }
}

?>