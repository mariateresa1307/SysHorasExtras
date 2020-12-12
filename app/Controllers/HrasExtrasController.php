<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use \ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras\CalculoHorasExtras;
use ControlHorasExtras\PHP_MVC\Models\Funcionario;
use ControlHorasExtras\PHP_MVC\Models\RegistroAsistenciaMensual;
use ControlHorasExtras\PHP_MVC\Models\Departamento;
use DateTime;

class HrasExtrasController{



    public function coordinador($req, $res, $service, $app){
        $registroAsistenciaMensual = new RegistroAsistenciaMensual();
  $departamento = new Departamento();
        // metodos para calcula de la card 1 de fechas
        $d = new DateTime('NOW');
        $ultimoDiaDelMes = $d->format('t');
        $DiaActual = $d->format('d');
        $DiasRestantes = $ultimoDiaDelMes - $DiaActual;



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



        // metodos para gestionar estado del periodo de la card 2
        $coordinadorId=1;
        $RegistroMensual = $registroAsistenciaMensual->obtenerPeriodo($d->format('Y-m-01'), $coordinadorId);
        $EstadoPeriodo = "";

        // 1. cuando es nulo en  aprobado_coordinador y aprobado_rrhh
        // el estado es: en standby
          if (is_null($RegistroMensual[0]["aprobado_coordinador"])  &&  is_null($RegistroMensual[0]["aprobado_rrhh"]) ){
              $EstadoPeriodo = "Esperando por aprobacion";
          }

        // 2. cuando aprobado_coordinador es true
        // el; estado es "en espera de revision por RRHH"
        elseif ( $RegistroMensual[0]["aprobado_coordinador"]=="t"  &&  is_null($RegistroMensual[0]["aprobado_rrhh"]) ){
            $EstadoPeriodo = "En espera de aprobacion por RRHH";
        }
        // 3. cuando aprobado_rrhh es true
        // el estado "aprobado por RRHH"
        elseif ( $RegistroMensual[0]["aprobado_coordinador"]=="t"  && ($RegistroMensual[0]["aprobado_rrhh"]=="t") ){
            $EstadoPeriodo = "Aprobado por RRHH";
        }
        // 4. cuando aprobado_rrhh es  false
        // el estado es: "rechazdo por RRHH"
        elseif ( $RegistroMensual[0]["aprobado_coordinador"]=="t"  && ($RegistroMensual[0]["aprobado_rrhh"]=="f") ){
            $EstadoPeriodo = "Rechazado por RRHH";
        }

        $data = [
            "title" => "Horas Extras",
            "base_url" => $app->base_url,
            "registro_mensual" => $registroAsistenciaMensual->obtenerTodo(),
            "DiasRestantes"=> $DiasRestantes,
            "MesActual"=> $MapFechas[$Mes],
            "EstadoPeriodo"=>$EstadoPeriodo,
                "departamento" => $departamento->obtenerTodo(),
        ];


        return $service->render('HrasExtras_coordinador/index.phtml', $data);
    }

    public function reportesAction($req, $res, $service, $app){


        $data = [
            "title" => "Horas Extras Reportes",
            "base_url" => $app->base_url

        ];


        return $service->render('HrasExtras_coordinador/reportes.phtml', $data);
    }



}

?>
