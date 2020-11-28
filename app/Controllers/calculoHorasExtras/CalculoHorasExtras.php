<?php

/**
 * Calculo para horas extras
 */

namespace ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras;
use \DateTime;
use \DateInterval;
use ControlHorasExtras\PHP_MVC\Models\Miscelaneas;


class CalculoHorasExtras{
  private $horasLaborales = 0;
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
   * Determina el tiempo en horas y minutos de un dia trabajado. 
   * Parametros $entrada = 2020-01-01 09:45:00 y $salida = 2020-01-01 18:35:00 
   * La salida es del tipo Array( [fecha] => 2020-01-01, [tiempoExtra] => 0:50 )
   * o un false si el rango de tiempo no cumple con las reglas (no se encontro tiempo extra trabajado).
   */
  /*public function determinarTiempoExtraDeUnDia($entrada, $salida){
    $salida  = new DateTime($salida);
    $entrada = new DateTime($entrada);

    if($salida > $entrada){
      $interval = $salida->diff($entrada);
      if( $interval->h >= $this->horasLaborales){
        if($interval->i >= 0){
          if( $interval->h == $this->horasLaborales && $interval->i == 0 ) return false;
          
          // todo ok con las validaciones
          $remanente = $interval->h - $this->horasLaborales;
          $tiempoExtra = "{$remanente}:{$interval->i}";

          $temp = [
            "fecha" => $entrada->format("Y-m-d"),
            "tiempoExtra" => $tiempoExtra
          ];

          return $temp;
        }
      }
    }

    return false;
  }*/


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

}

?>