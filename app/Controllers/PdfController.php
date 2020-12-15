<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use \ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras\CalculoHorasExtras;
use \ControlHorasExtras\PHP_MVC\Controllers\calculoHorasExtras\Proceso;
use ControlHorasExtras\PHP_MVC\Models\Funcionario;
use ControlHorasExtras\PHP_MVC\Models\RegistroAsistenciaMensual;
use ControlHorasExtras\PHP_MVC\Models\Departamento;
use DateTime;

use Dompdf\Dompdf;

class PdfController{




    public function indexAction($req, $res, $service, $app){
    
      $data = $req->paramsGet();
      
      
      $registroAsistenciaMensual = new RegistroAsistenciaMensual();
      $coordinadorId = $_SESSION['id'];
      $temp = $registroAsistenciaMensual->obtenerUnoPorId($data['id']);

      if(empty($temp)) return $res->code(404);

      $proceso = new Proceso();
      $d = new DateTime($temp[0]['tiempo_']);
      $mes = $d->format('m');
      $anno = $d->format('Y');

      $result = $proceso->ejecutar($mes, $anno, $coordinadorId, null);

      if(empty($result)) return $res->code(404);

      $tablaCuerpo = "";
      foreach ($result as $value) {
      // code...
      $tablaCuerpo = $tablaCuerpo .  "<tr>
          <td>{$value['funcionario_nombre']}</td>
          <td>{$value['funcionario_apellido']}</td>
          <td>{$value['horas_trabajo']}</td>
          <td>{$value['balance_cotizacion_a_pagar']}</td>
          <td>{$value['salario_por_hora']}</td>
          <td>{$value['cargo']}</td>
        </tr>";
      }       

      $url = empty($data["html"]) ?  "." : $app->base_url;

      $html = "
      <html lang='en' dir='ltr'>
        <head>
        <img src='$url/assets/img/cabecera.png'  style='width: 100%'/>
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
      
      if(!empty($data["html"])){
        echo $html;
        return;
      }


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

   public function pdfAnoAction($req, $res, $service, $app){
    /*  $html = '
      <html lang='en' dir='ltr'>
        <head>
        <img src='./assets/img/cabecera.png'  style='width: 100%'/>
          <meta charset='utf-8'>
          <title> Registro de Horas Extras por año</title>
        </head>
        <body>
        <div style='background-color:#f8f8f8'>

          <h4 style='text-align: center;'>Registro de Horas Extras</h4>
        </div>

        </body>
      </html>

      ';

      // instantiate and use the dompdf class
      $dompdf = new Dompdf();
      $dompdf->loadHtml($html);

      // (Optional) Setup the paper size and orientation
      $dompdf->setPaper('A4', 'portrait');

      // Render the HTML as PDF
      $dompdf->render();

      // Output the generated PDF to Browser
      $dompdf->stream();*/



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

      if(empty($coordinadorId)) {
        echo "no hay coordinador"; 
        return;
      }

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
      
      


      if(empty($temp)) {
        echo "no hay registros para este tiempo seleccionado";
        return;
      }


      $result = [];
      foreach($temp as $value){
        $temp = $proceso->ejecutar($mes, $anno, $coordinadorId, $value["id"]);
        array_push($result, $temp);
      }


      if(empty($result)) {
        echo "no se encontraron registros de asistencia para el registro dado";
        return;
      }




      
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



  public function pdf_rango_tiempo_coordinador($req, $res, $service, $app){
      $registroAsistenciaMensual = new RegistroAsistenciaMensual();
      $departamento = new Departamento();
      $proceso = new Proceso();
      $data = $req->paramsGet();


      $dInicio = DateTime::createFromFormat( "m-Y", $data["value_date_inicio"]);
      $dFinal = DateTime::createFromFormat( "m-Y", $data["value_date_final"]);


      $tablaCuerpo = "";
      if($dInicio->format("Y") == $dFinal->format("Y") ){
        for($i = $dInicio->format("m"); $i <= $dFinal->format("m"); $i++ ){
          $mes = $i;
          $anno = $dInicio->format("Y");


          $temp = $departamento->obtnerCoordinadorDeUnDepartamentoPorCedulaFuncionario( $data["value"]);
          $coordinadorId = $temp[0]["id"];


          $temp = $registroAsistenciaMensual->obtnerPorDepartamentosFuncionarioCedula(
            null,
            $anno,
            $i,
            $data["value"]
          );

          if(empty($temp)) continue;

          $preResult = [];
          foreach($temp as $value){
            $temp = $proceso->ejecutar($mes, $anno, $coordinadorId, $value["id"]);
            array_push($preResult, $temp);
          }


          foreach ($preResult as $value) {
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


        }
      }
      else{
        echo "Solo es permitido un rango de meses dentro del mismo Anno";
        return;
      }
      


      if(empty($tablaCuerpo)) {
        echo "sin resultado";
        return;
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