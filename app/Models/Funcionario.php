<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class Funcionario {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   

    public function getAll(){
        $query = "SELECT  f.id ,f.cedula ,f.primer_nombre ,f.segundo_nombre ,f.primer_apellido ,f.segundo_apellido ,f.direccion ,f.telefono,d2.nombre, c2.nombre 	
        FROM funcionario f 
        INNER JOIN departamento d2 ON f.departamento_id = d2 .id
        INNER JOIN cargo c2 ON f.cargo_id = c2 .id ;
        
         ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

    public function guardar($datos){
       
      //  print_r($data);
      //  print("estos son los datos del modelo");
        $query = "INSERT INTO funcionario
        (cedula, primer_nombre, segundo_nombre, primer_apellido, segundo_apellido, telefono, 
        direccion)
        VALUES( '{$datos["cedula"]}', '{$datos["nombrep"]}','{$datos["nombres"]}', 
                '{$datos["apellidop"]}','{$datos["apellidos"]}', '{$datos["telefono"]}'  ,
                '{$datos["direccion"]}'); 
                     
        ";

print_r($query);
       $aaaa=  pg_query($this->em->vinculo, $query);

       print_r($aaaa);
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