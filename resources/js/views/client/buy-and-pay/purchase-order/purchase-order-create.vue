<template>
    <div >
        <div class="hx-tab">
            <purchase-order-form :form="'full'" :order="null"></purchase-order-form>
        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2'
import moment from 'moment'
import PurchaseOrderForm from './purchase-order-form'

export default {
    name: 'purchase-order-create',
    props: ['properties'],
    components: {
        'purchase-order-form': PurchaseOrderForm
    },
    data: function () {
    },
    methods: {
       
    },
    mounted() {
       
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}
</style>