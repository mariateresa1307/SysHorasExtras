<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class User {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   


    public function getAll(){
        $query = "SELECT u.*, ut.nombre as tipo_usuario, d2.nombre as nombre_departamento   from usuario u 
        inner join usuario_tipo ut 
        on ut.id = u.usuario_tipo_id 
        inner join departamento d2 
        on d2.id = u.departamento_id  ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }


    public function contarPorEstado($parametro){
        $where = "";
        if($parametro == "bloqueado"){
            $where = "where u.bloqueado = 'true'";
        }
        else{
           $where =  "where u.estado = '{$parametro}' and u.bloqueado = 'false'";
        }

        $query = "SELECT count(*)
        from usuario u 
        {$where};";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }    


    public function guardar($datos){
        $query = "INSERT INTO usuario
        (primer_nombre, primer_apellido, cedula, estado, clave, usuario_tipo_id, departamento_id, bloqueado)
        VALUES('{$datos["nombres"]}', '{$datos["apellidos"]}', '{$datos["cedula"]}', false, '{$datos["clave"]}', '{$datos["tipo_usuario"]}', '{$datos["departamento"]}', '{$datos["bloqueado"]}');        
        ";
        pg_query($this->em->vinculo, $query);
    }

    public function actualizar($data) {
        $query = "UPDATE usuario
        SET 
            primer_nombre='{$data["nombres"]}', 
            primer_apellido='{$data["apellidos"]}', 
            cedula={$data["cedula"]}, 
            clave='', 
            usuario_tipo_id='{$data["tipo_usuario"]}',
            departamento_id='{$data["departamento"]}', 
            bloqueado={$data["bloqueado"]}
        WHERE id='{$data["id"]}';
        ";
        pg_query($this->em->vinculo, $query);
    }

    public function cambiarEstadoActivoinicioSesion($userID){
        $query = "UPDATE usuario
        SET 
            estado=true
        WHERE id='{$userID}';
        ";
        pg_query($this->em->vinculo, $query);
    }



    public function obtnerUnoPorId($id){
        $query = "SELECT id, primer_nombre, primer_apellido, cedula, estado, usuario_tipo_id, departamento_id, bloqueado  from usuario where id = '{$id}'";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }


    public function validarCredenciales($clave, $cedula){
        $query = "SELECT id from usuario where clave= '{$clave}' and  cedula='{$cedula}' ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }



    public function obtenerPorCargoId($cargoId){
        $query = "SELECT
            usuario.*   
        from
            usuario
        inner join departamento on
            departamento.id = usuario.departamento_id
        inner join cargo on
            cargo.departamento_id = departamento.id
        inner join usuario_tipo 
        on usuario_tipo.id = usuario.usuario_tipo_id
        where cargo.id = {$cargoId}
        and usuario_tipo.nombre =  'admin' 
        ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }
	
}