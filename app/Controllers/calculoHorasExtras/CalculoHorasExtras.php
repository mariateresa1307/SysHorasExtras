<?php

/**
 * Calculo para horas extras
 */

namespace ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras;
use \DateTime;
use \DateInterval;


class CalculoHorasExtras{
  private $horasLaborales = 0;


  public function __cosntruct(){
    // TODO: sacar este valor de la BD en miscRules
    $this->horasLaborales = 8;
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
  public function determinarTiempoExtraDeUnDia($entrada, $salida){
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
  }





}

?>