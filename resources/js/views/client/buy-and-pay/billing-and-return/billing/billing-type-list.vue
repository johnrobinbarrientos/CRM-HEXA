<template>
    <div>
        <div class="hx-tab-1 round">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">    

                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#expenses" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Expenses</span>    
                    </a> 
                </li> 
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#fixed-asset" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Fixed Asset</span>    
                    </a> 
                </li> 
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#inventory" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Inventory</span>    
                    </a> 
                </li> 
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="inventory" role="tabpanel">        
                    <inventory-to-bill-list></inventory-to-bill-list>
                </div>
                <div class="tab-pane" id="fixed-asset" role="tabpanel">        
                    <inventory-to-bill-list></inventory-to-bill-list>
                </div>
                <div class="tab-pane" id="expenses" role="tabpanel">        
                    <expense-form></expense-form>
                </div> 
            </div>
        </div>
    </div>
</template>

<script>

import InventoryToBillList from './inventory/inventory-to-bill-list'
import ExpenseForm from './expenses/form'

export default {
    name: 'billing-type-list',
    props: ['properties'],
    data: function () {
        return {
        }
    },
    components: {
        'inventory-to-bill-list' : InventoryToBillList,
        'expense-form' : ExpenseForm,
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