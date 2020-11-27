<?php

/**
 * Calculo para horas extras
 */

namespace ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras;



class CalculoHorasExtras{
  public function execute($payload){

    /**
     * 
          (
            [id] =&gt; 1
            [cedula] =&gt; 2333
            [primer_nombre] =&gt; alei
            [segundo_nombre] =&gt; df
            [primer_apellido] =&gt; hr
            [segundo_apellido] =&gt; 
            [direccion] =&gt; 
            [telefono] =&gt; 
            [estado] =&gt; t
            [cargo_id] =&gt; 1
            [entrada] =&gt; 2020-01-01 00:00:00
            [salida] =&gt; 2020-01-01 16:00:00
            [funcionario_id] =&gt; 1
            [nombre] =&gt; programador
            [salario_base] =&gt; 4000000
            [departamento_id] =&gt; 1
          )
    */

    
    $diasDelMes = 31; // enero
    $horasLaborales = 8;
    $salarioBase = $payload[0]["salario_base"];
    $salarioDiario = $salarioBase / $diasDelMes;

    $salarioPorHoras = $salarioDiario / $horasLaborales;

    $salarioPorHorasConPorcentaje = $salarioPorHoras * 1.5;
    
    
    // obtener horas extras por dias segun registros
    foreach($payload as $item) {
      //echo $item['entrada'] . " | ";
      //echo $item['salida'];

      $diferenciaDeTiempoDiaria = strtotime($item['salida']) - strtotime($item['entrada']);

      echo date( "H:i:s", ($diferenciaDeTiempoDiaria) )  , "</br>";
      
      break;
    }

  }
}

?>