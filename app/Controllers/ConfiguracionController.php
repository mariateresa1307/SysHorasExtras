<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;


class ConfiguracionController{

    public function indexAction($req, $res, $service, $app){
            
        $data = [
            "title" => "Configuracion",
            "base_url" => $app->base_url
        ];

        
        return $service->render('configuracion/index.phtml', $data);
    }
}

?>