<div class='panel' id="ordersApp">
    <div class="panel-heading">Pedidos <span class="badge">{{ qtyOrders }}</span></div>

    <agtable
        :columns-definition="columnsDefinition"
        :columns-data="presentOrders"
        :bulk-actions="bulkActions"
        :display-filter="true"
        {* v-on:select-all="selectAll" *}
        {* v-on:unselect-all="unselectAll" *}
        {* v-on:toggle="toggle" *}
        {* v-on:bulk-action-clicked="bulkActionClicked" *}
        {* v-on:search="reloadGrid" *}
    ></agtable>
</div>