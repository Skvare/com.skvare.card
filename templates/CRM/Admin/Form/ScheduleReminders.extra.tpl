{literal}
  <script type="text/javascript">
    CRM.$(function($) {
      $('#form-layout-compressed_card_id').insertAfter('.crm-scheduleReminder-form-block-active');
      $('#form-layout-compressed_is_membership_card_enabled').insertAfter('.crm-scheduleReminder-form-block-active');
    });
  </script>
{/literal}

<table id="form-layout-compressed_is_membership_card" class="form-layout-compressed"  style="display: none;">
  <tr id ="form-layout-compressed_is_membership_card_enabled" class="form-layout-compressed">
    <td class="label"></td>
    <td>{$form.is_membership_card_enabled.html} {$form.is_membership_card_enabled.label}</td>
  </tr>
  <tr id="form-layout-compressed_card_id" class="form-layout-compressed">
    <td class="label">{$form.card_id.label}</td>
    <td>{$form.card_id.html}</td>
  </tr>
</table>
