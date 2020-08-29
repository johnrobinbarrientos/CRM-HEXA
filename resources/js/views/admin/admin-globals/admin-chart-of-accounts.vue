<template>
    <div>
        <div class="card">
            <div class="card-body">
                <div class="card-title">Chart of Accounts</div>
                <div class="mb-3 card-subtitle">
                    Below are the list of active custom chain.
                </div>

                <div style="margin-bottom:10px;">
                    <div class="row">
                        <div class="col-12 col-md-3">
                            <input type="text" class="form-control" placeholder="Search Item">
                        </div>
                        <div class="col-12 col-md-2 offset-md-7 text-right">
                            <a href="javascript:void(0)" @click="OPEN_MODAL('#modalCOA');resetData()" class="btn btn-primary" data-toggle="modal">
                                <em class="icon ni ni-plus"></em> <span>New Chart of Accounts</span>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 table table-striped">
                        <thead>
                            <tr class="tb-tnx-head">
                                <th width="100">Actions</th>
                                <th width="100">#</th>
                                <th>Code</th>
                                <th>Account Name</th>
                                <th>Account Group</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(account, index) in chartOfAccounts" :key="account.uuid">
                                 <td>
                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalCOA');setData(account)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                    <a href="javascript:void(0)"  @click="remove(account)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                                </td>
                                <td><span class="">{{ (index + 1) }}</span></td>
                                <td><span class="">{{ account.code }}</span></td>
                                <td><span class="">{{ account.account_name }}</span></td>
                                <td><span class="">{{ account.account_group.account_group }}</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        
        <!-- Modal Group Form -->
        <div class="modal fade" tabindex="-1" id="modalCOA">
            <div class="modal-dialog modal-lg " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Chart of Accounts Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalCOA');" class="close" data-dismiss="modal" aria-label="Close">
                            <em class="icon ni ni-cross"></em>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="account-groups">Account Group</label>
                                            <select class="form-select-account-group" v-model="selected_account_group" :options="options_account_group" name="account-group">
                                            <!-- <option></option> -->
                                        </select>
                                        <label class="form-label" for="account-groups">Code</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.code" type="text" class="form-control" id="code" required>
                                        </div>
                                        <label class="form-label" for="account-groups">Account Name</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.account_name" type="text" class="form-control" id="account-name" required>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>                                    
                            
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button v-if="formdata.uuid === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
                        <button v-else @click="update()" type="submit" class="btn btn-lg btn-primary">Save Changes</button>
                    </div>
                </div>
            </div>
        </div>       
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'chart-of-accounts',
    props: ['properties'],
    data: function () {
        return {
            chartOfAccounts: [],
            formdata: { 
                uuid: null,
                code: '', 
                account_name: '', 
                coa_group_uuid: '', 
                account_group: ''
            },
            selected_account_group: null,
            options_account_group: []

        }
    },
    methods: {
        getAccountGroups: function () {
           var scope = this
            scope.GET('admin/coa-account-group').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_account_group.push({
                        id: data.uuid,
                        text: data.account_group
                    })
                
                })
                $(".form-select-account-group").select2({data: scope.options_account_group});
                
                scope.selected_account_group = scope.options_account_group[0].id
            })

        },
        getChartofAccounts: function () {
           var scope = this
            scope.GET('admin/chart-of-accounts').then(res => {
                scope.chartOfAccounts = res.rows
            })
        },

        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.code = ''
            scope.formdata.account_name = ''
            scope.formdata.coa_group_uuid = ''
            scope.formdata.account_group = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.code = data.code
            scope.formdata.account_name = data.account_name
            scope.formdata.coa_group_uuid = data.coa_group_uuid
    
            $('.form-select-account-group').val(data.coa_group_uuid);
            $('.form-select-account-group').trigger('change');
        },
        save: function () {
            var scope = this
            scope.formdata.coa_group_uuid = scope.selected_account_group

            scope.POST('admin/chart-of-accounts', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Chart of Accounts Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getChartofAccounts()
                        scope.CLOSE_MODAL('#modalCOA')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.formdata.coa_group_uuid = scope.selected_account_group

            window.swal.fire({
                title: 'Update Record?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Update it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('admin/chart-of-accounts', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Chart of Accounts Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getChartofAccounts()
                                scope.CLOSE_MODAL('#modalCOA')
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        },
        remove: function (data) {
            var scope = this

            window.swal.fire({
                title: 'Are you sure?',
                text: 'You won\'t be able to revert this',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('admin/chart-of-accounts/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Chart of Accounts Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getChartofAccounts()
                            scope.CLOSE_MODAL('#modalCOA')
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        }
    },

    mounted() {
        var scope = this
        scope.getChartofAccounts()
        scope.getAccountGroups()
         
        $('.form-select-account-group').on("change", function(e) { 
            scope.selected_account_group = $('.form-select-account-group').val();
        })
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>