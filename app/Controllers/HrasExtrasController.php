<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use \ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras\CalculoHorasExtras;
use ControlHorasExtras\PHP_MVC\Models\Funcionario;

class HrasExtrasController{

    public function indexAction($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras",
            "base_url" => $app->base_url
        ];

        
        return $service->render('HrasExtras/index.phtml', $data);
    }




    public function process($req, $res, $service, $app){

        $funcionario = new Funcionario();
        $calculoHorasExtras = new CalculoHorasExtras();


        $result = $funcionario->obtnerFuncionarioParaCalculo();

      


        

        
        
    }
}

?>