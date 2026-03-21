Vue.component("agblingProductActions", {
    props: ['product'],
    template: `
        <span>
            <i class="icon icon-barcode" v-if="product.reference == ''" @click="generateSku" title="Gerar Código de Barras"></i>
        </span>
    `,
    methods: {
        generateSku: function(){
            this.$emit('generateSkuClicked', this.product);
        }
    }
});