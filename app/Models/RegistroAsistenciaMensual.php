<?php

namespace ControlHorasExtras\PHP_MVC\Models;
use ControlHorasExtras\PHP_MVC\Service;


class RegistroAsistenciaMensual {

    private $em;

    public function __construct(){
        $this->em = new Service();
    }   


    public function obtenerUnoPorId($id){
        $query = "select * from registro_asistencia_mensual where id ='{$id}'";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

    public function obtenerTodo($anno){
        $query = "SELECT 
            id,
            aprobado_coordinador, 
            aprobado_rrhh, 
            date_part('year', tiempo_) as anno,
            date_part('month', tiempo_) as mes
        from registro_asistencia_mensual where date_part('year', tiempo_) =  '{$anno}' ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

    public function obtenerTodoPorAnnoYDEpartamento($anno, $departamento){
        $temp = "";
        if(!is_null($departamento) ) {
            $temp = "and u.departamento_id = {$departamento} ";
        }

        $query = "SELECT
            aprobado_coordinador,
            aprobado_rrhh,
            date_part('year', tiempo_) as anno,
            date_part('month', tiempo_) as mes,
            u.primer_nombre as coordinador_nombre,
            u.primer_apellido as coordinador_apellido
        from
            registro_asistencia_mensual ram
        inner join usuario u on 
            ram.usuario_id = u.id 
        where
            date_part('year', ram.tiempo_) = {$anno}
            {$temp}            
        ";



        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }


    public function obtenerSoloLosAnnosExistentes(){
        $query = "SELECT distinct(date_part('year', tiempo_)) from registro_asistencia_mensual order by date_part";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }



    public function obtnerAsistenciaPorperiodoyCoordinador($date, $coordinadorId){
        $query= "SELECT * from registro_asistencia_mensual where tiempo_ = '$date' and usuario_id = {$coordinadorId} ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }



    public function aprobarCoordinador($id){
        $query = "UPDATE registro_asistencia_mensual
        SET aprobado_coordinador=true
        WHERE id= {$id}
        ";
        pg_query($this->em->vinculo, $query);
    }

	
}