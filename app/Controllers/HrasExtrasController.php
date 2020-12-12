<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use \ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras\CalculoHorasExtras;
use \ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras\Proceso;
use ControlHorasExtras\PHP_MVC\Models\Funcionario;
use ControlHorasExtras\PHP_MVC\Models\RegistroAsistenciaMensual;
use DateTime;

class HrasExtrasController{



    public function coordinador($req, $res, $service, $app){
        $registroAsistenciaMensual = new RegistroAsistenciaMensual();
        $data = $req->params();

        $annoActual = date("Y");
        
        if(!empty($data["anno"])){
            $annoActual = $data["anno"];
        }

        $selectValues = [
            "anno" =>  $annoActual,
        ];


        $data = [
            "title" => "Horas Extras",
            "base_url" => $app->base_url,
            "registro_mensual" => $registroAsistenciaMensual->obtenerTodo($annoActual),
            "annos_existentes" => $registroAsistenciaMensual->obtenerSoloLosAnnosExistentes(),
            "selectValues" => $selectValues
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




    public function generarDataMensual ($req, $res, $service, $app){
        $data = $req->params();

        $registroAsistenciaMensual = new RegistroAsistenciaMensual();
        $coordinadorId = 8;
        $temp = $registroAsistenciaMensual->obtenerUnoPorId($data["id"]);


        if(empty($temp)) return $res->code(404);


        $proceso = new Proceso();



        $d = new DateTime($temp[0]["tiempo_"]); 
        $mes = $d->format('m');
        $anno = $d->format('Y');

        $result = $proceso->ejecutar($mes, $anno, $coordinadorId);

        if(empty($result)) return $res->code(404);


        return $res->json($result);

        
    }
    
}

?>