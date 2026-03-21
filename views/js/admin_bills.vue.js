let app;
window.addEventListener('load', function(){
    let bills = agbling.bills;
   

    app = new Vue({
        el: '#billsApp',
        data: {
            columnsDefinition: [
                {
                    name: 'id_bling',
                    title: 'ID Bling'
                },
                {
                    name: 'situacao',
                    title: 'Status Bling'
                },
                {
                    name: 'valor',
                    title: 'Valor'
                },
                {
                    name: 'cliente',
                    title: 'Cliente'
                },
                {
                    name: 'estadoPs',
                    title: 'estadoPs'
                },
                {
                    name: 'pedido',
                    title: 'Referência PS'
                },
                {
                    name: 'vencimento',
                    title: 'Vencimento'
                },
            ],
            bills: bills,
        },
        computed: {
            presentBills: function(){
                let ret = [];

                for (i in this.bills) {
                    let bills = this.bills[i];

                    ret.push({
                        id_bling: {
                            value: bills.id_bling
                        },
                        situacao: {
                            value: bills.situacao
                        },
                        valor: {
                            value: bills.valor
                        },
                        cliente: {
                            value: bills.cliente
                        },
                        estadoPs: {
                            value: bills.estadoPs
                        },
                        pedido: {
                            value: bills.pedido
                        },
                        vencimento: {
                            value: bills.vencimento
                        },
                        
                    });
                }

                return ret;
            },
          
        },
    })
});