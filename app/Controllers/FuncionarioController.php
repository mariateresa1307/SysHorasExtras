<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use ControlHorasExtras\PHP_MVC\Models\Funcionario;
use ControlHorasExtras\PHP_MVC\Models\Departamento;
use ControlHorasExtras\PHP_MVC\Models\Cargo;


class FuncionarioController{

    public function indexAction($req, $res, $service, $app){

        $funcionario = new Funcionario();
        $departamento = new Departamento();
        $cargo = new Cargo();

        $data = [
            "title" => "Funcionario",
            "funcionario" => $funcionario->getAll(),
            "base_url" => $app->base_url,
            "departamento" => $departamento->obtenerTodo(),
            "cargo" => $cargo->obtenerTodo()
        ];

        
        return $service->render('funcionario/index.phtml', $data);
    }


    public function guardar($req, $res, $service, $app) {
        $funcionario = new Funcionario();
        $data = $req->params();
   
        if(empty($data["id"])){
            $funcionario->guardar($data);
        }
        else{
            $funcionario->actualizar($data);
        }

        return $res->code(200);
    }



    public function obtnerCargoPorDepartamento($req, $res, $service, $app){
        $data = $req->params();
        $cargo = new Cargo();
        $result = $cargo->obtnerPorDepartamento($data["departamento"]);

        if(empty($result)) return $response->code(404);

        return $res->json($result);
    }



    public function obtnerUnoPorId($req, $res, $service, $app) {
        $data = $req->params();
        $funcionario = new Funcionario();
        $funcionarioDatos = $funcionario->obtnerUnoPorId($data["id"]);

        if(empty($funcionarioDatos)) return $res->code(404);

        return $res->json($funcionarioDatos[0]);
    }
}

?>