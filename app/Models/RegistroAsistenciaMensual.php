<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class RegistroAsistenciaMensual {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   


    public function obtenerTodo(){
        $query = "select * from registro_asistencia_mensual";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

	
}