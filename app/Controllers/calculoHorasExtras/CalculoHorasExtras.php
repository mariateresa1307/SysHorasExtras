<?php

/**
 * Calculo para horas extras
 */

namespace ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras;
use \DateTime;
use \DateInterval;
use ControlHorasExtras\PHP_MVC\Models\Miscelaneas;


class CalculoHorasExtras{
  private $horasLaborales = 8;
  private $miscRules = null;


  private function obtnerMiscRules(){
    $miscRules = new Miscelaneas();
    $result = $miscRules->obtenerUno();
    
    $this->miscRules = json_decode($result[0]["data"] );
  }


  /**
   * Calcular la cotizacion de las horas extras segun el sueldo base mensual.
   */
  public function calcularCotizacionHoraExtra($salarioBase, $diasDelMes){
    $salarioDiario = $salarioBase / $diasDelMes;
    $salarioPorHoras = $salarioDiario / $this->horasLaborales;
    return $salarioPorHoras * 1.5;
  }


 
  /**
   * Determinar el tiempo de retraso segun una hora dada
   * Devuelve un string "<horas>:<minutos>" o si no hay retraso devuelve null
   */
  public function determinarTiempoRetraso($entrada) {
    $this->obtnerMiscRules();
    return $this->calculcarVariacionDeTiempo($this->miscRules->hora_oficial_entrada, $entrada);
  }



  /**
   * Determinar el tiempo extra segun una hora dada
   * Devuelve un string "<horas>:<minutos>" o si no hay horas extras devuelve null
   */
  public function determinarTiempoExtra($salida) {
    $this->obtnerMiscRules();
    return $this->calculcarVariacionDeTiempo($this->miscRules->hora_oficial_salida, $salida);
  }



  private function calculcarVariacionDeTiempo($tiempoOficial, $tiempoAComparar){
    $fechaActual = date('Y-m-d');
    $tiempoAComparar = new DateTime($tiempoAComparar);
    $tiempoOficial = new DateTime("{$fechaActual} {$tiempoOficial}");
    $resultado = null;

    if($tiempoAComparar > $tiempoOficial){
      $interval = $tiempoAComparar->diff($tiempoOficial);

      if($interval->h >= 0  &&  $interval->i > 0 ){
        $resultado = "{$interval->h}:{$interval->i}";
      }
    }

    return $resultado;
  }




  // transformar horas como "1:15" a el total de numeros en minutos "105"
  public function horasAMinutos($hours) { 
    $minutes = 0; 
    if (strpos($hours, ':') !== false){ 
        // Split hours and minutes. 
        list($hours, $minutes) = explode(':', $hours); 
    } 
    return $hours * 60 + $minutes; 
  } 

  // Transforma minutos como "105" a la version de horas enteras "2". 
  public function minutosAHoras($minutes) { 
    $hours = (int)($minutes / 60); 
    $minutes -= $hours * 60; 
    //return sprintf("%d:%02.0f", $hours, $minutes); 
    $r = "{$hours}.{$minutes}";
    return ceil($r);
  } 



  public function determinarDiaSemana($fecha){
    $resultado = date("N", strtotime($fecha));

    if($resultado >= 1 || 5 <= $resultado){
      return "semana";
    }
    else{
      return "finDeSemana";
    }
  }


  public function determinarHorasExtrasFinesDeSemana($entrada, $salida){
    $minutosEntrada = $this->horasAMinutos($entrada);
    $minutosSalida = $this->horasAMinutos($salida);
    $minutosTrabajados = $minutosSalida - $minutosEntrada;
    return $this->minutosAHoras($minutosTrabajados);
  }

  public function determinarHorasExtrasTranscurridas($value){
    $temp_minutos = 0;
    //echo "\n";
    if(!empty($value["tiempo_extra"])){

      //echo  "extra: ". $this->horasAMinutos($value["tiempo_extra"]);

      $temp_minutos += $this->horasAMinutos($value["tiempo_extra"]);
    }

    if(!empty($value["tiempo_atraso"])){
      $temp_minutos -= $this->horasAMinutos($value["tiempo_atraso"]);

      //echo "atraso: ". $this->horasAMinutos($value["tiempo_atraso"]);
    }

    //if($temp_minutos <= 0) echo "calcula no toma en cuenta los negativos";

    return $this->minutosAHoras($temp_minutos);
  }

}

?>