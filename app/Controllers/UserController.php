<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


use ControlHorasExtras\PHP_MVC\Models\User;
use ControlHorasExtras\PHP_MVC\Models\Cargo;
use ControlHorasExtras\PHP_MVC\Models\Departamento;
use ControlHorasExtras\PHP_MVC\Models\UsuarioTipo;

class UserController{




    public function indexAction($req, $res, $service, $app){
        $user = new User();
        $departamento = new Departamento();
        $usuarioTipo = new UsuarioTipo();


        $data = [
            "title" => "Usuarios",
            "usuarios" => $user->getAll(),
            "base_url" => $app->base_url,
            "departamento" => $departamento->obtenerTodo(),
            "usuarioTipo" => $usuarioTipo->obtenerTodo(),
            "usuarios_activos" => $user->contarPorEstado("true"),
            "usuarios_inactivos" => $user->contarPorEstado("false"),
            "usuarios_bloqueados" => $user->contarPorEstado("bloqueado")
        ];

        return $service->render('user/index.phtml', $data);
    }



    public function guardar($req, $res, $service, $app) {
        $user = new User();
        $data = $cedula = $req->params();

        if(empty($data["id"])){
            $user->guardar($data);
        }
        else{
            $user->actualizar($data);
        }

        return $res->code(200);
    }


    public function obtnerUsuarioPorId($req, $res, $service, $app){
        $user = new User();

        $data = $user->obtnerUnoPorId($req->params()["id"]);

        if(empty($data)) return $res->code(404); 

        return $res->json($data[0]);
    }

}

?>