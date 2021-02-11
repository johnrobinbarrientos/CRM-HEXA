<template>
        <div>
            <div v-show="show_preloader">
                <Spinner />
            </div>

            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i> Item List</h1>
                </div>
                <div class="bar-right">
                    <input @keyup="search()" v-model="searchKeyword" type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                    <select style="max-width:80px;" @change="changeListItemPerPage()" v-model="listItemPerPage" class="form-control border-transparent form-focus-none">
                        <option value="15">15</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
                    </select>
                    <a @click="create()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-plus"></i> <span>New</span>
                    </a>
                </div>
            </div>

            <div v-if="listLoading" class="text-center my-3 text-loader">
                <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
            </div>
            <div v-else> 
                <table class="table table-bordered table-striped">
                    <thead class="th-nowrap">
                        <tr>
                            <th>Actions</th>
                            <th></th>
                            <th>Item Description</th>
                            <th>Item Code</th>
                            <th>Item Barcode</th>
                            <th>Item Group</th>
                            <th>ICO</th>
                            <th>Supplier</th>
                            <th>Is Expiry?</th>
                            <th>Purchase Cost</th>
                            <th>Sales Cost</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in itemList" :key="item.uuid">
                            <td width="65" class="text-center">
                                <span class="hx-table-actions">
                                    <a href="javascript:void(0)" @click="ROUTE({path: '/items/' + item.uuid })" class="btn btn-sm btn-shineblue" title="Edit"><i class="mdi mdi-pencil"></i></a>
                                    <a href="javascript:void(0)" @click="ROUTE({path: '/items/' + item.uuid + '/view' })" class="btn btn-sm hx-btn-shineblue"><i class="mdi mdi-eye" title="View"></i></a>
                                </span>
                            </td>
                            <td>{{ (index + 1) }}</td>
                            <td>
                                {{ item.item_description }}
                            </td>
                            <td class="text-right">{{ item.item_code }}</td>
                            <td class="text-right">
                                {{ item.item_barcode }}
                            </td>
                            <td>
                                {{ item.item_group.item_group }}
                            </td>
                            <td class="text-right">
                                {{ item.reorder_qty }}
                            </td>
                            <td>
                                <span v-if="item.suppliers.length > 0">
                                    <span v-for="item_supplier in item.suppliers" :key="item_supplier.uuid">
                                        <span  class="badge badge-dim badge-outline-secondary hx-badge-override">{{ item_supplier.supplier.supplier_shortname }}</span> &nbsp;
                                    </span>
                                </span>
                                <span v-else>
                                    Not Specified
                                </span>
                            </td>
                            <td>
                                <span v-if="item.is_expiry === 1">Yes</span>
                                <span v-else>No</span>
                            </td>
                            <td class="text-right">
                                {{ item.purchase_price }}
                            </td>
                            <td class="text-right">
                                {{ item.sales_price }}
                            </td>
                        </tr>
                    </tbody>
                </table>
                
                <div style="padding:10px; padding-top:20px; padding-bottom:0px;"> Showing {{ listOffset + 1  }} to {{ listOffset +  listResults }} of  {{ listCount }} entries</div>
                <nav style="float:right;" v-if="listTotalPages > 1" class="pagination pagination-rounded mt-4" aria-label="pagination">
                    <ul class="pagination">
                        <li @click="listPaginate('prev')"  v-bind:class="{'disabled' : listCurrentPage <= 1}"  class="page-item" >
                            <a href="javascript:void(0)" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">‹</span><span class="sr-only">Previous</span>
                            </a>
                        </li>

                        
                        <li @click="listPaginate(page)" v-for="page in listTotalPages" :key="page" class="page-item" v-bind:class="{'active' : page === listCurrentPage}">
                            <a href="javascript:void(0)" class="page-link">
                                {{ page }}
                            </a>
                        </li>
                        
                        <li @click="listPaginate('next')" v-bind:class="{'disabled' : listCurrentPage >= listTotalPages}" class="page-item">
                            <a href="javascript:void(0)" class="page-link" aria-label="Next"><span aria-hidden="true">›</span><span class="sr-only">Next</span></a>
                        </li>
                    </ul>
                </nav>         
            </div>      
    
    </div>
</template>

<script>
import Swal from 'sweetalert2'

export default {
    name: 'item-list',
    props: ['properties'],
    data: function () {
        return {
            show_preloader: true,

            itemList: [],
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            listOffset: 0,
            listResults: 0,
            searchKeyword: '',
            timer: null
        }
    },
    computed: {
        listTotalPages: function () {
            var scope = this
            var pages = Math.ceil(scope.listCount / scope.listItemPerPage)
            return pages
        }
    },
    methods: {
        getItemList: function () {
            var scope = this
            scope.listLoading = true
            scope.itemList = []
            scope.GET('items/?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.itemList = res.rows
                scope.listLoading = false
                scope.listCount = res.count
                scope.listOffset = res.offset
                scope.listResults = res.results
            })
        },
        create: function () {
            var scope = this

            scope.POST('items/').then(res => {
                if (res.success) {
                   scope.ROUTE({path: '/items/' + res.data.uuid })
                }
            })
        },
        search: function () {
            var scope = this
            if (scope.timer) {
                clearTimeout(scope.timer);
                scope.timer = null;
            }

            scope.timer = setTimeout(() => {
                scope.getItemList()
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

            scope.getItemList()
        },
        changeListItemPerPage: function () 
        {
            var scope = this
            scope.listCurrentPage = 1
            scope.getItemList()
        }
    },
    mounted() {
        var scope = this
        scope.getItemList()

        setTimeout(function(){ scope.show_preloader = false },2000)
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; }
.table-fixed-column { position:absolute; }
.form-group { margin-top:10px !important; }
</style>