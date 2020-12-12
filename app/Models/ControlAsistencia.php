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


    public function guardar($tiempo, $funcionarioId, $tiempoAtraso, $registro_padre){
        $query = "INSERT INTO control_asistencia
            (entrada, salida, funcionario_id, tiempo_extra, tiempo_atraso, registro_asistencia_mensual_id)
            VALUES('{$tiempo}', null, {$funcionarioId}, null, '{$tiempoAtraso}', '{$registro_padre}');
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


    /**
     * Esto va en el otro modelo
     */

    public function obtner_registro_padre_del_mes($mes, $anno){
        $query = "SELECT *
        from registro_asistencia_mensual r
        WHERE EXTRACT(month FROM r.tiempo_) = {$mes}
        AND EXTRACT(year FROM r.tiempo_) = {$anno}
        ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

    /**
     * Esto va en el otro modelo
     */

    public function crear_registro_padre_del_mes($date, $coordinadorId) {
        $query = "INSERT INTO registro_asistencia_mensual
        (aprobado_coordinador, aprobado_rrhh, tiempo_, usuario_id)
        VALUES(null, null, '{$date}', {$coordinadorId});
        ";
        pg_query($this->em->vinculo, $query);


        return $this->obtnerAsistenciaPorperiodoyCoordinador($date, $coordinadorId);
    }



    /**
     * Esto va en el otro modelo
     */
    
    public function obtnerAsistenciaPorperiodoyCoordinador($date, $coordinadorId){
        $query= "SELECT * from registro_asistencia_mensual where tiempo_ = '$date' and usuario_id = {$coordinadorId} ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }



    public function obtenerFuncionarioIdPorRegistroMEnsual($id, $coordinadorId){
        $query = "SELECT
        distinct (ca.funcionario_id) as funcionario_id
        from
            control_asistencia ca
        inner join registro_asistencia_mensual ram on
            ram.id = ca.registro_asistencia_mensual_id
        where
            ca.registro_asistencia_mensual_id = {$id}
            and ram.usuario_id = {$coordinadorId}";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }

    public function obtnerTodosLosRegistrosPorFuncionarioyPeriodo($funcionarioId, $periodoId){
        $query = "SELECT
            ca.id as control_asistencia_id,
            ca.entrada,
            ca.salida ,
            ca.tiempo_extra ,
            ca.tiempo_atraso ,
            ca.funcionario_id ,
            c.salario_base
        from
            control_asistencia ca
        inner join funcionario f on
            f.id = ca.funcionario_id
        inner join cargo c on
            c.id = f.cargo_id
        where ca.funcionario_id = {$funcionarioId} 
        and ca.registro_asistencia_mensual_id = {$periodoId}
        ";
        $result = pg_exec($this->em->vinculo, $query);
        return pg_fetch_all($result);
    }
	
}