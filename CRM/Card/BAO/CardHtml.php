<?php
use CRM_Card_ExtensionUtil as E;

class CRM_Card_BAO_CardHtml extends CRM_Card_DAO_CardHtml {

  /**
   * Create a new CardHtml based on array-data
   *
   * @param array $params key-value pairs
   * @return CRM_Card_DAO_CardHtml|NULL
   */
  public static function create($params) {
    $className = 'CRM_Card_DAO_CardHtml';
    $entityName = 'CardHtml';
    $hook = empty($params['id']) ? 'create' : 'edit';

    CRM_Utils_Hook::pre($hook, $entityName, CRM_Utils_Array::value('id', $params), $params);
    $instance = new $className();
    $instance->copyValues($params);
    $instance->save();
    CRM_Utils_Hook::post($hook, $entityName, $instance->id, $instance);

    return $instance;
  }

  static function retrieve($params, &$defaults) {
    if (empty($params)) {
      return NULL;
    }
    $CardHtml = new CRM_Card_DAO_CardHtml();

    $CardHtml->copyValues($params);

    if ($CardHtml->find(TRUE)) {
      $defaults = $CardHtml->toArray();
      foreach ($defaults as &$value) {
        if (!empty($value)) {
          $value = html_entity_decode($value);
        }
      }

      return $CardHtml;
    }
    $null = NULL; // return by reference

    return $null;
  }

}
