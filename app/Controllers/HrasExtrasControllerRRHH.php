<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use ControlHorasExtras\PHP_MVC\Models\Departamento;



class HrasExtrasControllerRRHH{

    public function rrhh($req, $res, $service, $app){

        $departamento = new Departamento();

        $data = [
            "title" => "Horas Extras",
            "base_url" => $app->base_url,
            "departamento" => $departamento->obtenerTodo()
        ];

        
        return $service->render('HrasExtras_rrhh/index.phtml', $data);
    }


    public function aprobadasAction($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras Aprobadas",
            "base_url" => $app->base_url
        ];

        
        return $service->render('HrasExtras_rrhh/aprobadas.phtml', $data);
    }

    public function revisionAction($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras en Revision",
            "base_url" => $app->base_url
        ];

        
        return $service->render('HrasExtras_rrhh/revision.phtml', $data);
    }
    
}

?>