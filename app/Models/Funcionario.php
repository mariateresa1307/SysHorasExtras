<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class Funcionario {

    private $em;

    public function __construct(){
        $this->em = new Service();
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
        pg_close($this->em->vinculo);
        return pg_fetch_all($result);
    }
	
}