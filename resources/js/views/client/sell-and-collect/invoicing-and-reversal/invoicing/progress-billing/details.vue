<template>
<div>
        <div class="card hx-card-override">
            <div class="card-header">
                <h5 class="mb-0">General Information</h5>
            </div>

            <div class="card-body" >
                <div class="actions-bar">
                    <div class="w-100">
                        <h1 class="title">Progress Billings</h1>
                    </div>
                    <div class="bar-right">
                            <a @click="ROUTE({path: '/buy-and-pay/bills' });" class="hx-btn hx-btn-gray" data-toggle="modal" href="javascript:void(0)">
                                <span>Back</span>
                            </a>

                    </div>
                </div>
            </div>
        </div>

</div>

</template>


<script>

import moment from 'moment'

export default {
    name: 'progress-billing-details',
    data: function () {
        return {
            prerequiste: {
                getBillDetails: false,
            },

            bill: [],

            DRAFT: true,
            ACTION: 'view',

        }
    },
    watch: {
        ready: function (val) {
            var scope = this
            if (val) {
                setTimeout(function(){

                },500)
            }
        },
        
    },
    computed: {
        ready: function () {
            var scope = this

            if (scope.prerequiste.getBillDetails) {
                return true
            }

            return false
        },
    },
    methods: {


        getBillDetails: function (bill_uuid) {
            var scope = this
  
            var URL = (!scope.DRAFT) ? 'sell-and-collect/bills/' + bill_uuid + '/progress-bilings' : 'sell-and-collect/bills/draft' + window.location.search;

            scope.GET(URL).then(res => {

                scope.bill = res.data
                console.log(scope.bill)

                scope.prerequiste.getBillDetails = true
            })
        },


    },
    mounted() {
        var scope = this

        var bill_uuid = scope.$route.params.bill_uuid;

        scope.ACTION = ( scope.$route.params.action) ? scope.$route.params.action : 'edit';
        scope.DRAFT = (!bill_uuid) ? true : false

        scope.getBillDetails(bill_uuid)

    },
}
</script>



<style scoped>

</style>