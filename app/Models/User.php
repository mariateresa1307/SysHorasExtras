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

   public function Agregar(){
        $query = "insert INTO he.usuario VALUES    ";
        $result = pg_exec($this->em->vinculo, $query);
        pg_close($this->em->vinculo);
        return pg_fetch_all($result);
    }	

   public function Edit(){
        $query = "UPDATE from he.usuario VALUES   ";
        $result = pg_exec($this->em->vinculo, $query);
        pg_close($this->em->vinculo);
        return pg_fetch_all($result);
    }	

   public function Delete($id){
        $query = "DELETE from he.usuario where $id = [id]";
        $result = pg_exec($this->em->vinculo, $query);
        pg_close($this->em->vinculo);
        return pg_fetch_all($result);
    }	
}