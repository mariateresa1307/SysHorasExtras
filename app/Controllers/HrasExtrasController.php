<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


class HrasExtrasController{

    public function indexAction($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras",
            "base_url" => $app->base_url
        ];

        
        return $service->render('HrasExtras/index.phtml', $data);
    }
    public function aprobadasAction($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras Aprobadas",
            "base_url" => $app->base_url
        ];

        
        return $service->render('HrasExtras/aprobadas.phtml', $data);
    }

    public function revisionAction($req, $res, $service, $app){

        $data = [
            "title" => "Horas Extras en Revision",
            "base_url" => $app->base_url
        ];

        
        return $service->render('HrasExtras/revision.phtml', $data);
    }
    
}

?>