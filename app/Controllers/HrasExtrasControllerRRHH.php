<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use ControlHorasExtras\PHP_MVC\Models\Departamento;
use ControlHorasExtras\PHP_MVC\Models\RegistroAsistenciaMensual;
use DateTime;

class HrasExtrasControllerRRHH{

    public function rrhh($req, $res, $service, $app){
        $registroAsistenciaMensual = new RegistroAsistenciaMensual();

        $departamento = new Departamento();
        $m = new DateTime('NOW');
        $Mes = $m->format('m');


        $MapFechas =[
          "1" => "Enero",
          "2" => "Febrero",
          "3" => "Marzo",
          "4" => "Abril",
          "5" => "Marzo",
          "6" => "Mayo",
          "7" => "Junio",
          "8" => "Julio",
          "9" => "Agosto",
          "10" => "Septiembre",
          "11" => "Octubre",
          "12"=> "Diciembre",
        ];

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
            "selectValues" => $selectValues,
              "MesActual"=> $MapFechas[$Mes],
                "RegistroAprobado" => $registroAsistenciaMensual->contarPorEstado("aprobado",date("m"),date("Y")),
                    "RegistroRevision" => $registroAsistenciaMensual->contarPorEstado('revision',date("m"),date("Y")),
                    "RegistroPorAprobar"=>$registroAsistenciaMensual->contarPorEstado('porAprobar',date("m"),date("Y"))
        ];

        return $service->render('HrasExtras_rrhh/index.phtml', $data);
    }


    public function reportesAction($req, $res, $service, $app){
        $departamento = new Departamento();
        $data = [
            "title" => "Horas Extras Reportes",
            "base_url" => $app->base_url,
            "departamento" => $departamento->obtenerTodo(),
        ];


        return $service->render('HrasExtras_rrhh/reportes.phtml', $data);
    }






    public function aprobarRegistro($req, $res, $service, $app){
        $data = $req->params();
        $registroAsistenciaMensual = new RegistroAsistenciaMensual();
        $registroAsistenciaMensual->aprobarRRHH($data["id"], $data["estado"]);
        return $res->code(200);
    }

}

?>