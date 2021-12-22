<?php
require_once __DIR__ . '/../../vendor/autoload.php';
//require_once __DIR__ . '/../../packages/mpdf-6.1.4/mpdf.php';
use CRM_Card_ExtensionUtil as E;
use Mpdf\Output\Destination;


class CRM_Card_Utils {

  public static function preview($params) {
    $frontPage = stripslashes($params['front_html']);
    $frontPageCSS = stripslashes($params['front_css']);
    //echo $params['back_html']; exit;
    $backPage = stripslashes($params['back_html']);

    //$frontPageCSS = self::getCSSFromHTML($frontPage);
    //$backPageCSS = self::getCSSFromHTML($backPage);
    $backPageCSS = stripslashes($params['back_css']);

    //$mpdf = new mPDF('utf-8', [93, 54.87], 0, '', 0, 0, 0, 0, 0, 0);/*
    $mpdf = new \Mpdf\Mpdf(['tempDir' => '/tmp']);
    $mpdf->WriteHTML($frontPageCSS, 1);
    $mpdf->WriteHTML($frontPage, 0);
    //$mpdf->WriteHTML('<pagebreak>', 2);
    $mpdf->WriteHTML('<br>', 0);
    $mpdf->WriteHTML($backPageCSS, 1);
    $mpdf->WriteHTML($backPage, 0);
    $mpdf->Output('card.pdf', \Mpdf\Output\Destination::DOWNLOAD);
    /*
    $mpdf = new mPDF('utf-8', array(109, 68.87), 0, '', 0, 0, 0, 0, 0, 0);
    $mpdf->WriteHTML($frontPageCSS, 1);
    $mpdf->WriteHTML($frontPage, 0);
    $mpdf->WriteHTML('<pagebreak>', 2);
    $mpdf->WriteHTML($backPageCSS, 1);
    $mpdf->WriteHTML($backPage, 0);
    $mpdf->Output('card2.pdf', 'I');
    exit( 0 );
    */
  }

  public static function getCSSFromHTML($html) {
    $css = '';
    preg_match_all("/(?<=link[\s]rel=\"stylesheet\"[\s]href=\"[.][.]\/css\/)(.*?)\"/", $html, $fmatches);
    foreach ($fmatches as $key => $m) {
      if ($key % 2 == 1) {
        $css .= file_get_contents('./css/' . $m[0]);
      }
    }

    return $css;
  }
}
