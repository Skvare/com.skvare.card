<?php

/**
 * @package CRM
 * @copyright CiviCRM LLC https://civicrm.org/licensing
 *
 * Generated from com.skvare.card/xml/schema/CRM/Card/CardHtml.xml
 * DO NOT EDIT.  Generated by CRM_Core_CodeGen
 * (GenCodeChecksum:be8449ab069aa5bea7958d5d296c83ca)
 */
use CRM_Card_ExtensionUtil as E;

/**
 * Database access object for the CardHtml entity.
 */
class CRM_Card_DAO_CardHtml extends CRM_Core_DAO {
  const EXT = E::LONG_NAME;
  const TABLE_ADDED = '';

  /**
   * Static instance to hold the table name.
   *
   * @var string
   */
  public static $_tableName = 'civicrm_card_html';

  /**
   * Should CiviCRM log any modifications to this table in the civicrm_log table.
   *
   * @var bool
   */
  public static $_log = FALSE;

  /**
   * Unique Card Html ID
   *
   * @var int
   */
  public $id;

  /**
   * Cart Title
   *
   * @var string
   */
  public $title;

  /**
   * Front html of card
   *
   * @var longtext
   */
  public $front_html;

  /**
   * Front html css.
   *
   * @var longtext
   */
  public $front_css;

  /**
   * Back Side html of card.
   *
   * @var longtext
   */
  public $back_html;

  /**
   * Back side html css.
   *
   * @var longtext
   */
  public $back_css;

  /**
   * Is this Card Html Active.
   *
   * @var bool
   */
  public $is_active;

  /**
   * Class constructor.
   */
  public function __construct() {
    $this->__table = 'civicrm_card_html';
    parent::__construct();
  }

  /**
   * Returns localized title of this entity.
   *
   * @param bool $plural
   *   Whether to return the plural version of the title.
   */
  public static function getEntityTitle($plural = FALSE) {
    return $plural ? E::ts('Card Htmls') : E::ts('Card Html');
  }

