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
