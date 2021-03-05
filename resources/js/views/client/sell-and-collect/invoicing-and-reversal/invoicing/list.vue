<template>
    <div>
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><i class="las la-list-ul"></i>Invoices</h1>
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
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalInvoicing')" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                            <i class="las la-plus"></i> <span>New</span>
                        </a>
                    </div>
            </div>

            <!-- <div v-if="listLoading" class="text-center my-3 text-loader">
                <i class="bx bx-loader bx-spin font-size-18 align-middle mr-2"></i> Load more 
            </div> -->

            <div class="table-responsive;">
                <table class="table table-bordered table-hover table-striped
                ">
                    <thead class="th-nowrap">
                        <tr>
                            <th  width="105">Action</th>
                            <th>Item Type</th>
                            <th>Transaction No.</th>
                            <th>Customer</th>
                            <th>Branch</th>
                            <th>Location</th>
                            <th>Transaction Date</th>
                            <th>Amount</th>
                            <th>Status</th> 
                            <th>Reason Code</th> 
                        </tr>
                    </thead>
                    <tbody class="td-border-bottom-black">
                        
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


            <!-- Modal -->
            <div class="modal fade" tabindex="-1" id="modalInvoicing">
                <div class="modal-dialog modal-lg " role="document" style="max-width: 1100px;">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Invoice</h5>
                            <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalInvoicing');" class="close" data-dismiss="modal" aria-label="Close">
                                <i class="bx bx-x"></i>
                            </a>
                        </div>
                        <div class="modal-body">
                            <selection-form></selection-form>
                        </div>
                    </div>
                </div>
            </div>


    </div>
</template>

<script>
import Swal from 'sweetalert2'
import moment from 'moment'
import SelectionForm from './selection-form'

export default {
    name: 'purchase-order',
    props: ['properties'],
    data: function () {
        return {
            listLoading: true,
            listCurrentPage: 1,
            listItemPerPage: 20,
            listCount: 0,
            listOffset: 0,
            listResults: 0,
            searchKeyword: '',
            timer: null,
        }
    },
    components: {
        'selection-form': SelectionForm
    },
    computed: {
        listTotalPages: function () {
            var scope = this
            var pages = Math.ceil(scope.listCount / scope.listItemPerPage)
            return pages
        }
    },
    methods: {
        

    },
    mounted() {
        var scope = this

    },
}
</script>

<style scoped>
.table-filter { background:#f9f9f9; border:1px solid #d7d8e0; padding:0px; margin-bottom: 8px; }
.table-filter-row { display:flex; justify-content: space-evenly; }
.select-wrap { background:#e5e5ed; padding-right: 5px; border-right:1px solid #d7d8e0; width: 100%; }
.select-wrap select { padding:5px; padding-top: 6px; background:transparent; border:none; width:100%; font-size: 12px; }
.badge { font-size: 11px; }

.td-border-bottom-black tr:nth-last-child(3) td { border-bottom-color: #495057 !important; }
.td-border-bottom-black tr:nth-last-child(2) td { border-bottom-color: #495057 !important; }
.td-border-bottom-black tr:nth-last-child(1) td { border-bottom-color: #495057 !important; }
</style>