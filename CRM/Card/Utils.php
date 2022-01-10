<?php
require_once __DIR__ . '/../../vendor/autoload.php';
//require_once __DIR__ . '/../../packages/mpdf-6.1.4/mpdf.php';
use CRM_Card_ExtensionUtil as E;
use Mpdf\Output\Destination;
use Civi\Token\TokenProcessor;


class CRM_Card_Utils {

  /**
   * Function to preview pdf.
   *
   * @param $params
   * @param $contactId
   * @throws \Mpdf\MpdfException
   */
  public static function preview($params, $contactId = NULL, $attachment = FALSE) {
    $contactId = 202;
    $frontPage = stripslashes($params['front_html']);
    if ($contactId) {
      $frontPage = [$frontPage];
      $frontPage = self::render($frontPage,
        [
          'contactId' => $contactId,
        ]
      );
      $frontPage = $frontPage[0];
    }
    //$frontPageCSS = stripslashes($params['front_css']);
    $frontPageCSS = $params['front_css'];
    //echo $params['back_html']; exit;
    $backPage = stripslashes($params['back_html']);
    if ($contactId) {
      $backPage = [$backPage];
      $backPage = self::render($backPage,
        [
          'contactId' => $contactId,
        ]
      );
      $backPage = $backPage[0];
    }

    //$frontPageCSS = self::getCSSFromHTML($frontPage);
    //$backPageCSS = self::getCSSFromHTML($backPage);
    //$backPageCSS = stripslashes($params['back_css']);
    $backPageCSS = $params['back_css'];
    //echo $backPage;
    //echo $frontPage;
    //exit;

    //$mpdf = new mPDF('utf-8', [93, 54.87], 0, '', 0, 0, 0, 0, 0, 0);/*
    try {
      $mpdf = new \Mpdf\Mpdf(['tempDir' => '/tmp']);
      $mpdf->WriteHTML($frontPageCSS, 1);
      $mpdf->WriteHTML($frontPage, 0);
      //$mpdf->WriteHTML('<pagebreak>', 2);
      $mpdf->WriteHTML('<br>', 0);
      $mpdf->WriteHTML($backPageCSS, 1);
      $mpdf->WriteHTML($backPage, 0);
      if ($attachment) {
        $outPut = $mpdf->Output('', \Mpdf\Output\Destination::STRING_RETURN);

        return base64_encode($outPut);
      }
      else {
        $mpdf->Output('card.pdf', \Mpdf\Output\Destination::DOWNLOAD);
      }
    }
    catch (\MpdfException $exception) {

    }
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

  /**
   * Function to get membership types.
   *
   * @return array
   * @throws CiviCRM_API3_Exception
   */
  public static function membershipTypeCurrentDomain() {
    $result = civicrm_api3('MembershipType', 'get', [
      'sequential' => 1,
      'return' => ["id", "name"],
    ]);
    $membershipType = [];
    foreach ($result['values'] as $details) {
      $membershipType[$details['id']] = $details['name'];
    }

    return $membershipType;
  }

  /**
   * Function to get Card List.
   *
   * @return array
   * @throws CiviCRM_API3_Exception
   */
  public static function getCardList() {
    $result = civicrm_api3('CardHtml', 'get', [
      'sequential' => 1,
      'return' => ["id", "title"],
      'is_active' => 1,
    ]);
    $list = [];
    foreach ($result['values'] as $value) {
      $list[$value['id']] = $value['title'];
    }

    return $list;
  }

  /**
   * Function to attach pdf to email.
   *
   * @param $params
   * @param $cardID
   * @param $contactID
   * @throws \Mpdf\MpdfException
   */
  public static function attachPdf(&$params, $cardID, $contactID) {
    if ($cardID && $contactID) {
      $cardParams['id'] = $cardID;
      // retrieve html using card id
      CRM_Card_BAO_CardHtml::retrieve($cardParams, $defaults);
      // generate pdf file
      $pdfString = CRM_Card_Utils::preview($defaults, $contactID, TRUE);
      $pdf = base64_decode($pdfString);
      // attach to email
      $base = $contactID . '-membership_card.pdf';
      $full = tempnam(sys_get_temp_dir(), $base);
      file_put_contents($full, $pdf);
      $params['attachments'][] = [
        'fullPath' => $full,
        'mime_type' => 'application/pdf',
        'cleanName' => $base,
      ];
    }
  }

  /**
   * Render some template(s), evaluating token expressions and Smarty expressions.
   *
   * This helper simplifies usage of hybrid notation. As a simplification, it may not be optimal for processing
   * large batches (e.g. CiviMail or scheduled-reminders), but it's a little more convenient for 1-by-1 use-cases.
   *
   * @param array $messages
   *   Message templates. Any mix of the following templates ('text', 'html', 'subject', 'msg_text', 'msg_html', 'msg_subject').
   *   Ex: ['subject' => 'Hello {contact.display_name}', 'text' => 'What up?'].
   *   Note: The content-type may be inferred by default. A key like 'html' or 'msg_html' indicates HTML formatting; any other key indicates text formatting.
   * @param array $tokenContext
   *   Ex: ['contactId' => 123, 'activityId' => 456]
   * @param array|null $smartyAssigns
   *   List of data to export via Smarty.
   *   Data is only exported temporarily (long enough to execute this render() method).
   * @return array
   *   Rendered messages. These match the various inputted $messages.
   *   Ex: ['msg_subject' => 'Hello Bob Roberts', 'msg_text' => 'What up?']
   * @internal
   */
  public static function render(array $messages, array $tokenContext = [], array $smartyAssigns = []): array {
    $result = [];
    $tokenContextDefaults = [
      'controller' => __CLASS__,
      'smarty' => TRUE,
    ];
    $tokenProcessor = new TokenProcessor(\Civi::dispatcher(), array_merge($tokenContextDefaults, $tokenContext));
    $tokenProcessor->addRow([]);
    $useSmarty = !empty($tokenProcessor->context['smarty']);

    // Load templates
    foreach ($messages as $messageId => $messageTpl) {
      $format = preg_match('/html/', $messageId) ? 'text/html' : 'text/plain';
      $tokenProcessor->addMessage($messageId, $messageTpl, $format);
    }

    // Evaluate/render templates
    try {
      if ($useSmarty) {
        CRM_Core_Smarty::singleton()->pushScope($smartyAssigns);
      }
      $tokenProcessor->evaluate();
      foreach ($messages as $messageId => $ign) {
        foreach ($tokenProcessor->getRows() as $row) {
          $result[$messageId] = $row->render($messageId);
        }
      }
    }
    finally {
      if ($useSmarty) {
        CRM_Core_Smarty::singleton()->popScope();
      }
    }

    return $result;
  }
}
