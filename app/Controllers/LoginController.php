<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use \ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras\CalculoHorasExtras;

//use ControlHorasExtras\PHP_MVC\Models\Login;
use ControlHorasExtras\PHP_MVC\Models\User;
use ControlHorasExtras\PHP_MVC\Models\Funcionario;
use ControlHorasExtras\PHP_MVC\Models\ControlAsistencia;
use ControlHorasExtras\PHP_MVC\Models\Departamento;

class LoginController{
   

    public function indexAction($req, $res, $service, $app){

        // cerrar sesion 
        if(!empty($_SESSION["id"])){
            unset($_SESSION["id"]);
        }


        
        $data = ["base_url" =>  $app->base_url];
        
        
        return $service->render('login/index.phtml', $data);
    }



    public function registrarMoviemientoDiario($req, $res, $service, $app){
        $cedula = $req->params()["cedula"];

        $funcionarioModel = new Funcionario();
        $controlAsistenciaModel = new ControlAsistencia();
        $calculoHorasExtras = new CalculoHorasExtras();
        $user = new User();
        $tiempoActual = date('Y-m-d H:i:s');
        $funcionarioData = $funcionarioModel->obtenerUnoPorCedula($cedula);

        // usuario no encontrado
        if(empty($funcionarioData)) return $res->code(404);


        
        
        $registro_padre_del_mes = $controlAsistenciaModel->obtner_registro_padre_del_mes(date('m'), date("Y"));
        
        if(empty($registro_padre_del_mes)) {
            $coordinador = $user->obtenerPorCargoId($funcionarioData[0]["cargo_id"]);
            $registro_padre_del_mes = $controlAsistenciaModel->crear_registro_padre_del_mes(date("Y-m-d"), $coordinador[0]["id"]);
        }
        
        $registro_padre = $registro_padre_del_mes[0]["id"];

  
        
        



        $data  = $controlAsistenciaModel->obtenerPorCedulayDia($cedula, date('Y-m-d'));

        // control asistencia no encontrado para este usuario en este dia.
        if(empty($data)) {
            // 1. Calcular si hay tiempo de atraso
            $tiempoAtraso = $calculoHorasExtras->determinarTiempoRetraso($tiempoActual);

            // guradr inicio asistencia 
            $controlAsistenciaModel->guardar($tiempoActual, $funcionarioData[0]["id"], $tiempoAtraso, $registro_padre);
        }
        else{
            // 1. se debe actualizar el registro de asitencia para la hora de salida.
            // 2. Calcular el tiempo extra

            if(empty($data[0]["salida"])  ){
                // caso si el atributo "salida" esta vacio. Se debe actualizar el registro

                
                $tiempoAtraso = $calculoHorasExtras->determinarTiempoExtra($tiempoActual);

                // guardar 
                $controlAsistenciaModel->actualizar($data[0]["id"], $tiempoActual, $tiempoAtraso);
            }
            else{
                // Si el atributo salida ya tiene datos notificar que ya se ha completado la jornada diaria
                return $res->code(409);
            }

        }

        // Retorna OK
        return $res->code(200);
    }


    public function validarLogin($req, $res, $service, $app){
        $data = $req->params();

        $user = new User();
        $result = $user->validarCredenciales($data["clave"], $data["cedula"]);

        if(empty($result)) return $res->code(401);


        
        $_SESSION["id"] = $result[0]["id"];


        $user->cambiarEstadoActivoinicioSesion($result[0]["id"]);


        return $res->code(200); 

    }
}

?>