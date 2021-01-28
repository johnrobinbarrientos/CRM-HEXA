<template>
    <div id="discounts">
        <div class="row">
            <div class="col-md-4 col-12">
                <h4>Additional Discounts</h4>
                <div  v-for="(discount, index) in __ADDITIONALS__" :key="index">
                    <div class="form-group">
                        <span>{{ (index + 1) }}. {{ discount.discount_name }} <span v-if="discount.discount_type == 'rate'">%</span></span>
                        <input  @keyup="recalculateItems()" v-if=" discount.discount_type == 'rate'" v-model="discount.discount_rate" :disabled="view_mode" style="margin-top:5px; margin-bottom:5px; height:30px; min-height:30px; line-height:30px;" type="text" class="form-control">
                        <input  @keyup="recalculateItems()" v-if="discount.discount_type == 'fixed'" v-model="discount.discount_fixed" :disabled="view_mode" style="margin-top:5px; margin-bottom:5px; height:30px; min-height:30px; line-height:30px;" type="text" class="form-control">
                    </div>
                </div>

            </div>
            <div class="col-12 col-md-7 offset-md-1">
                <h4>Discount Summary</h4>
                <table class="table-discount-summary table table-striped table-bordered"> 
                    <thead>
                        <tr >
                            <th width="30">#</th>
                            <th width="150">Discount Group</th>
                            <th>Discount Name</th>
                            <th>Rate</th>
                            <th>Amount</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(base_discount,index) in APPLIED_BASE_DISCOUNTS" :key="'base-discount-summary' + index">
                            <th style="background:#77ade0;">
                                <span v-if="index == 0">1</span>
                            </th>
                            <th >
                                <span v-if="index == 0">Base</span>
                            </th>
                            <th>{{ base_discount.discount_name }}</th>
                            <th class="text-right">{{ base_discount.discount_rate }}%</th>
                            <th class="text-right">{{ parseFloat(base_discount.discount_amount).toFixed(2) }}</th>
                        </tr>
                        <tr style="background:#abd1f5;">
                            <th style="background:#77ade0;"></th>
                            <th colspan="2">Base Total</th>
                            <th class="text-right">{{ parseFloat(DISCOUNT_BASE_RATE_TOTAL).toFixed(2) }}%</th>
                            <th class="text-right">{{ parseFloat(DISCOUNT_BASE_AMOUNT_TOTAL).toFixed(2) }}</th>
                        </tr>
                        <tr v-for="(discount,index) in __ADDITIONALS__" :key="'additional-discount-summary' + index">
                            <th style="background:#77ade0;">
                                <span v-if="index == 0">2</span>
                            </th>
                            <th >
                                <span v-if="index == 0">Additional</span>
                            </th>
                            <th>{{ discount.discount_name }}</th>
                            <th class="text-right">{{ parseFloat(discount.discount_rate).toFixed(2) }}%</th>
                            <th class="text-right">{{ parseFloat(discount.discount_fixed).toFixed(2) }}</th>
                        </tr>
                        <tr style="background:#abd1f5;">
                            <th></th>
                            <th style="background:#abd1f5;"  colspan="2">Additional Total</th>
                            <th class="text-right">{{ parseFloat(DISCOUNT_ADDITIONAL_RATE_TOTAL).toFixed(2) }}%</th>
                            <th class="text-right">{{ parseFloat(DISCOUNT_ADDITIONAL_AMOUNT_TOTAL).toFixed(2) }}</th>
                        </tr>
                        <tr v-for="(discount,index) in APPLIED_PRICE_RULE_DISCOUNTS" :key="'price-rule-discount-summary' + index">
                                <th style="background:#77ade0;">
                                <span v-if="index == 0">3</span>
                            </th>
                            <th >
                                <span v-if="index == 0">Price Rule</span>
                            </th>
                            <th>{{ discount.price_rule_supplier.rule_name }}</th>
                            <th class="text-right">{{ discount.price_rule_supplier.rate }}%</th>
                            <th class="text-right">{{ parseFloat(discount.discount_amount).toFixed(2) }}</th>
                        </tr>
                        <tr style="background:#abd1f5;">
                            <th></th>
                            <th colspan="2">Price Rule Total</th>
                            <th class="text-right">{{ parseFloat(DISCOUNT_PRICE_RULE_RATE_TOTAL).toFixed(2) }}%</th>
                            <th class="text-right">{{ parseFloat(DISCOUNT_PRICE_RULE_AMOUNT_TOTAL).toFixed(2) }}</th>
                        </tr>
                        <tr style="background:#abd1f5;">
                            <th style="background:#77ade0;"></th>
                            <th colspan="2">TOTAL DISCOUNT</th>
                            <th class="text-right">{{ DISCOUNT_SUMMARY_RATE_TOTAL }}%</th>
                            <th class="text-right">{{ putSeparator(DISCOUNT_SUMMARY_TOTAL) }}</th>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>