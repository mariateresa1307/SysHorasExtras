<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class ControlAsistencia {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   


    public function getAll(){
        $query = "select * from control_asistencia";
        $result = pg_exec($this->em->vinculo, $query);
        pg_close($this->em->vinculo);
        return pg_fetch_all($result);
    }
	
}