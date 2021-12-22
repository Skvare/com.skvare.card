<?php
use CRM_Card_ExtensionUtil as E;

/**
 * CardHtml.Get API specification (optional)
 * This is used for documentation and validation.
 *
 * @param array $spec description of fields supported by this API call
 *
 * @see https://docs.civicrm.org/dev/en/latest/framework/api-architecture/
 */
function _civicrm_api3_card_html_Get_spec(&$spec) {
}

/**
 * CardHtml.Get API
 *
 * @param array $params
 *
 * @return array
 *   API result descriptor
 *
 * @see civicrm_api3_create_success
 *
 * @throws API_Exception
 */
function civicrm_api3_card_html_Get($params) {
  $result = _civicrm_api3_basic_get(_civicrm_api3_get_BAO(__FUNCTION__),
    $params, FALSE, 'CardHtml');
  return civicrm_api3_create_success($result, $params, 'CardHtml', 'Get');
}
