<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class Funcionario {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   

    /**
     * Obtener todos los funcionarios 
     */
    public function getAll(){
        $query = "SELECT  
        f.id ,f.cedula,
        f.primer_nombre,
        f.segundo_nombre,
        f.primer_apellido,
        f.segundo_apellido,
        f.direccion,
        f.telefono,
        d2.nombre as departamento_nombre,
        c2.nombre as cargo_nombre	
        FROM funcionario f         
        INNER JOIN cargo c2 
        ON f.cargo_id = c2.id
        INNER JOIN departamento d2
        ON c2.departamento_id = d2.id";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

    /**
     * Insertar en la tabla usuarios
     */
    public function guardar($datos){
        $query = "INSERT INTO funcionario
        (cedula, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, telefono, 
        direccion, cargo_id)
        VALUES( '{$datos["cedula"]}',    '{$datos["nombrep"]}',   '{$datos["nombres"]}', 
                '{$datos["apellidop"]}', '{$datos["apellidos"]}', '{$datos["telefono"]}'  ,
                '{$datos["direccion"]}', '{$datos["cargo"]}'); 
        ";
        pg_query($this->em->vinculo, $query);
    } 


    public function actualizar($datos){
        $query = "UPDATE public.funcionario
        SET cedula='{$datos["cedula"]}', 
        primer_nombre='{$datos["nombrep"]}', 
        segundo_nombre='{$datos["nombres"]}', 
        primer_apellido='{$datos["apellidop"]}', 
        segundo_apellido='{$datos["apellidos"]}', 
        direccion='{$datos["direccion"]}', 
        telefono='{$datos["telefono"]}', 
        estado=false, 
        cargo_id='{$datos["cargo"]}'
        WHERE id='{$datos["id"]}';
        ";
         pg_query($this->em->vinculo, $query);
    }

    
    public function obtnerFuncionarioParaCalculo(){
        $query = "SELECT * 
          from funcionario f 
          inner join control_asistencia ca 
          on ca.funcionario_id = f.id
          inner join cargo c2 
          on c2.id  = f.cargo_id 
          order by ca.id asc
        ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }



    public function obtenerUnoPorCedula($id){
        $query = "select * from funcionario where cedula = '{$id}' ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }


    public function obtnerUnoPorId($id){
        $query = "SELECT f.*, c2.departamento_id as departamento_id
            from funcionario f 
            INNER JOIN cargo c2 
            ON f.cargo_id = c2.id
            where f.id= '{$id}'
        ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }



	
}