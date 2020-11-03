<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;

class User {

    private $em;
    private $el;

    public function __construct(){
        $this->em = new Service();
    }   

    public function getAll(){
        $query = "select * from he.usuario inner join he.tipo_usuario on he.usuario.tipo_usuario = he.tipo_usuario.id_tipo_usuario";
        $result = pg_exec($this->em->vinculo, $query);
        pg_close($this->em->vinculo);
        return pg_fetch_all($result);
    }	
}