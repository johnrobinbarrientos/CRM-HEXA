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
                <div class="hx-blurb" :class="{ 'active' : billing_option == 'progress_billing' }" @click="billing_option = 'progress_billing'">
                    <div class="d-flex justify-content-between">
                        <div class="i-wrapper">
                            <i class="las la-money-bill-alt"></i>
                        </div>
                        <div>
                            <input type="radio" value="progress_billing" v-model="billing_option">
                        </div>
                    </div>
                    <strong>Progress Billing</strong>
                    <p>Leverage agile frameworks to provide a robust synopsis for high level overviews. Iterative approaches to corporate strategy foster collaborative thinking to further the overall value proposition.</p>
                </div>
            </div>
        </div>
        
        <div v-if="billing_option == 'inventory' && proceed == true">

        </div>
        <div v-if="billing_option == 'fixed_asset' && proceed == true">

        </div>
        <div v-if="billing_option == 'progress_billing' && proceed == true">
            <progress-form></progress-form>
        </div>

        <div v-if="proceed == false" class="text-right">
            <button @click="CLOSE_MODAL('#modalTypeList');" type="button" class="btn btn-sm hx-btn-gray" style="background: #fff;">Cancel</button>
            <button @click="onProceed()" type="button" class="btn btn-sm btn-primary">Proceed</button>
        </div>
    </div>
</template>

<script>

import ProgressForm from './progress-billing/form'

export default {
    name: 'invoicing-type-list',
    props: ['properties'],
    data: function () {
        return {
            billing_option: '',
            proceed: false,
        }
    },
    components: {
        'progress-form' : ProgressForm,
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
    mounted() {
        var scope = this
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>