<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class Funcionario {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   

    public function guardar($datos){
        $query = "INSERT INTO funcionario
        (cedula, primer_nombre, segundo_nombre, primer_apellido, segundo apellido, 
        direccion,telefono,cargo_id, departamento_id)
        VALUES( '{$datos["cedula"]}', '{$datos["primer_nombre"]}','{$datos["segundo_nombre"]}', 
                '{$datos["primer,apellidos"]}','{$datos["segundo_apellidos"]}',
                ,'{$datos["direccion"]}', '{$datos["telefono"]}', '{$datos["departamento"]}'),'{$datos["cargo"]}');        
        ";
        pg_query($this->em->vinculo, $query);
    } 

    public function obtnerFuncionarioParaCalculo(){
        $query = "
          select * 
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

	
}