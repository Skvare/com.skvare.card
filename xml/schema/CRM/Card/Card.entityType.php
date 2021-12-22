<?php
// This file declares a new entity type. For more details, see "hook_civicrm_entityTypes" at:
// https://docs.civicrm.org/dev/en/latest/hooks/hook_civicrm_entityTypes
return [
  [
    'name' => 'Card',
    'class' => 'CRM_Card_DAO_Card',
    'table' => 'civicrm_card_mapping',
  ],
];
