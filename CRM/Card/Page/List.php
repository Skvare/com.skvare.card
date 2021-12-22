<?php
use CRM_Card_ExtensionUtil as E;

class CRM_Card_Page_List extends CRM_Core_Page {
  public $_id;
  public $_action;

  public function preProcess() {
    $this->_action = CRM_Utils_Request::retrieve('action', 'String', $this, FALSE, 'browse');
    $this->_id = CRM_Utils_Request::retrieve('id', 'Positive', $this);
  }

  public function run() {
    // Example: Set the page-title dynamically; alternatively, declare a static title in xml/Menu/*.xml
    CRM_Utils_System::setTitle(E::ts('Cart Html Listing'));
    $this->preProcess();
    if ($this->_action & CRM_Core_Action::PREVIEW) {
      $this->preview();
    }
    else {
      $this->browse();
    }
    parent::run();
  }

  /**
   * @throws CiviCRM_API3_Exception
   */
  public function browse() {
    // Example: Assign a variable for use in a template
    $result = civicrm_api3('CardHtml', 'get', [
      'return' => ["title", "id"],
    ]);
    $list = $result['values'];
    foreach ($list as &$value) {
      $value['link_update'] = CRM_Utils_System::url('civicrm/admin/card/upload',
        "reset=1&action=update&id={$value['id']}");
      $value['link_delete'] = CRM_Utils_System::url('civicrm/admin/card/upload',
        "reset=1&action=delete&id={$value['id']}");
      $value['link_preview'] = CRM_Utils_System::url('civicrm/admin/card/list',
        "reset=1&action=preview&id={$value['id']}");
    }
    $this->assign('cartHtml', $list);
  }

  /**
   * @param $id
   */
  public function preview() {
    if ($this->_id) {
      $params['id'] = $this->_id;
      CRM_Card_BAO_CardHtml::retrieve($params, $defaults);
      CRM_Card_Utils::preview($defaults);
    }
  }

}
