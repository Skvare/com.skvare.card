<?php

require_once 'card.civix.php';
// phpcs:disable
use CRM_Card_ExtensionUtil as E;
// phpcs:enable

/**
 * Implements hook_civicrm_config().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_config/
 */
function card_civicrm_config(&$config) {
  _card_civix_civicrm_config($config);
}

/**
 * Implements hook_civicrm_install().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_install
 */
function card_civicrm_install() {
  _card_civix_civicrm_install();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function card_civicrm_enable() {
  _card_civix_civicrm_enable();
}

// --- Functions below this ship commented out. Uncomment as required. ---

/**
 * Implements hook_civicrm_preProcess().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_preProcess
 */
//function card_civicrm_preProcess($formName, &$form) {
//
//}

/**
 * Implements hook_civicrm_navigationMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_navigationMenu
 */
function card_civicrm_navigationMenu(&$menu) {
  _card_civix_insert_navigation_menu($menu, 'Administer/System Settings', [
    'label' => E::ts('Card Setting'),
    'name' => 'card_lists',
    'url' => CRM_Utils_System::url('civicrm/admin/setting/card', 'reset=1', TRUE),
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ]);
  _card_civix_insert_navigation_menu($menu, 'Administer/System Settings', [
    'label' => E::ts('List Cards'),
    'name' => 'card_lists',
    'url' => CRM_Utils_System::url('civicrm/admin/card/list', 'reset=1', TRUE),
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ]);
  _card_civix_insert_navigation_menu($menu, 'Administer/System Settings', [
    'label' => E::ts('List Mapping'),
    'name' => 'card_lists_mapping',
    'url' => CRM_Utils_System::url('civicrm/admin/card/mapping', 'reset=1', TRUE),
    'permission' => 'administer CiviCRM',
    'operator' => 'OR',
    'separator' => 0,
  ]);
  _card_civix_navigationMenu($menu);
}

/*
 * Implementation of hook_civicrm_alterMailParams
 */
function card_civicrm_alterMailParams(&$params) {
  if (!empty($params['groupName']) && $params['groupName'] == 'Scheduled Reminder Sender'
    && $params['entity'] == 'action_schedule' && !empty($params['entity_id'])) {
    $domainID = CRM_Core_Config::domainID();
    $settings = Civi::settings($domainID);
    // check schedule reminder enabled to card membership
    if (!empty($params['toContactID']) && $settings->get('schedule_reminders_is_membership_card_enabled_' . $params['entity_id'])) {
      $cardID = $settings->get('schedule_reminders_card_id_' . $params['entity_id']);
      if ($cardID && $params['toContactID']) {
        CRM_Card_Utils::attachPdf($params, $cardID, $params['toContactID']);
      }
    }
  }
  elseif (($params['groupName'] == 'msg_tpl_workflow_membership' && $params['valueName'] == 'membership_online_receipt')) {
    if (!empty($params['tplParams']['contributionPageId'])) {
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      if ($settings->get('online_membership_is_membership_card_enabled_' . $params['tplParams']['contributionPageId'])) {
        $cardID = $settings->get('online_membership_card_id_' . $params['tplParams']['contributionPageId']);
        // IF card already attached then return from here.
        if (!empty($params['card_processed_' . $params['contactId']])) {
          return;
        }
        if ($cardID && $params['contactId']) {
          CRM_Card_Utils::attachPdf($params, $cardID, $params['contactId']);
        }
      }
    }
  }
}

function card_civicrm_buildForm($fname, &$form) {
  if (in_array($fname, ['CRM_Admin_Form_ScheduleReminders'])) {
    $form->add('checkbox', 'is_membership_card_enabled', E::ts('Should Membership Card attached to email?'));
    $attribute = ['class' => 'crm-select2', 'placeholder' => E::ts('- any -')];
    $cardList = CRM_Card_Utils::getCardList();
    $form->add('select', 'card_id', E::ts('Card List'), $cardList, FALSE, $attribute);
    if ($form->_action & CRM_Core_Action::UPDATE && !empty($form->_id)) {
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      $form->setDefaults(['is_membership_card_enabled' => $settings->get('schedule_reminders_is_membership_card_enabled_' . $form->_id)]);
      $form->setDefaults(['card_id' => $settings->get('schedule_reminders_card_id_' . $form->_id)]);
    }
  }
}

/**
 * Implementation of hook_civicrm_postProcess()
 *
 * Record information about a discount use.
 */
function card_civicrm_postProcess($class, &$form) {
  if (in_array($class, ['CRM_Admin_Form_ScheduleReminders'])) {
    if ($form->get('id')) {
      $id = $form->get('id');
      $is_membership_card_enabled = $form->_submitValues['is_membership_card_enabled'] ?? NULL;
      $card_id = $form->_submitValues['card_id'] ?? NULL;
      $domainID = CRM_Core_Config::domainID();
      $settings = Civi::settings($domainID);
      $settings->set('schedule_reminders_is_membership_card_enabled_' . $id, $is_membership_card_enabled);
      $settings->set('schedule_reminders_card_id_' . $id, $card_id);
    }
  }
}

/**
 * Implementation of hook_civicrm_tabset
 *
 * Insert the "Card" tab into the Contribution page edit workflow
 */
function card_civicrm_tabset($tabsetName, &$tabs, $context) {
  $contribution_page_id = CRM_Utils_Array::value('contribution_page_id', $context);

  if ($tabsetName == 'civicrm/admin/contribute' && $contribution_page_id) {
    $url = CRM_Utils_System::url('civicrm/admin/contribute/card',
      "reset=1&action=update&id=" . $contribution_page_id);

    $tabs['card'] = [
      'title' => E::ts('Card', ['domain' => 'com.skvare.card']),
      'url' => $url,
      'active' => TRUE,
      'class' => 'ajaxForm',
    ];
  }
}
