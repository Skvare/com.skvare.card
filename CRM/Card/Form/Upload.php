<?php

use CRM_Card_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Card_Form_Upload extends CRM_Core_Form {
  public $_id;

  public function preProcess() {
    parent::preProcess();

    $this->_id = CRM_Utils_Request::retrieve('id', 'Positive', $this, FALSE, NULL, 'GET');
    $this->assign('id', $this->_id);

    if ($this->_id) {
      $this->_doneUrl = CRM_Utils_System::url(CRM_Utils_System::currentPath(),
        "action=update&reset=1&id={$this->_id}"
      );
    }
  }

  /**
   * Set default values for the form. Note that in edit/view mode
   * the default values are retrieved from the database
   *
   *
   * @return void
   */
  public function setDefaultValues() {
    $defaults = [];
    if (isset($this->_id)) {
      $params = [];
      $params['id'] = $this->_id;
      CRM_Card_BAO_CardHtml::retrieve($params, $defaults);
    }


    return $defaults;
  }

  public function buildQuickForm() {

    // add form elements
    $attribute = ['rows' => 10, 'cols' => 80, 'class' => 'collapsed'];
    $this->add('text', 'title', E::ts('Cart Title'), ['size' => 60], TRUE);
    $this->add('textarea', 'front_html', E::ts('Front HTML'), $attribute);
    $this->add('textarea', 'front_css', E::ts('Front HTML CSS'), $attribute);
    $this->add('textarea', 'back_html', E::ts('Back HTML'), $attribute);
    $this->add('textarea', 'back_css', E::ts('Back HTML CSS'), $attribute);
    $this->addElement('checkbox', 'is_active', E::ts('Active?'));
    $this->addButtons(array(
      array(
        'type' => 'submit',
        'name' => E::ts('Submit'),
        'isDefault' => TRUE,
      ),
    ));

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess() {
    $values = $this->exportValues();
    //$values = $this->controller->exportValues($this->_name);
    if (!empty($this->_id)) {
      $values['id'] = $this->_id;
    }
    $cardHtml = CRM_Card_BAO_CardHtml::create($values);
    if (empty($this->_id)) {
      $this->_id = $cardHtml->id;
    }
    CRM_Core_Session::setStatus(E::ts("Card Html has been saved."), E::ts('Saved'),
      'success');
    parent::postProcess();
    $this->postProcessHook();
    CRM_Utils_System::redirect(CRM_Utils_System::url
    (CRM_Utils_System::currentPath(),
      "action=update&reset=1&id={$this->_id}"
    ));
  }

  /**
   * Get the fields/elements defined in this form.
   *
   * @return array (string)
   */
  public function getRenderableElementNames() {
    // The _elements list includes some items which should not be
    // auto-rendered in the loop -- such as "qfKey" and "buttons".  These
    // items don't have labels.  We'll identify renderable by filtering on
    // the 'label'.
    $elementNames = [];
    foreach ($this->_elements as $element) {
      /** @var HTML_QuickForm_Element $element */
      $label = $element->getLabel();
      if (!empty($label)) {
        $elementNames[] = $element->getName();
      }
    }

    return $elementNames;
  }

}
