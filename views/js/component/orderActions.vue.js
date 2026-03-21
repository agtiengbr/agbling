Vue.component('agbling-orders-row-actions', {
    props: ['order'],
    template:
    `
        <div>
            <a v-if="order.in_bling == 0 && order.send_to_bling == 0" class="btn btn-default" title="Enviar ao Bling" @click.prevent="sendToBling"><i class="icon icon-upload"></i></a>

            <a v-if="order.in_bling == 0 && order.send_to_bling == 1" class="btn btn-default" title="Não enviar ao Bling" @click.prevent="dontSendToBling"><i class="icon icon-times"></i></a>
        </div>
    `,
    methods: {
        sendToBling: function(){
            this.$emit("send-to-bling", this.order);
        },
        dontSendToBling: function(){
            this.$emit("dont-send-to-bling", this.order);
        }
    }
})