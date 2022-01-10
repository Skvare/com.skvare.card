<div>
  <a  class="button no-popup nowrap"
      href="{crmURL p='civicrm/admin/card/upload'
      q="reset=1&action=add"}">
    <i class="crm-i fa-add"></i><span> {ts}Add New Card{/ts}</span>
  </a>
  <br/><br/>
</div>
<div class="crm-block crm-content-block crm-voucher-view-form-block">
  <table class="selector row-highlight">
    <tr>
      <th class="col">{ts}Card Html ID{/ts}</th>
      <th class="col">{ts}Cart Title{/ts}</th>
      <th class="col"></th>
    </tr>
      {foreach from=$cartHtml item=row}
          {if $row}
            <tr>
              <td>{$row.id}</td>
              <td>{$row.title}</td>
              <td><a href="{$row.link_update}">Update</a> <a href="{$row.link_preview}">Preview</a></td>
            </tr>
          {/if}
      {/foreach}
    </tr>
  </table>
</div>
