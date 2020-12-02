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


    public function guardar($req, $res, $service, $app) {
        $funcionario = new Funcionario();
        $data = $cedula = $req->params();

        if(empty($data["id"])){
            $funcionario->guardar($data);
        }
        else{
            $funcionario->actualizar($data);
        }

        return $funcionario->code(200);
    }
}

?>