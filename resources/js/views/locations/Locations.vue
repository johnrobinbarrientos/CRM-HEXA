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
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalGroup');getLocationGroups()" class="btn btn-primary" data-toggle="modal">
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


                    <!-- Modal Location Form -->
                    <div class="modal fade" tabindex="-1" id="modalLocation">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Location Info</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalLocation');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-validate is-alter">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Location Code</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Location Name</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.location_name" type="text" class="form-control" id="location-name" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label" for="email-address">Location Shortname</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.location_shortname" type="text" class="form-control" id="location-shortname" required>
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
                                    <input v-model="formLocationGroup.location_group_name" type="text" class="form-control" id="location-group-name" required>
                                    <button v-if="formLocationGroup.uuid === null" @click="saveLocationGroup()" type="submit" class="btn btn-sm btn-primary">Save</button>
                                    <button v-else @click="updateLocationGroup()" type="submit"  class="btn btn-sm btn-primary">Save Changes</button>
                                    
                                    <div class="card card-bordered card-preview">
                                        <table class="table table-tranx">
                                            <thead>
                                                <tr class="tb-tnx-head">
                                                    <th><span class="">#</span></th>
                                                    <th><span class="">Group Name</span></th>
                                                    <th><span class="">Date Added</span></th>
                                                    <th><span class="">Actions</span></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr v-for="(group, index) in location_groups" :key="group.uuid" class="tb-tnx-item">
                                                    <td><span class="">{{ (index + 1) }}</span></td>
                                                    <td><span class="">{{ group.location_group_name }}</span></td>
                                                    <td><span class="">{{ group.created_at }}</span></td>
                                                    <td>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
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
    },
    mounted() {
        var scope = this
        scope.getLocations()
    },
}
</script>