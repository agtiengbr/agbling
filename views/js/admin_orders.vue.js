let app;
window.addEventListener('load', function(){
    let orders = agbling.orders;
    let percent=0;
    for (let i in orders) {
        orders[i].selected = false;
    }

    app = new Vue({
        el: '#ordersApp',
        data: {
            columnsDefinition: [
                {
                    name: 'id_bling',
                    title: 'ID Bling'
                },
                {
                    name: 'reference',
                    title: 'Referência PS'
                },
                {
                    name: 'customer',
                    title: 'Cliente'
                },
                {
                    name: 'total',
                    title: 'Valor'
                },
                {
                    name: 'date',
                    title: 'Data'
                },
                {
                    name: 'ps_status',
                    title: 'Estado PS'
                },
                {
                    name: 'send_to_bling',
                    title: 'Enviar ao Bling'
                },
                {
                    name: 'actions',
                    title: 'Ações'
                }
            ],
            bulkActions: [
            ],
            status: {
            },
            orders: orders,
            qtyOrders: agbling.qtyOrders,
            percent: percent
        },
        computed: {
            presentOrders: function(){
                let ret = [];
                let that = this;

                $.each(this.orders, function(key, value){
                    ret.push({
                        id_bling: value.id_bling,
                        reference: value.reference,
                        customer: value.customer,
                        total: value.value,
                        date: value.date_add,
                        ps_status:value.order_state,
                        send_to_bling: value.send_to_bling,
                        in_bling: value.in_bling,
                        id_ps: value.id_ps,
                        actions: {
                            type: 'component',
                            component: 'agbling-orders-row-actions',
                            props: {
                                order: value
                            },
                            listeners: {
                                "send-to-bling" : function(order){
                                    that.sendToBling(order);
                                },
                                "dont-send-to-bling" : function(order){
                                    that.dontSendToBling(order);
                                }
                            }
                        }
                    })
                })
                return ret;
            },
        },
        methods: {
            sendToBling: async function(order)
            {
                let url = new URL(location.href);
                let params = url.searchParams;

                params.set('action', 'sendToBling');
                params.set('id_ps', order.id_ps);
                
                let r = await axios.post(url.toString());

                $.growl.notice({title: '', message: 'O pedido será enviado ao Bling em breve.'});
                this.orders = r.data.orders;
            },
            dontSendToBling: async function(order)
            {
                let url = new URL(location.href);
                let params = url.searchParams;

                params.set('action', 'dontSendToBling');
                params.set('id_ps', order.id_ps);
                
                let r = await axios.post(url.toString());

                $.growl.notice({title: '', message: 'O pedido não será mais enviado ao Bling.'});
                this.orders = r.data.orders;
            }
        }
    })
});