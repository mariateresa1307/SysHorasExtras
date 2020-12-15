<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;
use ControlHorasExtras\PHP_MVC\Models\Departamento;
use ControlHorasExtras\PHP_MVC\Models\RegistroAsistenciaMensual;
use \ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras\Proceso;
use DateTime;
use Dompdf\Dompdf;

class PdfController{


    public function indexAction($req, $res, $service, $app){


      // instantiate and use the dompdf class
      $dompdf = new Dompdf();
      $dompdf->loadHtml('hello world');

      // (Optional) Setup the paper size and orientation
      $dompdf->setPaper('A4', 'landscape');

      // Render the HTML as PDF
      $dompdf->render();

      // Output the generated PDF to Browser
      $dompdf->stream();



    }



    public function PDF_RRHH($req, $res, $service, $app) {
      $registroAsistenciaMensual = new RegistroAsistenciaMensual();
      $departamento = new Departamento();
      $proceso = new Proceso();
      $data = $req->paramsGet();

     

      
     
      $d = DateTime::createFromFormat( "m-Y", $data["value_date"]);
      $mes = $d->format('m');
      $anno = $d->format('Y');
      

      $temp = $departamento->obtnerCoordinadorDeUnDepartamento( $data["departamento"]);
      $coordinadorId = $temp[0]["id"];

      if(empty($data["value_string"])){
        $temp = $registroAsistenciaMensual->obtnerPorDepartamentosYRangoDeFechas(
          $coordinadorId,
          $anno,
          $mes
        );
      }
      else{
        $temp = $registroAsistenciaMensual->obtnerPorDepartamentosFuncionarioCedula(
          null,
          $anno,
          $mes,
          $data["value_string"]
        );

      }
      
      


      if(empty($temp)) return $res->code(404);


      $result = [];
      foreach($temp as $value){
        $temp = $proceso->ejecutar($mes, $anno, $coordinadorId, $value["id"]);
        array_push($result, $temp);
      }


      if(empty($result)) return $res->code(404);




      
      $tablaCuerpo = "";
      foreach ($result as $value) {
        foreach($value as $b){
          
          $tablaCuerpo = $tablaCuerpo .  "<tr>
            <td>{$b['funcionario_nombre']}</td>
            <td>{$b['funcionario_apellido']}</td>
            <td>{$b['horas_trabajo']}</td>
            <td>{$b['balance_cotizacion_a_pagar']}</td>
            <td>{$b['salario_por_hora']}</td>
            <td>{$b['cargo']}</td>
          </tr>";
        }




      }


      $html = "
      <html lang='en' dir='ltr'>
        <head>
        <img src='./assets/img/cabecera.png'  style='width: 100%'/>
          <meta charset='utf-8'>
          <title> Registro de Horas Extras</title>
        </head>
        <body>
        <div style='background-color:#f8f8f8'>

          <h4 style='text-align: center;'>Registro de Horas Extras</h4>

          <table style='width:100%'>
            <tr>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Horas de trabajos</th>
              <th>balance de cotizacion a pagar</th>
              <th>Salario por hora</th>
              <th>Cargo</th>
            </tr>
          {$tablaCuerpo}
          </table>
        </div>

        </body>
      </html>

      ";


    


        // instantiate and use the dompdf class
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
      
        // (Optional) Setup the paper size and orientation
        $dompdf->setPaper('A4', 'portrait');
        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser
        $dompdf->stream();

    }


}


?>