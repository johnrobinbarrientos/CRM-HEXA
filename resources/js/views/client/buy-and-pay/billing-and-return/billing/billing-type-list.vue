<template>
    <div>
        <div v-if="proceed == false">
            <div class="hx-blurb-group">
                <div class="hx-blurb" :class="{ 'active' : billing_option == 'inventory' }" @click="billing_option = 'inventory'">
                    <div class="d-flex justify-content-between">
                        <div class="i-wrapper">
                            <i class="las la-boxes"></i>
                        </div>
                        <div>
                            <input type="radio" value="inventory" v-model="billing_option">
                        </div>
                    </div>
                    <strong>Inventory</strong>
                    <p>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</p>
                </div>
                <div class="hx-blurb" :class="{ 'active' : billing_option == 'fixed_asset' }" @click="billing_option = 'fixed_asset'">
                    <div class="d-flex justify-content-between">
                        <div class="i-wrapper">
                            <i class="las la-warehouse"></i>
                        </div>
                        <div>
                            <input type="radio" value="fixed_asset" v-model="billing_option">
                        </div>
                    </div>
                    <strong>Fixed Asset</strong>
                    <p>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</p>
                </div>
                <div class="hx-blurb" :class="{ 'active' : billing_option == 'expenses' }" @click="billing_option = 'expenses'">
                    <div class="d-flex justify-content-between">
                        <div class="i-wrapper">
                            <i class="las la-money-bill-alt"></i>
                        </div>
                        <div>
                            <input type="radio" value="expenses" v-model="billing_option">
                        </div>
                    </div>
                    <strong>Expenses</strong>
                    <p>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</p>
                </div>
            </div>
        </div>
        
        <div v-if="billing_option == 'inventory' && proceed == true">
            <inventory-to-bill-list></inventory-to-bill-list>
        </div>
        <div v-if="billing_option == 'fixed_asset' && proceed == true">
            <inventory-to-bill-list></inventory-to-bill-list>
        </div>
        <div v-if="billing_option == 'expenses' && proceed == true">
            <expense-form></expense-form>
        </div>

        <div v-if="proceed == false" class="text-right">
            <button @click="CLOSE_MODAL('#modalTypeList');" type="button" class="btn btn-sm hx-btn-gray" style="background: #fff;">Cancel</button>
            <button @click="onProceed()" type="button" class="btn btn-sm btn-primary">Proceed</button>
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
            billing_option: '',
            proceed: false,
        }
    },
    components: {
        'inventory-to-bill-list' : InventoryToBillList,
        'expense-form' : ExpenseForm,
    },
    computed: {

    },
    methods: {
        onProceed: function () {
            if (this.billing_option == '') {
                return
            }
            this.proceed = true
            const str = this.billing_option
            this.$emit('updateBreadcrumb', str.replace(/_/g, ' '))
        },
        resetData: function() {
            this.proceed = false
            this.billing_option = ''
        }
    },
    mounted() { },
}
</script>