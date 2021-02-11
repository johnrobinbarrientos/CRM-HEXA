<template>
    <div>
        <div style="margin-top:5px;" >
            <span>Billing Type</span>
            <select v-model="type" style="margin-top:5px;" class="form-control">
                <option value="Inventory">Inventory</option>
                <option value="Fixed Assets">Fixed Assets</option>
                <option value="Expenses">Expenses</option>
            </select>
        </div>

        <to-bill-list v-if="type === 'Inventory'"></to-bill-list>
        <expenses-form v-if="type === 'Expenses'"></expenses-form>
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
            selected_reason_code: null,
            options_reason_code: [],

            toBill: [],
            grand_total: 0,

            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            searchKeyword: '',
            timer: null,

            type: 'Inventory'
        }
    },
    components: {
        'to-bill-list' : ToBillList,
        'expenses-form' : ExpensesForm,
    },
    computed: {
        listTotalPages: function () {
            var scope = this
            var pages = Math.ceil(scope.listCount / scope.listItemPerPage)
            return pages
        }
    },
    methods: {
        moment: function (date) {
            return moment(date).format('DD-MMM-YYYY')
        },
        putSeparator: function(value) {
            var num_parts = value.toString().split(".");
            num_parts[0] = num_parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
            return num_parts.join(".");
        },

        getToBill: function () {
           var scope = this
            scope.listLoading = true
            scope.toBill = []
            scope.GET('buy-and-pay/orders?type=to-bill&keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.toBill = res.rows
                scope.grand_total = res.grand_total

                scope.listLoading = false
                scope.listCount = res.count
            })
        },
        search: function () {
            var scope = this
            if (scope.timer) {
                clearTimeout(scope.timer);
                scope.timer = null;
            }

            scope.timer = setTimeout(() => {
                scope.getToBill()
            }, 800);
        },
        listPaginate: function(page) {
            var scope = this
        
            if (page === 'prev') {
                scope.listCurrentPage = scope.listCurrentPage - 1
            } else if (page === 'next') {
                scope.listCurrentPage = scope.listCurrentPage + 1
            } else {
                scope.listCurrentPage = page
            }

            if (scope.listCurrentPage < 1) {
                scope.listCurrentPage = 1
                return
            } else  if (scope.listCurrentPage > scope.listTotalPages) {
                scope.listCurrentPage =  scope.listTotalPages
                return
            }

            scope.getToBill()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getToBill()
        }

    },
    mounted() {
        var scope = this
        scope.getToBill()
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>