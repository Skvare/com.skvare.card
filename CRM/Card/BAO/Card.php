<?php
use CRM_Card_ExtensionUtil as E;

class CRM_Card_BAO_Card extends CRM_Card_DAO_Card {

  /**
   * Create a new Card based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Card_DAO_Card|NULL
   *
  public static function create($params) {
    $className = 'CRM_Card_DAO_Card';
    $entityName = 'Card';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  } */

}
