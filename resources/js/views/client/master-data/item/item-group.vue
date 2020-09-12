<template>
    <div>

        <div class="actions-bar">
            <div class="w-100">
                <h1 class="title"><i class="las la-th-list"></i> Item Group</h1>
            </div>
            <div class="bar-right">
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search"> 
                <a href="javascript:void(0)" @click="OPEN_MODAL('#modalItemGroup');resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal">
                    <i class="las la-plus"></i> <span>New</span>
                </a>
            </div>
        </div>

        <div class="table-rep-plugin">
            <div class="table-responsive mb-0" data-pattern="priority-columns">
                <table id="tech-companies-1" class="table table-striped table-bordered responsiveTable">
                    <thead>
                        <tr>
                            <th width="100">Actions</th>
                            <th width="100">#</th>
                            <th data-priority="3">Item Group</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(item, index) in Groups" :key="item.uuid">
                           <td>
                                <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalItemGroup');setData(item)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                <a href="javascript:void(0)"  @click="remove(item)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                            </td>
                            <td>
                                {{ (index + 1) }}
                            </td>
                            <td>
                               {{ item.item_group }}
                            </td>
                            
                            
                        </tr>
                        
                    </tbody>
                </table>         
            </div>         
        </div>




        <!-- Modal Item Group Form -->
        <div class="modal fade" tabindex="-1" id="modalItemGroup">
            <div class="modal-dialog modal-md " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Item Group Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalItemGroup');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="item-group">Item Group</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.item_group" type="text" class="form-control" id="item-group" required>
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
    name: 'item-group',
    props: ['properties'],
    data: function () {
        return {
            Groups: [],
            formdata: { 
                uuid: null, 
                item_group: ''
            }
        }
    },
    methods: {
        getItemGroup: function () {
           var scope = this
            scope.GET('items/item-group').then(res => {
                scope.Groups = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.item_group = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.item_group = data.item_group
        },
        save: function () {
            var scope = this
            scope.POST('items/item-group', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Item Group Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getItemGroup()
                        scope.CLOSE_MODAL('#modalItemGroup')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
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
                    scope.POST('items/item-group', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Item Group Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getItemGroup()
                                scope.CLOSE_MODAL('#modalItemGroup')
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
                    scope.POST('items/item-group/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Item Group Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getItemGroup()
                            scope.CLOSE_MODAL('#modalItemGroup')
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
        scope.getItemGroup()
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>