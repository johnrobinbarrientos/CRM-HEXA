<template>
    <div>
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
            <div class="nk-fmg-search">
                <em class="icon ni ni-search"></em>
                <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search Item">
            </div>
            <div class="nk-fmg-actions">
                <ul class="nk-block-tools g-3">
                    <li>
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalLocation');resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New Item</span>
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
                                            <th><span class="">Item Group</span></th>
                                            <th><span class="">Item Code</span></th>
                                            <th><span class="">Item Barocode</span></th>
                                            <th><span class="">Case/Box Barocde</span></th>
                                            <th><span class="">Description</span></th>
                                            <th><span class="">Shortname</span></th>
                                            <th><span class="">Supplier Name</span></th>
                                            <th><span class="">Category 1</span></th>
                                            <th><span class="">Category 2</span></th>
                                            <th><span class="">Category 3</span></th>
                                            <th><span class="">Category 4</span></th>
                                            <th><span class="">Category 5</span></th>
                                            <th><span class="">Is Purchase Item?</span></th>
                                            <th><span class="">Purchase UOM</span></th>
                                            <th><span class="">Purchase Cost</span></th>
                                            <th><span class="">Is Sales Item?</span></th>
                                            <th><span class="">Sales UOM</span></th>
                                            <th><span class="">Sales Cost</span></th>
                                            <th><span class="">Transfer Cost</span></th>
                                            <th><span class="">Is Expiry</span></th>
                                            <th><span class="">VAT Name</span></th>
                                            <th><span class="">Income Account</span></th>
                                            <th><span class="">Cost Of Sales Account</span></th>
                                            <th><span class="">Re-Order Qty</span></th>
                                            <th><span class="">Asset Group</span></th>
                                            <th><span class="">Plate Number</span></th>
                                            <th><span class="">Assigned To</span></th>
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
                                    <h5 class="modal-title">Item Details</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalLocation');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-validate is-alter">

                                        <div class="row">
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Item Group</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Product</option>
                                                        <option value="WY">Asset</option>
                                                        <option value="WY">Service</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Item Code</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Item Barocode</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Case/Box Barocde</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Item Description</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Item Shortname</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Supplier Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Category 1</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Category 2</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Category 3</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Category 4</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Category 5</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                                        <label class="custom-control-label" for="customCheck1">Is Purchase Item?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Purchase UOM</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">PC</option>
                                                        <option value="WY">CS</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Purchase Cost</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck2">
                                                        <label class="custom-control-label" for="customCheck2">Is Sales Item?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Sales UOM</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">PC</option>
                                                        <option value="WY">CS</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Sales Cost</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Transfer Cost</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="customCheck3">
                                                        <label class="custom-control-label" for="customCheck3">Is Expiry?</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">VAT Name</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Income Account</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Cost Of Sales Account</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Re-Order Qty</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Asset Group</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">MV Registration No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Plate Number</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.location_code" type="text" class="form-control" id="location-code" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="business-name">Assigned To</label>
                                                    <select class="form-select" name="state">
                                                        <option value="AL">Alabama</option>
                                                        <option value="WY">Wyoming</option>
                                                    </select>
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
.table-tranx { table-layout: auto; width: 600%;}

</style>