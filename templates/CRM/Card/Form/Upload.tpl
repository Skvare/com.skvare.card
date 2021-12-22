{* HEADER *}

<div>
  <a  class="button no-popup nowrap"
      href="{crmURL p='civicrm/admin/card/list'
      q="reset=1"}">
    <i class="crm-i fa-back"></i><span> {ts}Back to Listing{/ts}</span>
  </a>
  <br/><br/>
</div>

<div id="help">
  <p>Card Html Form.</p>
</div>

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="top"}
</div>

{foreach from=$elementNames item=elementName}
  <div class="crm-section">
    <div class="label">{$form.$elementName.label}</div>
    <div class="content">{$form.$elementName.html}</div>
    <div class="clear"></div>
  </div>
{/foreach}

<div class="crm-submit-buttons">
{include file="CRM/common/formButtons.tpl" location="bottom"}
</div>
