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
}

?>