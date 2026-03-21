let app;
window.addEventListener('load', function(){
    let products = agbling.products;
    let percent=0;
    for (let i in products) {
        products[i].selected = false;
    }

    app = new Vue({
        el: '#productsApp',
        data: {
            columnsDefinition: [
                {
					title: 'SKU',
					name: 'sku',
                    filter: {
                        type: 'text',
                        value: ''
                    }
                },
                {
					title: 'Nome',
					name: 'name'
                },
                {
					title: 'Prod/Comb',
					name: 'type',
					class: 'fixed-width-sm'
                },
                {
					title: 'Situação',
					name: 'status',
					class: 'fixed-width-sm',
                    filter: {
                        type: 'bool'
                    }
                },
                {
					title: 'Publicado',
					name: 'published',
					class: 'fixed-width-sm',
                    filter: {
                        type: 'bool'
                    }
                },
                {
					title: 'Estoque',
					name: 'stock',
					class: 'fixed-width-sm'
                },
                {
					title: 'Preço',
					name: 'price',
					class: 'fixed-width-sm'
                },
                {
                    title: 'Ações',
                    name: 'actions',
                    class: 'fixed-width-sm'
                }
            ],
            bulkActions: [
                {
                    label: 'Gerar SKU',
                    name: "generateSku"
                }
            ],
            status: {
                bulkGeneratingSku: false
            },
            products: products,
            qtyProducts: agbling.qtyProducts,
            percent: percent
        },
        computed: {
            presentProducts: function(){
                let ret = [];

                for (i in this.products) {
                    let product = this.products[i];

                    ret.push({
                        checked: product.selected,
                        obj: product,
                        sku: {
                            value: product.reference
                        },
                        name: {
                            value: product.type == 'Combinação' ? product.product_name + "<br/>" + product.name : product.name ,
                            type: 'html'
                        },
                        type: {
                            value: product.type
                        },
                        stock: {
                            value: product.stock
                        },
                        price: {
                            value: product.price
                        },
                        var: {
                            value: product.price
                        },
                        published: {
                            value: product.published == '1'? 'Sim' : 'Não'
                        },
                        status: {
                            value: product.active == '1' ?  'Ativo' : 'Inativo'
                        },
                        actions: {
                            type: 'component',
                            component: 'agblingProductActions',
                            props: {
                                product: agbling.products[i]
                            },
                            listeners: {
                                generateSkuClicked: async function(prod){
                                    if (confirm("Deseja realmente gerar um novo SKU para esse produto?")) {
                                        await app.generateSku(prod.id_product, prod.id_product_attribute);
                                        await app.reloadGrid();
                                    }
                                }
                            }
                        }
                    });
                }

                return ret;
            },
            selectedProducts: function(){
                return this.products.filter(p => p.selected);
            },
            showLoading: function(){
                return this.status.bulkGeneratingSku;
            }
        },
        methods: {
            generateSku: async function (idProduct, idProductAttribute)
            {
                let data = new FormData;
                data.set('idProduct', idProduct);
                if (idProductAttribute !== undefined) {
                    data.set('idProductAttribute', idProductAttribute);
                }
                
                data.set('action', 'generateSku');

                let r = await axios.post(location.href, data);
            },
            reloadGrid: async function()
            {
                let data = new FormData;
                data.set('action', 'refreshGridData');

                for await(column of this.columnsDefinition) {
                    if (column.filter != null && column.filter.value !== undefined && column.filter.value !== '') {
                        data.set(`filter[${column.name}]`, column.filter.value);
                    }
                }

                let r = await axios.post(location.href, data);
                app.products = r.data.products;
                app.qtyProducts = r.data.qtyProducts;
            },
            selectAll: function()
            {
                for (i in this.products) {
                    this.products[i].selected = true;
                }
            },
            unselectAll: function()
            {
                for (i in this.products) {
                    this.products[i].selected = false;
                }
            },
            toggle: function(obj)
            {
                obj.selected = !obj.selected;
            },
            bulkActionClicked: async function(ba)
            {
                if (ba.name == 'generateSku') {
                    this.status.bulkGeneratingSku = true;

                    let products = [];

                    for (i in this.selectedProducts) {
                        if (!this.selectedProducts[i].reference) {
                            products.push(this.selectedProducts[i]);
                        }
                    }

                    let processed = 0;
                    for await (product of products) {
                        await this.generateSku(product.id_product, product.id_product_attribute);
                        processed++;
                        this.percent = 100 * processed / products.length;
                    }

                    this.status.bulkGeneratingSku = false;
                }
            },
        }
    })
});