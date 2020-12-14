<?php

namespace ControlHorasExtras\PHP_MVC\Controllers;

include("../Libs/dompdf/autoload.inc.php");

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

}


?>
