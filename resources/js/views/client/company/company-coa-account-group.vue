<template>
    <div >
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Account Group">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalAccountGroup');resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Account Group</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="nk-content nk-content-fluid">          
            <div class="container-fluid">
                <div class="nk-content-body">

                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="card card-bordered card-preview">
                                <table class="table table-tranx">
                                    <thead>
                                        <tr class="tb-tnx-head">
                                            <th><span class="">#</span></th>
                                            <th><span class="">Account Group</span></th>
                                            <th><span class="">Report Group</span></th>
                                            <th><span class="">Actions</span></th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(account, index) in accountGroups" :key="account.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ account.account_group }}</span></td>
                                            <td><span class="">{{ account.report_group.coa_report_name }}</span></td>

                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalAccountGroup');setData(account)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(account)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    


                    <!-- Modal Group Form -->
                    <div class="modal fade" tabindex="-1" id="modalAccountGroup">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Account Group Details</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalAccountGroup');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-validate is-alter">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="report-groups">Report Group</label>
                                                     <select class="form-select-report" v-model="selected_report_group" :options="options_report_group" name="report-group">
                                                        <!-- <option></option> -->
                                                    </select>
                                                    <label class="form-label" for="account-groups">Account Group</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.account_group" type="text" class="form-control" id="account-group" required>
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
            </div>
        </div>        
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'coa-account-groups',
    props: ['properties'],
    data: function () {
        return {
            accountGroups: [],
            formdata: { 
                uuid: null,
                coa_report_uuid: '', 
                account_group: ''
            },
            selected_report_group: null,
            options_report_group: []

        }
    },
    watch: {

    },
    methods: {
        getAllReportGroups: function () {
           var scope = this
            scope.GET('company/coa-report-group').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_report_group.push({
                        id: data.uuid,
                        text: data.coa_report_name
                    })
                
                })

                $(".form-select-report").select2({data: scope.options_report_group});
                
                scope.selected_report_group = scope.options_report_group[0].id
            })

        },
        getAllAccountGroups: function () {
           var scope = this
            scope.GET('company/coa-account-group').then(res => {
                scope.accountGroups = res.rows
            })
        },

        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.coa_report_uuid = ''
            scope.formdata.account_group = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.coa_report_uuid = data.coa_report_uuid
            scope.formdata.account_group = data.account_group

            // console.log(data.coa_report_uuid)
            $('.form-select-report').val(data.coa_report_uuid);
            $('.form-select-report').trigger('change');
        },
        save: function () {
            var scope = this
            scope.formdata.coa_report_uuid = scope.selected_report_group

            scope.POST('company/coa-account-group/save', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Account Group Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        console.log(res.data)
                        // scope.accountGroups.push(res.data)
                        scope.getAllAccountGroups()
                        scope.CLOSE_MODAL('#modalAccountGroup')
                    })
                } else {
                    alert('ERROR:' + res.code)
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
                    scope.POST('company/coa-account-group/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Account Group Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getAllAccountGroups()
                            scope.CLOSE_MODAL('#modalAccountGroup')
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        },
        update: function () {
            var scope = this
            scope.formdata.coa_report_uuid = scope.selected_report_group

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
                    scope.PUT('company/coa-account-group/update', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Account Group Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getAllAccountGroups()
                                scope.CLOSE_MODAL('#modalAccountGroup')
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
        scope.getAllAccountGroups()
        scope.getAllReportGroups()
         
        $('.form-select-report').on("change", function(e) { 
            scope.selected_report_group = $('.form-select-report').val();
        })
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>