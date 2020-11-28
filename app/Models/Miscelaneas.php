<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class Miscelaneas {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   


    public function obtenerUno(){
        $query = "select * from miscelaneas";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

	
}