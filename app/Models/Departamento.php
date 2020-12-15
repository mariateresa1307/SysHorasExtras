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


    public function obtnerCoordinadorDeUnDepartamento($departamentoId) {
        $query = "SELECT u.id
            from 
            departamento d 
            inner join usuario u on 
            u.departamento_id = d.id 
            where d.id = {$departamentoId}
            and u.usuario_tipo_id = 3
        ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }


    public function obtnerCoordinadorDeUnDepartamentoPorCedulaFuncionario($cedulaFuncionario){
        $query = "SELECT
            distinct (u.id)
        from
            departamento d
        inner join usuario u on
            u.departamento_id = d.id
        inner join registro_asistencia_mensual ram on
            ram.usuario_id = u.id
        inner join control_asistencia ca on
            ca.registro_asistencia_mensual_id = ram.id
        inner join funcionario f on
            ca.funcionario_id = f.id
        where
            f.cedula = {$cedulaFuncionario}
        ";
         $result = pg_exec($this->em->vinculo, $query);
         return pg_fetch_all($result);
    }

}