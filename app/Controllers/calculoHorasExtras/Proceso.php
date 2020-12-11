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



  public function ejecutar($mes, $anno,  $coordinador){
    $controlAsistencia = new ControlAsistencia();
    $registroAsistenciaMensual = new RegistroAsistenciaMensual();
    $date = "{$anno}-{$mes}-01";
    $this->mes = $mes;

    $resultadoFuncionarioSueldo = [];

    $d = new DateTime($date); 
    $ultimoDiaDelMes = $d->format('t');


    $asistencia = $registroAsistenciaMensual->obtnerAsistenciaPorperiodoyCoordinador($date,  $coordinador);

    if(empty($asistencia)) return [];

    
    $funcionariosIds = $controlAsistencia->obtenerFuncionarioIdPorRegistroMEnsual($asistencia[0]["id"], $coordinador);


    foreach($funcionariosIds as $funcionarioId){
      $asistenciaDeUnFuncionario = $controlAsistencia->obtnerTodosLosRegistrosPorFuncionarioyPeriodo($funcionarioId["funcionario_id"], $asistencia[0]["id"]);


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

      if($tempHoras > 0){
        $balanceCotizacion += $tempHoras * $salarioPorHora;
      }


    }

    return [
      "funcionario_id" => $asistenciaDeUnFuncionario[0]["funcionario_id"], 
      "horas_trabajo" => $balanceHoras,
      "balance_cotizacion" => $balanceCotizacion
    ];
  }

}


?>