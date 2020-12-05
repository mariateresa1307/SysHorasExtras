<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use ControlHorasExtras\PHP_MVC\Models\Funcionario;


class FuncionarioController{

    public function indexAction($req, $res, $service, $app){

        $funcionario = new Funcionario();
      


        $data = [
            "title" => "Funcionario",
            "funcionario" => $funcionario->getAll(),
            "base_url" => $app->base_url,
            
            
        ];
        
        return $service->render('funcionario/index.phtml', $data);
    }


    public function guardar($req, $res, $service, $app) {
        $funcionario = new Funcionario();
        $data = $req->params();
     
        print_r($data);
   
        if(empty($data["id"])){


            $funcionario->guardar($data);
        }
        else{
            //$funcionario->actualizar($data);
        }

        return $res->code(200);
    }
}

?>