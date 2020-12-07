<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class Departamento {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   


    public function obtenerTodo(){
        $query = "select * from departamento";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

    public function guardar($data) {
        $query = "INSERT INTO departamento
        (nombre)
        VALUES('{$data["nombre"]}');
        ";
        pg_query($this->em->vinculo, $query);
    }


	public function editar($data){
        $query = "UPDATE departamento
        SET nombre='{$data["nombre"]}'
        WHERE id='{$data["id"]}'
        ";
        pg_query($this->em->vinculo, $query);
    }
}