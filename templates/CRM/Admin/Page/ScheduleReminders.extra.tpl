{literal}
  <script type="text/javascript">
    CRM.$(function($) {
      $('#form-layout-compressed_card_id').insertAfter('#editMessageDetails');
      $('#form-layout-compressed_is_membership_card_enabled').insertAfter('#editMessageDetails');
    });
  </script>
{/literal}

<div id="form-layout-compressed_is_membership_card_enabled" class="section">
    {$form.is_membership_card_enabled.html}
    {$form.is_membership_card_enabled.label}
</div>
<div id="form-layout-compressed_card_id" class="section">
    {$form.card_id.label}  {$form.card_id.html}
</div>

