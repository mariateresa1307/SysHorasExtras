<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use \ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras\CalculoHorasExtras;
use ControlHorasExtras\PHP_MVC\Models\Funcionario;

class HrasExtrasController{

    public function rrhh($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras",
            "base_url" => $app->base_url
        ];

        
        return $service->render('HrasExtras_coordinador/index.phtml', $data);
    }


    public function coordinador($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras",
            "base_url" => $app->base_url
        ];

        
        return $service->render('HrasExtras_coordinador/index.phtml', $data);
    }

    public function aprobadasAction($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras Aprobadas",
            "base_url" => $app->base_url
        ];

        
        return $service->render('HrasExtras_coordinador/aprobadas.phtml', $data);
    }

    public function revisionAction($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras en Revision",
            "base_url" => $app->base_url
        ];

        
        return $service->render('HrasExtras_coordinador/revision.phtml', $data);
    }
    
}

?>