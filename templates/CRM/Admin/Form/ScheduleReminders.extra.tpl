{literal}
  <script type="text/javascript">
    CRM.$(function($) {
      $('#form-layout-compressed_is_membership_card_enabled').insertAfter('#editMessageDetails');
    });
  </script>
{/literal}

<table id="form-layout-compressed_is_membership_card_enabled" class="form-layout-compressed">
  <tr class="crm-message_template-form-block-is_membership_card_enabled">
    <td>{$form.is_membership_card_enabled.html}</td>
    <td class="label-left">{$form.is_membership_card_enabled.label}</td>
  </tr>
</table>
