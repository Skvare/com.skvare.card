<?php

use CRM_Card_ExtensionUtil as E;

/**
 * Form controller class
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/quickform/
 */
class CRM_Card_Form_ContributionPage_Setting extends CRM_Contribute_Form_ContributionPage {

  public function buildQuickForm() {
    $this->add('checkbox', 'is_membership_card_enabled', E::ts('Should Membership Card attached to email?'));
    $attribute = ['class' => 'crm-select2', 'placeholder' => E::ts('- any -')];
    $cardList = CRM_Card_Utils::getCardList();
    $this->add('select', 'card_id', 'Card List', $cardList, FALSE, $attribute);
    if ($this->_action & CRM_Core_Action::UPDATE && !empty($this->_id)) {
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      $this->setDefaults(['is_membership_card_enabled' => $settings->get('online_membership_is_membership_card_enabled_' . $this->_id)]);
      $this->setDefaults(['card_id' => $settings->get('online_membership_card_id_' . $this->_id)]);
    }

    $this->addButtons([
      [
        'type' => 'submit',
        'name' => E::ts('Submit'),
        'isDefault' => TRUE,
      ],
    ]);

    // export form elements
    $this->assign('elementNames', $this->getRenderableElementNames());
    parent::buildQuickForm();
  }

  public function postProcess() {
    $values = $this->exportValues();
    if ($this->_id) {
      $id = $this->_id;
      $is_membership_card_enabled = $values['is_membership_card_enabled'] ?? NULL;
      $card_id = $values['card_id'] ?? NULL;
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      $settings->set('online_membership_is_membership_card_enabled_' . $id, $is_membership_card_enabled);
      $settings->set('online_membership_card_id_' . $id, $card_id);
    }
    parent::postProcess();
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
    $elementNames = array();
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