  /**
   * Returns all the column names of this table
   *
   * @return array
   */
  public static function &fields() {
    if (!isset(Civi::$statics[__CLASS__]['fields'])) {
      Civi::$statics[__CLASS__]['fields'] = [
        'id' => [
          'name' => 'id',
          'type' => CRM_Utils_Type::T_INT,
          'description' => E::ts('Unique Card Html ID'),
          'required' => TRUE,
          'where' => 'civicrm_card_html.id',
          'table_name' => 'civicrm_card_html',
          'entity' => 'CardHtml',
          'bao' => 'CRM_Card_DAO_CardHtml',
          'localizable' => 0,
          'readonly' => TRUE,
          'add' => NULL,
        ],
        'title' => [
          'name' => 'title',
          'type' => CRM_Utils_Type::T_STRING,
          'title' => E::ts('Title'),
          'description' => E::ts('Cart Title'),
          'maxlength' => 255,
          'size' => CRM_Utils_Type::HUGE,
          'where' => 'civicrm_card_html.title',
          'table_name' => 'civicrm_card_html',
          'entity' => 'CardHtml',
          'bao' => 'CRM_Card_DAO_CardHtml',
          'localizable' => 0,
          'add' => NULL,
        ],
        'front_html' => [
          'name' => 'front_html',
          'type' => CRM_Utils_Type::T_LONGTEXT,
          'title' => E::ts('Front Html'),
          'description' => E::ts('Front html of card'),
          'where' => 'civicrm_card_html.front_html',
          'table_name' => 'civicrm_card_html',
          'entity' => 'CardHtml',
          'bao' => 'CRM_Card_DAO_CardHtml',
          'localizable' => 0,
          'html' => [
            'label' => E::ts("Front HTML"),
          ],
          'add' => NULL,
        ],
        'front_css' => [
          'name' => 'front_css',
          'type' => CRM_Utils_Type::T_LONGTEXT,
          'title' => E::ts('Front Css'),
          'description' => E::ts('Front html css.'),
          'where' => 'civicrm_card_html.front_css',
          'table_name' => 'civicrm_card_html',
          'entity' => 'CardHtml',
          'bao' => 'CRM_Card_DAO_CardHtml',
          'localizable' => 0,
          'html' => [
            'label' => E::ts("Front HTML CSS"),
          ],
          'add' => NULL,
        ],
        'back_html' => [
          'name' => 'back_html',
          'type' => CRM_Utils_Type::T_LONGTEXT,
          'title' => E::ts('Back Html'),
          'description' => E::ts('Back Side html of card.'),
          'where' => 'civicrm_card_html.back_html',
          'table_name' => 'civicrm_card_html',
          'entity' => 'CardHtml',
          'bao' => 'CRM_Card_DAO_CardHtml',
          'localizable' => 0,
          'html' => [
            'label' => E::ts("Back Side HTML"),
          ],
          'add' => NULL,
        ],
        'back_css' => [
          'name' => 'back_css',
          'type' => CRM_Utils_Type::T_LONGTEXT,
          'title' => E::ts('Back Css'),
          'description' => E::ts('Back side html css.'),
          'where' => 'civicrm_card_html.back_css',
          'table_name' => 'civicrm_card_html',
          'entity' => 'CardHtml',
          'bao' => 'CRM_Card_DAO_CardHtml',
          'localizable' => 0,
          'html' => [
            'label' => E::ts("Back Side html CSS"),
          ],
          'add' => NULL,
        ],
        'cardhtml_is_active' => [
          'name' => 'is_active',
          'type' => CRM_Utils_Type::T_BOOLEAN,
          'title' => E::ts('Is Active'),
          'description' => E::ts('Is this Card Html Active.'),
          'where' => 'civicrm_card_html.is_active',
          'default' => '1',
          'table_name' => 'civicrm_card_html',
          'entity' => 'CardHtml',
          'bao' => 'CRM_Card_DAO_CardHtml',
          'localizable' => 0,
          'html' => [
            'type' => 'CheckBox',
          ],
          'add' => '5.39',
        ],
      ];
      CRM_Core_DAO_AllCoreTables::invoke(__CLASS__, 'fields_callback', Civi::$statics[__CLASS__]['fields']);
    }
    return Civi::$statics[__CLASS__]['fields'];
  }

  /**
   * Return a mapping from field-name to the corresponding key (as used in fields()).
   *
   * @return array
   *   Array(string $name => string $uniqueName).
   */
  public static function &fieldKeys() {
    if (!isset(Civi::$statics[__CLASS__]['fieldKeys'])) {
      Civi::$statics[__CLASS__]['fieldKeys'] = array_flip(CRM_Utils_Array::collect('name', self::fields()));
    }
    return Civi::$statics[__CLASS__]['fieldKeys'];
  }

  /**
   * Returns the names of this table
   *
   * @return string
   */
  public static function getTableName() {
    return self::$_tableName;
  }

  /**
   * Returns if this table needs to be logged
   *
   * @return bool
   */
  public function getLog() {
    return self::$_log;
  }

  /**
   * Returns the list of fields that can be imported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &import($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getImports(__CLASS__, 'card_html', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of fields that can be exported
   *
   * @param bool $prefix
   *
   * @return array
   */
  public static function &export($prefix = FALSE) {
    $r = CRM_Core_DAO_AllCoreTables::getExports(__CLASS__, 'card_html', $prefix, []);
    return $r;
  }

  /**
   * Returns the list of indices
   *
   * @param bool $localize
   *
   * @return array
   */
  public static function indices($localize = TRUE) {
    $indices = [];
    return ($localize && !empty($indices)) ? CRM_Core_DAO_AllCoreTables::multilingualize(__CLASS__, $indices) : $indices;
  }

}
