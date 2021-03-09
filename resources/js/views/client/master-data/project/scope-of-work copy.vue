<template>
    <div>
        <br/>
        <div class="row">
            <div class="col-lg-4 col-12" >
                <div class="card-title">Scope of Works</div>
                <div v-bind:class="{ 'table-responsive': table_responsive }">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="90">Action</th>
                                <th>Scope</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="scopes.length > 0">
                            <tr @click="selectScope(scopeOfWork)" v-bind:class="{'table-success' : (selected_scope && selected_scope.uuid === scopeOfWork.uuid) }" style="cursor:pointer;" v-for="(scopeOfWork,index) in scopes" :key="index" >
                                <td width="65" class="text-center">
                                    <span class="hx-table-actions">
                                        <template v-if="scopeOfWork.edit !== true">
                                            <button @click="editScope(scopeOfWork)" class="btn btn-sm btn-shineblue" role="button" :disabled="view_mode"><i class="mdi mdi-pencil"></i></button>
                                            <button class="btn btn-sm btn-danger" role="button" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                        </template>
                                        <template v-else>
                                            <button @click="saveScope(scopeOfWork)" class="btn btn-sm btn-primary" role="button" :disabled="view_mode"><i class="bx bx-save"></i></button>
                                            <button class="btn btn-sm btn-danger" role="button" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                        </template>
                                    </span>
                                </td>
                                <td>
                                    <strong v-if="scopeOfWork.edit !== true">{{ scopeOfWork.scope_of_work }}</strong>
                                    <input v-else v-model="scopeOfWork.scope_of_work" class="form-control" type="text" placeholder="Enter Scope">
                                </td>
                                
                            </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="3" style="padding:20px; text-align:center; font-weight:600;">No Records</td>
                                </tr>
                            </template>
                            <tr>
                                <td class="p-0" colspan="3" >
                                    <button @click="addNewScope()"  type="button" style="font-weight:600; border-radius: 0; padding-top: 4px; padding-bottom: 4px;" :disabled="view_mode" class="hx-btn hx-btn-shineblue w-100"><i class="bx bx-plus"></i>New</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
            </div>
            <div v-if="selected_scope" class="col-lg-4 col-12 offset-lg-1">
                <div class="card-title">Work Details</div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th width="90">Actions</th>
                                <th>Detail</th>
                            </tr>
                        </thead>
                        <tbody>
                            <template v-if="workDetails.length > 0">
                            <tr style="cursor:pointer;" v-for="(work_detail,index) in workDetails" :key="index" >
                                <td width="65" class="text-center">
                                    <span class="hx-table-actions">
                                        <template v-if="work_detail.edit !== true">
                                            <button @click="editWorkDetail(work_detail)" type="button" class="btn btn-sm btn-shineblue" :disabled="view_mode"><i class="mdi mdi-pencil"></i></button>
                                            <button class="btn btn-sm btn-danger" type="button" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                        </template>
                                        <template v-else>
                                            <button @click="saveWorkDetail(work_detail)" type="button" class="btn btn-sm btn-primary" :disabled="view_mode"><i class="bx bx-save"></i></button>
                                            <button class="btn btn-sm btn-danger" type="button" :disabled="view_mode"><i class="bx bx-trash-alt"></i></button>
                                        </template>
                                    </span>
                                </td>
                                <td>
                                    <span v-if="work_detail.edit !== true">{{ work_detail.detail }}</span>
                                    <input v-else v-model="work_detail.detail" class="form-control" type="text" placeholder="Enter Detail">
                                </td>
                            </tr>
                            </template>
                            <template v-else>
                                <tr>
                                    <td colspan="4" style="padding:20px; text-align:center; font-weight:600;"><strong>{{ selected_scope.scope }}</strong>No Records</td>
                                </tr>
                            </template>
                            <tr>
                                <td class="p-0" colspan="4" >
                                    <button @click="addWorkDetail()" type="button" style="font-weight:600; border-color: transparent; border-radius: 0; padding-top: 4px; padding-bottom: 4px;" :disabled="view_mode" class="hx-btn hx-btn-shineblue w-100"><i class="bx bx-plus"></i>New</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
            </div>
        </div>
    </div>
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'scope-of-work',
    props: ['properties','project_uuid','view_mode'],
    data: function () {
        return {
            selected_scope: null,
            workDetails: [],
            scopes: [],
            table_responsive: true
        }
    },
    methods: {

        getWorkDetails: function () {
            var scope = this
            var project_scope_uuid = scope.selected_scope.uuid;
            scope.workDetails = []
            scope.GET('projects/' + project_scope_uuid + '/work-details').then(res => {
                scope.workDetails = res.rows
                console.log(scope.workDetails)
            })
       },
        addWorkDetail: function () {
           var scope = this

           var allow_add = true
            for (let i = 0; i < scope.workDetails.length; i++) {
               var current = scope.workDetails[i]
               if (!current.id) {
                   allow_add = false
                   break;
               }
            }

            if (!allow_add) {
                return
            }

           scope.workDetails.push({
                id: null,
                uuid: null,
                detail: '',
                edit: true
           });
        },
        editWorkDetail: function (data) {
           var scope = this
           
           if (data.uuid === null) {
               return;
           }

           scope.$set(data,'edit', true)
        },
        saveWorkDetail: function (data) {
            var scope = this
            var scope_uuid = scope.selected_scope.uuid;
            scope.POST('projects/'+ scope_uuid +'/work-details', data).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.$set(data,'id',res.data.id)
                        scope.$set(data,'uuid',res.data.uuid)
                        scope.$set(data,'edit', false)
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },

        addNewScope: function () {
           var scope = this

            var allow_add = true
            for (let i = 0; i < scope.scopes.length; i++) {
               var current = scope.scopes[i]
               if (!current.id) {
                   allow_add = false
                   break;
               }
            }

            if (!allow_add) {
                return
            }

           scope.scopes.push({
                id: null,
                uuid: null,
                scope_of_work: '',
                edit: true
           });
        },
        editScope: function (data) {
           var scope = this
           
           if (data.uuid === null) {
               return;
           }

           scope.$set(data,'edit', true)
        },
        selectScope: function (data) {
           var scope = this

           if (data.uuid === null) {
               return;
           }

           scope.selected_scope = data
           scope.getWorkDetails()
       },
       getScopes: function () {
            var scope = this
            var project_uuid = scope.project_uuid;

            scope.GET('projects/' + project_uuid + '/scope-of-work').then(res => {
                scope.scopes = res.rows
                // auto select first scope
                if (res.rows.length > 0) {
                    scope.selected_scope = res.rows[0]
                    scope.getWorkDetails();
                }
            })
       },
       saveScope: function (data) {
            var scope = this
            var project_uuid = scope.project_uuid;
            scope.POST('projects/'+ project_uuid +'/scope-of-work', data).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.$set(data,'id',res.data.id)
                        scope.$set(data,'uuid',res.data.uuid)
                        scope.$set(data,'edit', false)
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
       }
    },
    mounted() {
        var scope = this
        scope.getScopes()

        // if(scope.properties) {
        //     scope.table_responsive = scope.properties.table_responsive
        // }

    },
}
</script>

<style scoped>
a.disabled {
    pointer-events: none;
    color: #ccc;
}

.table-discounts thead th { background-color: #398cdb; color: #fff; }
.table-discounts tbody th {
    font-weight: normal;
}
.table-success, .table-success>td, .table-success>th { background-color: #eee !important; }
</style>