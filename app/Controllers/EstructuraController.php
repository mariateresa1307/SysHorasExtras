<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


class EstructuraController{

    public function misionAction($req, $res, $service, $app){
            
        $data = [
            "title" => "Configuracion",
            "base_url" => $app->base_url
        ];

        
        return $service->render('estructuraOrganizativa/index.phtml', $data);
    }

    public function organigramaAction($req, $res, $service, $app){
            
        $data = [
            "title" => "Configuracion",
            "base_url" => $app->base_url
        ];

        
        return $service->render('estructuraOrganizativa/organigrama.phtml', $data);
    }
}

?>