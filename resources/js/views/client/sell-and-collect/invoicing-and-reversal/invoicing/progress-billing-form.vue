<template>
    <div>
        <div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Customer</label>
                        <select class="form-select-customer" v-model="formdata.customer_uuid" :options="options_customer" name="customer"></select>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Branch</label>
                        <input type="text" class="form-control disabled" v-model="branch_name" readonly >
                    </div>
                </div>


                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Amount payable</label>
                        <input v-model="formdata.amount" type="text" class="form-control" >
                    </div>
                </div>
                
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Location</label>
                        <select class="form-select-branch-location" v-model="selected_branch_location" :options="options_branch_location" name="branch-location"></select>
                    </div>
                </div>
            </div>
        </div>
        <br/>

        <div style="padding:10px 0px; text-align:right;">
            <button v-if="formdata.amount > 0" style="max-width:150px; display:inline-block;"  @click="save()" class="hx-btn hx-btn-shineblue" type="button" data-toggle="modal" href="javascript:void(0)">Next</button>
            <button v-else style="max-width:150px; display:inline-block;"  class="hx-btn hx-btn-shineblue" type="button" data-toggle="modal" href="javascript:void(0)" disabled="true">Next</button>

        </div>
    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'sell-and-collect-progress-billing-form',
    props: ['properties'],
    data: function () {
        return {
            formdata: {
                type: 'Expenses',
                uuid: null,
                amount: 0.00,
                customer_uuid: null,
                branch_location_uuid: null,
            },
            selected_customer: [],
            options_customer: [],

            selected_branch: [],
            options_branch: [],

            selected_branch_location: null,
            options_branch_location: [],

            branch_name: '',

            expenses: [],
        }
    },
    computed: {
      
    },
    methods: {

        getBranches: function () {
           var scope = this
            scope.GET('users/get-branch').then(res => {
                scope.branch_name = res.rows.branch_name
                scope.formdata.branch_uuid = res.rows.branch_uuid
            })
        },
        getBranchLocations: function () {
           var scope = this
            scope.GET('users/get-branch-locations').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_branch_location.push({
                        id: data.uuid,
                        text: data.location_name
                    })
                
                })
                
                $(".form-select-branch-location").select2({data: scope.options_branch_location});
                scope.selected_branch_location = scope.options_branch_location[0].id
            })
        },


        getCustomer: function () {
           var scope = this
            scope.GET('customers').then(res => {

                res.rows.forEach(function (data) {

                    scope.options_customer.push({
                        id: data.uuid,
                        text: data.sold_to_name,
                        vat_uuid: data.vat_uuid
                    })
                
                })

                scope.formdata.customer_uuid = scope.options_customer[0].uuid

                if (scope.options_customer[0].vat_uuid!==null){

                } else{

                }

                setTimeout(function(){
                    $(".form-select-customer").select2({data: scope.options_customer});
                    $(".form-select-customer").trigger('change');
                },300);
                
            })
        },
        save: function() {
            var scope = this

            scope.formdata.branch_location_uuid = scope.selected_branch_location

            var qs = jQuery.param( scope.formdata );
            scope.ROUTE({path: '/buy-and-pay/bills/create?' + qs })
            return
        },
    },
    mounted() {
        var scope = this
       scope.getCustomer();
       scope.getBranches();
       scope.getBranchLocations();


       $(".form-select-customer").on('change',function(){
            var id = $(".form-select-customer").val()
            scope.formdata.customer_uuid = id
        });

        $('.form-select-branch-location').on("change", function(e) { 
            scope.selected_branch_location = $('.form-select-branch-location').val();
        })

        
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}
</style>