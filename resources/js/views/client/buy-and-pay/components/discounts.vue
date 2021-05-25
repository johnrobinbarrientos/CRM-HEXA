<template>
    <div id="discounts">
        <div class="row">
            <div class="col-md-6 col-12">
                <h4>Additional Discounts</h4>
                <div  v-for="(discount, index) in discounts.additionals" :key="index">
                    <div class="form-group">
                        <span>{{ (index + 1) }}. {{ discount.discount_name }} <span v-if="discount.discount_type == 'rate'">%</span></span>
                        <input  @keyup="changeAdditionalDiscount()" v-if=" discount.discount_type == 'rate'" v-model="discount.discount_rate" :disabled="view_mode" style="margin-top:5px; margin-bottom:5px; height:30px; min-height:30px; line-height:30px;" type="text" class="form-control">
                        <input  @keyup="changeAdditionalDiscount()" v-if="discount.discount_type == 'fixed'" v-model="discount.discount_fixed" :disabled="view_mode" style="margin-top:5px; margin-bottom:5px; height:30px; min-height:30px; line-height:30px;" type="text" class="form-control">
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-6">
                <h4>Discount Summary</h4>
                <table class="table table-bordered table-hover mb-0"> 
                    <thead>
                        <tr >
                            <!--<th width="30">#</th>-->
                            <th width="150">Discount Group</th>
                            <th>Discount Name</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(base_discount,index) in APPLIED_BASE_DISCOUNTS" :key="'base-discount-summary' + index">
                            <!--<th style="background:#77ade0;">
                                <span v-if="index == 0">1</span>
                            </th>-->
                            <th>
                                <span v-if="index == 0">Base</span>
                            </th>
                            <th>{{ base_discount.name }}</th>
                            <th class="text-right">{{ base_discount.rate }}%</th>
                            <th class="text-right">{{ parseFloat(base_discount.amount).toFixed(2) }}</th>
                        </tr>
                        <tr style="/*background:#abd1f5;*/" class="tr-grey">
                            <!--<th style="background:#77ade0;"></th>-->
                            <th colspan="2" style="border-bottom-color: #bbb !important;">Total</th>
                            <th class="text-right" style="border-bottom-color: #bbb !important;">{{ parseFloat(BASE_RATE_TOTAL).toFixed(2) }}%</th>
                            <th class="text-right" style="border-bottom-color: #bbb !important;">{{ parseFloat(BASE_AMOUNT_TOTAL).toFixed(2) }}</th>
                        </tr>
                        <tr v-for="(discount,index) in discounts.additionals" :key="'additional-discount-summary' + index">
                            <!--<th style="background:#77ade0;">
                                <span v-if="index == 0">2</span>
                            </th>-->
                            <th >
                                <span v-if="index == 0">Additional</span>
                            </th>
                            <th>{{ discount.discount_name }}</th>
                            <th class="text-right">{{ parseFloat(discount.discount_rate).toFixed(2) }}%</th>
                            <th class="text-right">{{ parseFloat(discount.discount_fixed).toFixed(2) }}</th>
                        </tr>
                        <tr style="/*background:#abd1f5;*/" class="tr-grey">
                            <!--<th></th>-->
                            <th style="border-bottom-color: #bbb !important;" colspan="2">Total</th>
                            <th class="text-right" style="border-bottom-color: #bbb !important;">{{ parseFloat(ADDITIONAL_RATE_TOTAL).toFixed(2) }}%</th>
                            <th class="text-right" style="border-bottom-color: #bbb !important;">{{ parseFloat(ADDITIONAL_AMOUNT_TOTAL).toFixed(2) }}</th>
                        </tr>
                        <tr v-for="(discount,index) in discounts.APPLIED_PRICE_RULE_DISCOUNTS" :key="'price-rule-discount-summary' + index">
                                <!--<th style="background:#77ade0;">
                                <span v-if="index == 0">3</span>
                            </th>-->
                            <th>
                                <span v-if="index == 0">Price Rule</span>
                            </th>
                            <th>{{ discount.price_rule_supplier.rule_name }}</th>
                            <th class="text-right">{{ discount.price_rule_supplier.rate }}%</th>
                            <th class="text-right">{{ parseFloat(discount.discount_amount).toFixed(2) }}</th>
                        </tr>
                        <tr style="/*background:#abd1f5;*/" class="tr-grey">
                            <!--<th></th>-->
                            <th colspan="2" style="border-bottom-color: #bbb !important;">Total</th>
                            <th class="text-right" style="border-bottom-color: #bbb !important;">{{ parseFloat(PRICE_RULE_RATE_TOTAL).toFixed(2) }}%</th>
                            <th class="text-right" style="border-bottom-color: #bbb !important;">{{ parseFloat(PRICE_RULE_AMOUNT_TOTAL).toFixed(2) }}</th>
                        </tr>
                        <tr style="background:#abd1f5;">
                            <!--<th style="background:#77ade0;"></th>-->
                            <th colspan="2">Overall Total</th>
                            <th class="text-right">{{ DISCOUNT_SUMMARY_RATE_TOTAL }}%</th>
                            <th class="text-right">{{ PUT_SEPARATOR(DISCOUNT_SUMMARY_TOTAL) }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</template>


<script>

import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'purchase-order',
    props: ['properties',],
    data: function () {
        return {
            is_ready: false,
            view_mode: false,
            discounts: {
                base: [],
                price_rules: [],
                additionals: [],
            },
            /* BASE */
            BASE_AMOUNT_TOTAL: 0.00,
            BASE_RATE_TOTAL: 0.00,
            /* PRICE RULE */
            PRICE_RULE_AMOUNT_TOTAL: 0.00,
            PRICE_RULE_RATE_TOTAL: 0.00,
            /* ADDITIONAL */
            ADDITIONAL_AMOUNT_TOTAL: 0.00,
            ADDITIONAL_RATE_TOTAL: 0.00,

            CHANGE_ADDITIONAL_DISCOUNT_TIMER: null,

            APPLIED_BASE_DISCOUNTS: [],
            APPLIED_PRICE_RULE_DISCOUNTS: [],
        }
    },
    components: {

    },
    computed: {
        DISCOUNT_SUMMARY_TOTAL: function () {
            var total = parseFloat(this.ADDITIONAL_AMOUNT_TOTAL) + parseFloat(this.BASE_AMOUNT_TOTAL) + parseFloat(this.PRICE_RULE_AMOUNT_TOTAL)
            return total.toFixed(2)
        },
        DISCOUNT_SUMMARY_RATE_TOTAL: function () {
            var total = parseFloat(this.ADDITIONAL_RATE_TOTAL) + parseFloat(this.BASE_RATE_TOTAL) + parseFloat(this.PRICE_RULE_RATE_TOTAL)
            return total.toFixed(2)
        }
    },
    methods: {
        updateDISCOUNTS: function (DISCOUNTS,TOTALS) {
            var scope = this
            scope.discounts = DISCOUNTS
            console.log(DISCOUNTS)
            scope.APPLIED_BASE_DISCOUNTS = scope.discounts.base

            /* BASE */
            scope.BASE_AMOUNT_TOTAL = TOTALS.BASE_AMOUNT_TOTAL
            scope.BASE_RATE_TOTAL = TOTALS.BASE_RATE_TOTAL
            /* PRICE RULE */
            scope.PRICE_RULE_AMOUNT_TOTAL = TOTALS.PRICE_RULE_AMOUNT_TOTAL
            scope.PRICE_RULE_RATE_TOTAL= TOTALS.PRICE_RULE_RATE_TOTAL
            /* ADDITIONAL */
            scope.ADDITIONAL_AMOUNT_TOTAL = TOTALS.ADDITIONAL_AMOUNT_TOTAL
            scope.ADDITIONAL_RATE_TOTAL = TOTALS.ADDITIONAL_RATE_TOTAL
        },
        changeAdditionalDiscount: function () {
             var scope = this  
            if (scope.CHANGE_ADDITIONAL_DISCOUNT_TIMER) {
                clearTimeout(scope.CHANGE_ADDITIONAL_DISCOUNT_TIMER);
                scope.CHANGE_ADDITIONAL_DISCOUNT_TIMER = null;
            }

            scope.CHANGE_ADDITIONAL_DISCOUNT_TIMER = setTimeout(() => {
              scope.$parent.$refs.items.updateADDITIONALDISCOUNTS(scope.discounts.additionals)
            }, 300);
        }
    },
    mounted() {
        var scope = this
        // scope.$parent.$refs.items.diiiissscccouunnnt();
        // console.log('__BASE_DISCOUNTS__ ====> ', scope.discounts)
    },
}
</script>



<style scoped>
.autocomplete-suggestion:hover { cursor:pointer !important; }
.table-discount-summary thead th { background:#398cdb !important; color:#fff;  }
.table-discount-summary tbody th { font-weight: 400; }

.buy-and-pay-summary {
    margin-bottom:30px; padding:10px; background:#eee; border:1px solid #efefef; border-radius: 4px;
}
.buy-and-pay-summary span { font-size: 16px; }
.buy-and-pay-summary hr { margin: 0; border-color: #495057; }
.buy-and-pay-summary h4 { margin-bottom: 12px; font-weight: 600; font-size: 18px; }

.table-success, .table-success>td, .table-success>th { background-color: #eee !important; }

.tr-greyish { background: #f9f9f9; }
.tr-grey { background: #eee; }

.badge { padding-top: 3px; font-size: 10px; }
/** .table-success { background-color: #eeeeee; }*/
</style>