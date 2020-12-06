<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class Cargo {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   


    public function obtenerTodo(){
        $query = "select * from cargo";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

    public function obtnerPorDepartamento($departamento_id){
        $query = "SELECT * FROM cargo where departamento_id = {$departamento_id}";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

	
}