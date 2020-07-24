<template>
    <div>
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Asset Group">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalLocation');resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Item Asset Group</span>
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
                                            <th><span class="">Asset Group</span></th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                    


                    <!-- Modal Location Form -->
                    <div class="modal fade" tabindex="-1" id="modalLocation">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Item Asset Group Details</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalLocation');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-validate is-alter">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Item Asset Group</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
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
    name: 'home',
    props: ['properties'],
    data: function () {
        return {
            locations: [],
            location_groups: [],
            formdata: { 
                uuid: null, 
                location_code: '', 
                location_name: '', 
                location_shortname: ''
            },
            formLocationGroup: {
                uuid: null, 
                location_group_name: '',
                form: 'hidden'
            }
        }
    },
    methods: {
        getLocations: function () {
           var scope = this
            scope.GET('locations').then(res => {
                scope.locations = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.location_code = ''
            scope.formdata.location_name = ''
            scope.formdata.location_shortname = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.location_code = data.location_code
            scope.formdata.location_name = data.location_name
            scope.formdata.location_shortname = data.location_shortname
        },
        save: function () {
            var scope = this
            scope.POST('locations', scope.formdata).then(res => {
                if (res.success) {
                    scope.locations.push(res.data)
                    scope.CLOSE_MODAL('#modalLocation')
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.PUT('locations', scope.formdata).then(res => {
                if (res.success) {
                    scope.getLocations()
                    scope.CLOSE_MODAL('#modalLocation')
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        editGroupToggle(group) {
            var scope = this
            scope.$set(group,'edit',!group.edit)
            scope.$set(group,'temp',group.location_group_name)
        },
        formLocationGroupToggle(name) {
            var scope = this

            if (scope.formLocationGroup.form === name) {
                scope.formLocationGroup.form = 'hidden'
                return
            }
            scope.formLocationGroup.form = name
        },
        getLocationGroups: function () {
            var scope = this
            scope.GET('locations/groups').then(res => {
                scope.location_groups = res.rows
            })
        },
        saveLocationGroup: function () {
            var scope = this
            scope.POST('locations/groups', scope.formLocationGroup).then(res => {
                if (res.success) {
                    scope.location_groups.push(res.data)
                    scope.formLocationGroup.location_group_name = ''
                    // scope.CLOSE_MODAL('#modalGroup')
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        updateLocationGroup: function (data) {
            var scope = this
            scope.PUT('locations/groups', data).then(res => {
                if (res.success) {
                    scope.$set(data,'edit',false)
                    scope.$set(data,'location_group_name',res.data.location_group_name)
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
    },
    mounted() {
        var scope = this
        scope.getLocations()
        scope.getLocationGroups()
         $(".form-select").select2();
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>