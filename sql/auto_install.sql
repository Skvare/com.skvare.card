-- +--------------------------------------------------------------------+
-- | Copyright CiviCRM LLC. All rights reserved.                        |
-- |                                                                    |
-- | This work is published under the GNU AGPLv3 license with some      |
-- | permitted exceptions and without any warranty. For full license    |
-- | and copyright information, see https://civicrm.org/licensing       |
-- +--------------------------------------------------------------------+
--
-- Generated from schema.tpl
-- DO NOT EDIT.  Generated by CRM_Core_CodeGen
--
-- /*******************************************************
-- *
-- * Clean up the existing tables - this section generated from drop.tpl
-- *
-- *******************************************************/

SET FOREIGN_KEY_CHECKS=0;

DROP TABLE IF EXISTS `civicrm_card_mapping`;
DROP TABLE IF EXISTS `civicrm_card_html`;

SET FOREIGN_KEY_CHECKS=1;
-- /*******************************************************
-- *
-- * Create new tables
-- *
-- *******************************************************/

-- /*******************************************************
-- *
-- * civicrm_card_html
-- *
-- * Card Html Design
-- *
-- *******************************************************/
CREATE TABLE `civicrm_card_html` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique Card Html ID',
  `title` varchar(255) COMMENT 'Cart Title',
  `front_html` longtext COMMENT 'Front html of card',
  `front_css` longtext COMMENT 'Front html css.',
  `back_html` longtext COMMENT 'Back Side html of card.',
  `back_css` longtext COMMENT 'Back side html css.',
  `is_active` tinyint DEFAULT 1 COMMENT 'Is this Card Html Active.',
  PRIMARY KEY (`id`)
)
ENGINE=InnoDB;

-- /*******************************************************
-- *
-- * civicrm_card_mapping
-- *
-- * FIXME
-- *
-- *******************************************************/
CREATE TABLE `civicrm_card_mapping` (
  `id` int unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unique Card ID',
  `template_id` int unsigned NOT NULL COMMENT 'Template ID',
  `entity_type` varchar(255) COMMENT 'Entity Type',
  `entity_mapping` varchar(255) COMMENT 'Entity Type',
  PRIMARY KEY (`id`),
  CONSTRAINT FK_civicrm_card_mapping_template_id FOREIGN KEY (`template_id`) REFERENCES `civicrm_card_html`(`id`) ON DELETE CASCADE
)
ENGINE=InnoDB;
