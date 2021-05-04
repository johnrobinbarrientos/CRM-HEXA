<template>
    <div>
        <div class="hx-tab-1 round">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">    

                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#reason-code" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Expenses</span>    
                    </a> 
                </li> 
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#debit-memo" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Fixed Asset</span>    
                    </a> 
                </li> 
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#billing-list" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Inventory</span>    
                    </a> 
                </li> 
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="billing-list" role="tabpanel">        

                </div>
                <div class="tab-pane" id="debit-memo" role="tabpanel">        

                </div>
                <div class="tab-pane" id="reason-code" role="tabpanel">        
                         
                    
                </div> 
            </div>
        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'
import ToBillList from './to-bill-list'
import ExpensesForm from './form-expenses'

export default {
    name: 'purchase-order',
    props: ['properties'],
    data: function () {
        return {
            type: 'Inventory'
        }
    },
    components: {
        'to-bill-list' : ToBillList,
        'expenses-form' : ExpensesForm,
    },
    computed: {

    },
    methods: {

    },
    mounted() {
        var scope = this
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>