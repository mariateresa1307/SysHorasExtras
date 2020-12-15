<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

use Dompdf\Dompdf;

class PdfController{


    public function indexAction($req, $res, $service, $app){
      $html = '
      <html lang="en" dir="ltr">
        <head>
        <img src="./assets/img/cabecera.png"  style="width: 100%"/>
          <meta charset="utf-8">
          <title> Registro de Horas Extras</title>
        </head>
        <body>
        <div style="background-color:#f8f8f8">

          <h4 style="text-align: center;">Registro de Horas Extras</h4>
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
      $dompdf->stream();



    }

    public function pdfAnoAction($req, $res, $service, $app){
      $html = '
      <html lang="en" dir="ltr">
        <head>
        <img src="./assets/img/cabecera.png"  style="width: 100%"/>
          <meta charset="utf-8">
          <title> Registro de Horas Extras por año</title>
        </head>
        <body>
        <div style="background-color:#f8f8f8">

          <h4 style="text-align: center;">Registro de Horas Extras</h4>
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
      $dompdf->stream();



    }


        public function pdfFuncionarioAction($req, $res, $service, $app){
          $html = '
          <html lang="en" dir="ltr">
            <head>
            <img src="./assets/img/cabecera.png"  style="width: 100%"/>
              <meta charset="utf-8">
              <title> Registro de Horas Extras por funcionario</title>
            </head>
            <body>
            <div style="background-color:#f8f8f8">

              <h4 style="text-align: center;">Registro de Horas Extras</h4>
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
          $dompdf->stream();



        }

}


?>
