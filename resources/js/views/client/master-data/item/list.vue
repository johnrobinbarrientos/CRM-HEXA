<template>
        <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title">
                        <i class="las la-list-ul"></i>
                        <span @click="ROUTE({path: '/item-main/' })">Item List</span>
                    </h1>
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
                    <a @click="ROUTE({path: '/items/create'})" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-plus"></i> <span>New</span>
                    </a>
                </div>
            </div>

            <div v-if="listLoading" class="text-center my-3 text-loader">
                <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
            </div>
            <div v-else>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead class="th-nowrap">
                            <tr>
                                <th width="105">Action</th>
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
                            <tr v-for="(item) in itemList" :key="item.uuid">
                                <td width="65" class="text-center">
                                    <span class="hx-table-actions">
                                        <b-dropdown split text="Edit" size ="sm" class="m-2" href="javascript:void(0)" @click="ROUTE({path: '/items/' + item.uuid })">
                                            <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/items/' + item.uuid })">Edit</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="ROUTE({path: '/items/' + item.uuid + '/view' })">View</b-dropdown-item>
                                            <b-dropdown-item href="javascript:void(0)" @click="remove(item)">Delete</b-dropdown-item>
                                        </b-dropdown>
                                    </span>
                                </td>
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
                                            <span class="badge badge-dim badge-outline-secondary hx-badge-override">{{ item_supplier.supplier.supplier_shortname }}</span>
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
                </div>
                
                <div style="padding:10px; padding-top:20px; padding-bottom:0px;"> Showing {{ listOffset + 1  }} to {{ listOffset +  listResults }} of  {{ listCount }} entries</div>
                <nav style="float:right;" v-if="listTotalPages > 1" class="pagination pagination-rounded mt-4" aria-label="pagination">
                    <ul class="pagination">
                        <li @click="listPaginate('prev')"  v-bind:class="{'disabled' : listCurrentPage <= 1}"  class="page-item" >
                            <a href="javascript:void(0)" class="page-link" aria-label="Previous">
                                <span aria-hidden="true">???</span><span class="sr-only">Previous</span>
                            </a>
                        </li>

                        
                        <li @click="listPaginate(page)" v-for="page in listTotalPages" :key="page" class="page-item" v-bind:class="{'active' : page === listCurrentPage}">
                            <a href="javascript:void(0)" class="page-link">
                                {{ page }}
                            </a>
                        </li>
                        
                        <li @click="listPaginate('next')" v-bind:class="{'disabled' : listCurrentPage >= listTotalPages}" class="page-item">
                            <a href="javascript:void(0)" class="page-link" aria-label="Next"><span aria-hidden="true">???</span><span class="sr-only">Next</span></a>
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
            scope.GET('items?keyword=' + scope.searchKeyword + '&page=' + scope.listCurrentPage + '&take=' + scope.listItemPerPage).then(res => {
                scope.itemList = res.rows
                scope.listLoading = false
                scope.listCount = res.count
                scope.listOffset = res.offset
                scope.listResults = res.results
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
        },

        remove: function (data) {
            var scope = this

            window.swal.fire({
                title: 'Delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.DELETE('items/' + data.uuid).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getItemList()
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        },
    },
    mounted() {
        var scope = this
        scope.getItemList()

    },
}
</script>

<style scoped>
</style>