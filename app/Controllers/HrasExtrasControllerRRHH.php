<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use ControlHorasExtras\PHP_MVC\Models\Departamento;
use ControlHorasExtras\PHP_MVC\Models\RegistroAsistenciaMensual;


class HrasExtrasControllerRRHH{

    public function rrhh($req, $res, $service, $app){
        $registroAsistenciaMensual = new RegistroAsistenciaMensual();

        $departamento = new Departamento();

        $data = $req->params();
        $registros = [];
        $annoActual = date("Y");
        $departamentoID= null;
        
        if(!empty($data["anno"])){
            $annoActual = $data["anno"];
        }

        if(!empty($data["departamento"])){
            $departamentoID = $data["departamento"];
        }
        

        $temp = $registroAsistenciaMensual->obtenerTodoPorAnnoYDEpartamento($annoActual, $departamentoID);
        if(!empty($temp)){
            $registros = $temp;
        }

        $selectValues = [
            "anno" =>  $annoActual,
            "dpto" => $departamentoID
        ];



        $data = [
            "title" => "Horas Extras",
            "base_url" => $app->base_url,
            "departamento" => $departamento->obtenerTodo(),
            "registro_mensual" => $registros ,
            "annos_existentes" => $registroAsistenciaMensual->obtenerSoloLosAnnosExistentes(),
            "selectValues" => $selectValues
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


    public function aprobarRegistro($req, $res, $service, $app){
        $data = $req->params();
        $registroAsistenciaMensual = new RegistroAsistenciaMensual();
        $registroAsistenciaMensual->aprobarRRHH($data["id"], $data["estado"]);
        return $res->code(200);
    }
    
}

?>