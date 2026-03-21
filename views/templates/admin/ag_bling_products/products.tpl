<div class='panel' id="productsApp">
    <div class="panel-heading">Produtos <span class="badge">{{ qtyProducts }}</span></div>

    <agprogress-bar v-if="status.bulkGeneratingSku":percent="percent" :label="'Gerador de SKU'"></agprogress-bar>

    <agtable
        :columns-definition="columnsDefinition"
        :columns-data="presentProducts"
        :bulk-actions="bulkActions"
        v-on:select-all="selectAll"
        v-on:unselect-all="unselectAll"
        v-on:toggle="toggle"
        v-on:bulk-action-clicked="bulkActionClicked"
        v-on:search="reloadGrid"
    ></agtable>
</div>