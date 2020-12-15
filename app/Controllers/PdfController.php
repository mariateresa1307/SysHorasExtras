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
    //$data = $req->params();
    $data = $req->paramsGet();
print_r($data);


      $registroAsistenciaMensual = new RegistroAsistenciaMensual();
      $coordinadorId = $_SESSION['id'];
      $temp = $registroAsistenciaMensual->obtenerUnoPorId($data['id']);

      if(empty($temp)) return $res->code(404);

      $proceso = new Proceso();
      $d = new DateTime($temp[0]['tiempo_']);
      $mes = $d->format('m');
      $anno = $d->format('Y');

      $result = $proceso->ejecutar($mes, $anno, $coordinadorId);

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
echo $html;
      // instantiate and use the dompdf class
      $dompdf = new Dompdf();
    /*  $dompdf->loadHtml($html);

      // (Optional) Setup the paper size and orientation
      $dompdf->setPaper('A4', 'portrait');

      // Render the HTML as PDF
     $dompdf->render();

      // Output the generated PDF to Browser
    $dompdf->stream();*/



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


        public function pdfFuncionarioAction($req, $res, $service, $app){

        /*  $html = '
          <html lang='en' dir='ltr'>
            <head>
            <img src='./assets/img/cabecera.png'  style='width: 100%'/>
              <meta charset='utf-8'>
              <title> Registro de Horas Extras por funcionario</title>
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

}


?>
