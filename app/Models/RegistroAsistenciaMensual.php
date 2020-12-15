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

    public function obtenerPeriodo($fecha, $coordinadorId){

      $query = "SELECT * from registro_asistencia_mensual WHERE tiempo_='{$fecha}' AND usuario_id='{$coordinadorId}'";
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
            ram.id,
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

    public function obtenerSoloMesExistentes(){
        $query = "SELECT distinct(date_part('month', tiempo_)) from registro_asistencia_mensual order by date_part";
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
        SET aprobado_coordinador=true,
        aprobado_rrhh=null
        WHERE id= {$id}
        ";
        pg_query($this->em->vinculo, $query);
    }


    public function aprobarRRHH($id, $estado){
        $query = "UPDATE registro_asistencia_mensual
            SET aprobado_rrhh={$estado}
            WHERE id= {$id}
        ";
        pg_query($this->em->vinculo, $query);
    }

    /*
    *   $condicion = "aprobado"
            $condicion = "revision"
    *  $condicion= "porAprobar"
    */


    public function contarPorEstado($condicion,$mes,$ann){
        $where = "";
        if($condicion == "aprobado"  ){
            $where = "where u.aprobado_coordinador = true and u.aprobado_rrhh= true  ";
        } elseif ($condicion == "revision") {

              $where ="where u.aprobado_coordinador= true and u.aprobado_rrhh= false ";

        }
        elseif ($condicion == "porAprobar")  {
           $where =  "where u.aprobado_coordinador = true  and u.aprobado_rrhh is null ";
        }

        $query = "SELECT count(*)
        from  registro_asistencia_mensual u
        {$where}
        and date_part('month', u.tiempo_) = {$mes}
        and date_part('year', u.tiempo_) = {$ann}
        ";


        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

}
