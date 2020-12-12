<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use ControlHorasExtras\PHP_MVC\Models\Departamento;
use ControlHorasExtras\PHP_MVC\Models\RegistroAsistenciaMensual;


class HrasExtrasControllerRRHH{

    public function rrhh($req, $res, $service, $app){
        $registroAsistenciaMensual = new RegistroAsistenciaMensual();

        $departamento = new Departamento();

        $data = [
            "title" => "Horas Extras",
            "base_url" => $app->base_url,
            "departamento" => $departamento->obtenerTodo(),
            "registro_mensual" => $registroAsistenciaMensual->obtenerTodo()
        ];


        return $service->render('HrasExtras_rrhh/index.phtml', $data);
    }


    public function reportesAction($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras Reportes",
            "base_url" => $app->base_url
        ];


        return $service->render('HrasExtras_rrhh/reportes.phtml', $data);
    }



}

?>
