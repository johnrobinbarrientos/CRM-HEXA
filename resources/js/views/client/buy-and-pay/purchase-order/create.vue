<template>
    <div >
        <div class="hx-tab">
            <form :form="'full'" :order="null"></form>
        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2'
import moment from 'moment'
import PurchaseOrderForm from './form'

export default {
    name: 'purchase-order-create',
    props: ['properties'],
    components: {
        'form': PurchaseOrderForm
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