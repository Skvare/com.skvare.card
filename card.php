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
 * Implements hook_civicrm_xmlMenu().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_xmlMenu
 */
function card_civicrm_xmlMenu(&$files) {
  _card_civix_civicrm_xmlMenu($files);
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
 * Implements hook_civicrm_postInstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_postInstall
 */
function card_civicrm_postInstall() {
  _card_civix_civicrm_postInstall();
}

/**
 * Implements hook_civicrm_uninstall().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_uninstall
 */
function card_civicrm_uninstall() {
  _card_civix_civicrm_uninstall();
}

/**
 * Implements hook_civicrm_enable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_enable
 */
function card_civicrm_enable() {
  _card_civix_civicrm_enable();
}

/**
 * Implements hook_civicrm_disable().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_disable
 */
function card_civicrm_disable() {
  _card_civix_civicrm_disable();
}

/**
 * Implements hook_civicrm_upgrade().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_upgrade
 */
function card_civicrm_upgrade($op, CRM_Queue_Queue $queue = NULL) {
  return _card_civix_civicrm_upgrade($op, $queue);
}

/**
 * Implements hook_civicrm_managed().
 *
 * Generate a list of entities to create/deactivate/delete when this module
 * is installed, disabled, uninstalled.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_managed
 */
function card_civicrm_managed(&$entities) {
  _card_civix_civicrm_managed($entities);
}

/**
 * Implements hook_civicrm_caseTypes().
 *
 * Generate a list of case-types.
 *
 * Note: This hook only runs in CiviCRM 4.4+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_caseTypes
 */
function card_civicrm_caseTypes(&$caseTypes) {
  _card_civix_civicrm_caseTypes($caseTypes);
}

/**
 * Implements hook_civicrm_angularModules().
 *
 * Generate a list of Angular modules.
 *
 * Note: This hook only runs in CiviCRM 4.5+. It may
 * use features only available in v4.6+.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_angularModules
 */
function card_civicrm_angularModules(&$angularModules) {
  _card_civix_civicrm_angularModules($angularModules);
}

/**
 * Implements hook_civicrm_alterSettingsFolders().
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_alterSettingsFolders
 */
function card_civicrm_alterSettingsFolders(&$metaDataFolders = NULL) {
  _card_civix_civicrm_alterSettingsFolders($metaDataFolders);
}

/**
 * Implements hook_civicrm_entityTypes().
 *
 * Declare entity types provided by this module.
 *
 * @link https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
 */
function card_civicrm_entityTypes(&$entityTypes) {
  _card_civix_civicrm_entityTypes($entityTypes);
}

/**
 * Implements hook_civicrm_thems().
 */
function card_civicrm_themes(&$themes) {
  _card_civix_civicrm_themes($themes);
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
    'label' => E::ts('Cards Setting'),
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

/*
 * Implementation of hook_civicrm_alterMailParams
 */
function members_civicrm_alterMailParams(&$params, $context) {
}

function card_civicrm_buildForm($fname, &$form) {
  if (in_array($fname, ['CRM_Admin_Form_ScheduleReminders'])) {
    $form->add('checkbox', 'is_membership_card_enabled', E::ts('Should Membership Card attached to email?'));
    $attribute = ['class' => 'crm-select2', 'placeholder' => E::ts('- any -')];
    $cardList = CRM_Card_Utils::getCardList();
    $form->add('select', 'card_id', 'Card List', $cardList, FALSE, $attribute);
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
