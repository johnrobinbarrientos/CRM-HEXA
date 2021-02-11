<template>
    <div>
        <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Price Rules</h1>
                </div>
                <div class="bar-right">
                    <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                    <a @click="create()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-plus"></i> <span>New</span>
                    </a>
                </div>
            </div>
        </div>

        <div>
            <div class="row">
                <div class="col-12">
                    <div class="card card-bordered card-preview">
                        <div style="overflow-x:auto;">
                        <table class="table table-striped table-bordered table-items">
                            <thead>
                                <tr class="tb-tnx-head">
                                    <th width="100">Actions</th>
                                    <th>#</th>
                                    <th>Rule Name</th>
                                    <th>Date Start</th>
                                    <th>Date End</th>
                                    <th>Rate</th>
                                    <th>Mechanics</th>
                                    <th>Applicable To</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(price_rule, index) in priceRules" :key="price_rule.uuid" class="tb-tnx-price-rule">
                                    <td>
                                        <a href="javascript:void(0)"  @click="ROUTE({path: '/price-rule/' +  price_rule.uuid }); " class="btn btn-sm btn-light"><i class="mdi mdi-pencil"></i></a>
                                        <a href="javascript:void(0)"  @click="remove(price_rule)" class="btn btn-sm btn-danger"><i class="mdi mdi-trash-can"></i></a>
                                    </td>
                                    <td>{{ (index + 1) }}</td>
                                    <td>{{ price_rule.rule_name }}</td>
                                    <td>{{ price_rule.date_start }}</td>
                                    <td>{{ price_rule.date_end }}</td>
                                    <td class="text-right">{{ price_rule.rate }}</td>
                                    <td>{{ price_rule.mechanics }}</td>
                                    <td>{{ price_rule.applicable_to }}</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</template>

<script>


import Swal from 'sweetalert2'
import moment from 'moment'

export default {
    name: 'price-rule-list',
    props: ['properties'],

    components: {
    },
    data: function () {
        return {

            priceRules: [],

            formdata: {
                uuid: null,
                rule_name: '',
                rate: '',
                fixed: '',
                date_start: '',
                date_end: '',
                mechanics: '',
            },
        }
    },


    methods: {
        getPriceRules: function () {
           var scope = this
            scope.GET('price-rules/').then(res => {
                scope.priceRules = res.rows
            })
        },

        create: function () {
            var scope = this
            scope.POST('price-rules').then(res => {
                if (res.success) {
                   scope.ROUTE({path: '/price-rule/' + res.data.uuid })
                }
            })
        },

    },
    mounted() {
        var scope = this
        scope.getPriceRules()

    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; }
/*.table-items tr th { min-width:200px; width:auto; padding-left:10px; padding-right:10px; }*/
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>
