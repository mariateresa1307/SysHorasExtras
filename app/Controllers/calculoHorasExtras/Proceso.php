<?php 

namespace ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras;
use \ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras\CalculoHorasExtras;
use ControlHorasExtras\PHP_MVC\Models\ControlAsistencia;
use ControlHorasExtras\PHP_MVC\Models\RegistroAsistenciaMensual;
use DateTime;

class Proceso{
  private $calculoHorasExtras;


  public function __construct(){
    $this->calculoHorasExtras = new CalculoHorasExtras();
  }



  public function ejecutar($mes, $anno,  $coordinador, $periodo, $funcionarioId = null){
    $controlAsistencia = new ControlAsistencia();
    $registroAsistenciaMensual = new RegistroAsistenciaMensual();
    $date = "{$anno}-{$mes}-01";
    $this->mes = $mes;

    $resultadoFuncionarioSueldo = [];

    $d = new DateTime($date); 
    $ultimoDiaDelMes =  $d->format('t');


    if(empty($periodo)){
      $temp = $registroAsistenciaMensual->obtnerAsistenciaPorperiodoyCoordinador($date,  $coordinador);
      $asistencia = $temp[0]["id"];
    }
    else{
      $asistencia = $periodo;
    }

    if(empty($asistencia)) return [];

    $funcionariosIds = $controlAsistencia->obtenerFuncionarioIdPorRegistroMEnsual($asistencia, $coordinador, $funcionarioId);

    

    foreach($funcionariosIds as $funcionarioId){
      $asistenciaDeUnFuncionario = $controlAsistencia->obtnerTodosLosRegistrosPorFuncionarioyPeriodo($funcionarioId["funcionario_id"], $asistencia);


      $salarioBase = $asistenciaDeUnFuncionario[0]["salario_base"];
      $salarioPorHora = $this->calculoHorasExtras->calcularCotizacionHoraExtra($salarioBase, $ultimoDiaDelMes);

      $result = $this->sumarTodasLasHorasDelMesYCalcularMonto($asistenciaDeUnFuncionario, $salarioPorHora);

      array_push($resultadoFuncionarioSueldo, $result);
    }
    
    return $resultadoFuncionarioSueldo;
  }




  private function sumarTodasLasHorasDelMesYCalcularMonto($asistenciaDeUnFuncionario, $salarioPorHora){
    $balanceHoras = 0;
    $balanceCotizacion = 0;

    foreach($asistenciaDeUnFuncionario as $value){
      switch($this->calculoHorasExtras->determinarDiaSemana($value["entrada"])){
        case "semana": 
          $tempHoras = $this->calculoHorasExtras->determinarHorasExtrasTranscurridas($value);
          break;
        case "finDeSemana": 
          $tempHoras = $this->calculoHorasExtras->determinarHorasExtrasFinesDeSemana($value["entrada"], $value["salida"]);
          break;
      }

      $balanceHoras += $tempHoras;
    }

    if($balanceHoras > 0){
      $balanceCotizacion += $balanceHoras * $salarioPorHora;
    }

    return [
      "funcionario_id" => $asistenciaDeUnFuncionario[0]["funcionario_id"], 
      "funcionario_nombre" => $asistenciaDeUnFuncionario[0]["primer_nombre"], 
      "funcionario_apellido" => $asistenciaDeUnFuncionario[0]["primer_apellido"], 
      "horas_trabajo" => $balanceHoras > 0 ? $balanceHoras : 0,
      "balance_cotizacion_a_pagar" => round($balanceCotizacion, 2),
      "salario_por_hora" => round($salarioPorHora, 2),
      "cargo" => $asistenciaDeUnFuncionario[0]["nombre_cargo"]
    ];
  }

}


?>