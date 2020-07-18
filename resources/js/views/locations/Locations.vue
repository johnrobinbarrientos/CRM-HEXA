<template>
    <div>
        <div style="margin-bottom:30px;" class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search files, folders">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalGroup');" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>Add Group</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalLocation');resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Locations</span>
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
                                            <th><span class="">Location Code</span></th>
                                            <th><span class="">Location Name</span></th>
                                            <th><span class="">Short Name</span></th>
                                            <th><span class="">Date Added</span></th>
                                            <th><span class="">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="(location, index) in locations" :key="location.uuid" class="tb-tnx-item">
                                            <td><span class="">{{ (index + 1) }}</span></td>
                                            <td><span class="">{{ location.location_code }}</span></td>
                                            <td><span class="">{{ location.location_name }}</span></td>
                                            <td><span class="">{{ location.location_shortname }}</span></td>
                                            <td><span class="">{{ location.created_at }}</span></td>
                                            <td>
                                                <span class="">
                                                    <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalLocation');setData(location)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                    <a href="javascript:void(0)"  @click="remove(location)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                </span>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <div class="col-md-4 col-12">
                            <div class="card card-bordered card-preview">
                                <div style="background:#f5f6fa; padding:5px 10px; font-weight:900; border-bottom:1px solid #dbdfea;">
                                    GROUPS
                                    <div style="float:right;">
                                        <button @click="formLocationGroupToggle('create')" style="font-weight:900; border:none; background:transparent;"><em class="icon ni ni-plus"></em></button>
                                        <button @click="formLocationGroupToggle('search')"  style="font-weight:900; border:none; background:transparent;"><em class="icon ni ni-search"></em></button>
                                    </div>
                                </div>
                                <div v-if="formLocationGroup.form === 'create'" style="position:relative; padding:5px 10px; padding-right:75px;">
                                    <input v-model="formLocationGroup.location_group_name" type="text" class="form-control" id="location-group-name" placeholder="Enter group name..." required>
                                    <button style="position:absolute; top:5px; right:10px; height:36px;" v-if="formLocationGroup.uuid === null" @click="saveLocationGroup()" type="submit" class="btn btn-sm btn-primary">Save</button>
                                </div>
                                <div v-if="formLocationGroup.form === 'search'" style="position:relative; padding:5px 10px; padding-right:85px;">
                                    <input v-model="formLocationGroup.location_group_name" type="text" class="form-control" id="location-group-name" placeholder="Enter keyword..." required>
                                    <button style="position:absolute; top:5px; right:10px; height:36px;" v-if="formLocationGroup.uuid === null" @click="saveLocationGroup()" type="submit" class="btn btn-sm btn-primary">Search</button>
                                </div>

                                <table class="table table-tranx">
                                    <thead>
                                        <tr class="tb-tnx-head">
                                            <th><span class="">Group Name</span></th>
                                            <th><span class="">Actions</span></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <template v-for="(group, index) in location_groups">
                                            <tr v-if="!group.edit" class="tb-tnx-item"  :key="group.uuid" >
                                                    <td><span class="">{{ group.location_group_name }}</span></td>
                                                    <td width="120px">
                                                        <span class="">
                                                            <a href="javascript:void(0)"  @click="editGroupToggle(group)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                            <a href="javascript:void(0)"  @click="editGroupToggle(group)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                        </span>
                                                    </td>
                                            </tr>
                                            <tr v-else class="tb-tnx-item"  :key="group.uuid" > 
                                                <td><input type="text" class="form-control" v-model="group.temp"></td>
                                                <td width="120px">
                                                    <span class="">
                                                        <a href="javascript:void(0)"  @click="updateLocationGroup(group)" class="btn btn-sm btn-light"><em class="icon ni ni-save"></em></a>
                                                        <a href="javascript:void(0)"  @click="editGroupToggle(group)" class="btn btn-sm btn-danger"><em class="icon ni ni-cross"></em></a>
                                                    </span>
                                                </td>
                                            </tr>
                                        </template>
                                    </tbody>
                                </table>
                            </div> 
                        </div>
                    </div>
                    


                    <!-- Modal Location Form -->
                    <div class="modal fade" tabindex="-1" id="modalLocation">
                        <div class="modal-dialog modal-lg " role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Location Info</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalLocation');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-validate is-alter">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="full-name">Location Code</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="full-name">Location Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_name" type="text" class="form-control" id="location-name" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <br/>

                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="email-address">Location Shortname</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_shortname" type="text" class="form-control" id="location-shortname" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <br/>

                                        <div class="row">
                                            <div class="col-md-12 col-12">
                                                <div class="card card-bordered card-preview">
                             

                                                    <table class="table table-tranx">
                                                        <thead>
                                                            <tr class="tb-tnx-head">
                                                                <th><span class="">Group Name</span></th>
                                                                <th><span class="">Actions</span></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr v-for="(group, index) in location_groups" :key="group.uuid" class="tb-tnx-item">
                                                                <td><span class="">{{ group.location_group_name }}</span></td>
                                                                <td width="120px">
                                                                    <span class="">
                                                                        <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalGroup');setData(group)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                                                        <a href="javascript:void(0)"  @click="remove(group)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                                                    </span>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
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

                    <!-- Modal Group Form -->
                    <div class="modal fade" tabindex="-1" id="modalGroup">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Group Info</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalGroup');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    
                                    
                                    
                                                              
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
    },
}
</script>