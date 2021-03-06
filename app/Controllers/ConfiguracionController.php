<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;
use ControlHorasExtras\PHP_MVC\Models\Departamento;
use ControlHorasExtras\PHP_MVC\Models\Cargo;

class ConfiguracionController{

    public function indexAction($req, $res, $service, $app){

        $departamento = new Departamento();
        $cargo = new Cargo();
            
        $data = [
            "title" => "Configuracion",
            "base_url" => $app->base_url,
            "departamento" => $departamento->obtenerTodo(),
            "cargo" => $cargo->obtenerTodo()
        ];

        
        return $service->render('configuracion/index.phtml', $data);
    }


    public function guardarDepartamento($req, $res, $service, $app) {
        $departamento = new Departamento();

        $data = $req->params();

        if(empty($data["id"])){
            // es nuevo registro
            $departamento->guardar($data);
        }
        else{
            // es editar 
            $departamento->editar($data);
        }


        return $res->code(204);
    }



    public function guardarCargo($req, $res, $service, $app){
        $cargo = new Cargo();
        $data = $req->params();
        
        if(empty($data["id"])){
            // es nuevo registro
            $cargo->guardar($data);
        }
        else{
            // es editar 
            $cargo->editar($data);
        }


       // return $res->code(204);
    }


    public function obtnerDataDelCargo($req, $res, $service, $app){
        $cargo = new Cargo();
        $data = $req->params();

        $payload = $cargo->obtnerDataDelCargo($data["id"]);

        return $res->json($payload[0]);
    }


  
}

?>