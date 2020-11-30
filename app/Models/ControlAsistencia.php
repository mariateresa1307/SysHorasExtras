<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class ControlAsistencia {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   


    public function getAll(){
        $query = "SELECT * FROM control_asistencia";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

    public function obtenerPorCedulayDia($cedula, $fecha) {
        $query = "SELECT ca.*
            FROM control_asistencia ca 
            inner join funcionario f 
            on f.id = ca.funcionario_id
            where  DATE(ca.entrada) = '{$fecha}'
            and f.cedula  = '${cedula}'
        ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }


    public function guardar($tiempo, $funcionarioId, $tiempoAtraso){
        $query = "INSERT INTO control_asistencia
            (entrada, salida, funcionario_id, tiempo_extra, tiempo_atraso)
            VALUES('{$tiempo}', null, {$funcionarioId}, null, '{$tiempoAtraso}');
        ";
        pg_query($this->em->vinculo, $query);
    }

    public function actualizar($controlAsistenciaId, $salida, $tiempoExtra){
        $query = "UPDATE control_asistencia
            SET salida='{$salida}', tiempo_extra='{$tiempoExtra}'
            WHERE id = '{$controlAsistenciaId}';
        ";
        pg_query($this->em->vinculo, $query);
    }
	
}