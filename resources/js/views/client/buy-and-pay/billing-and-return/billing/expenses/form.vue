<template>
    <div>
        <div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Supplier</label>
                        <multiselect  v-model="selected_supplier" :options="options_supplier" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="true">
                            <span slot="noResult">No Results</span>
                        </multiselect>

                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Branch</label>
                        <input type="text" class="form-control disabled" v-model="user_branch" readonly >
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Amount payable</label>
                        <input v-model="formdata.amount" type="text" class="form-control" >
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Location</label>
                        <multiselect  v-model="selected_branch_location" :options="options_branch_location" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="true">
                            <span slot="noResult">No Results</span>
                        </multiselect>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group mb-4">
                        <label class="form-label" for="project-list"><strong>Project</strong></label>
                        <multiselect  v-model="selected_project" :options="options_projects" :multiple="true" track-by="uuid" label="text" deselect-label="Deselect" selectLabel="Select">
                            <span slot="noResult">No Results</span>
                        </multiselect>
                    </div>
                </div>

            </div>
        </div>
        <br/>

        <div style="padding:10px 0px; text-align:right;">
            <button v-if="formdata.amount > 0" style="max-width:150px; display:inline-block;"  @click="save()" class="hx-btn hx-btn-shineblue" type="button" data-toggle="modal" href="javascript:void(0)">Next</button>
            <button v-else style="max-width:150px; display:inline-block;"  class="hx-btn hx-btn-shineblue" type="button" data-toggle="modal" href="javascript:void(0)" disabled="true">Next</button>

        </div>
    </div>
</template>

<script>

export default {
    name: 'expense-form',
    props: ['properties'],
    data: function () {
        return {
            formdata: {
                type: 'Expenses',
                uuid: null,
                amount: 0.00,
                supplier_uuid: null,
                branch_uuid: null,
                branch_location_uuid: null,
                projects: []
            },

            selected_supplier: [],
            options_supplier: [],

            selected_branch_location: null,
            options_branch_location: [],

            selected_project: null,
            options_projects: [],

            user_branch: '',
            user_location: '',
            user_location_uuid: null,
            preselect: true
        }
    },
    computed: {
      
    },
    methods: {
        
        getUser: function () {
           var scope = this

            scope.GET('users/get-user').then(res => {

                let data = res.data

                scope.user_location = data.branch_location.location_name
                scope.user_location_uuid = data.branch_location.uuid
                scope.user_branch = data.branch.branch_name

                scope.formdata.branch_uuid = data.branch.uuid
                scope.getBranchLocations(data.branch.uuid);

                console.log(data)

            })
        },

        getBranchLocations: function (branch_uuid) {
           var scope = this
           
            scope.GET('company/branch-location/' + branch_uuid).then(res => {
                res.rows.forEach(function (data) {

                    scope.options_branch_location.push({
                        uuid: data.uuid,
                        text: data.location_name
                    })

                    scope.selected_branch_location = (scope.options_branch_location.length < 1) ? [] : {
                            uuid: scope.user_location_uuid,
                            text: scope.user_location
                        }
                
                })
            })
        },

        getProjects: function () {
            var scope = this
            scope.GET('projects').then(res => {
              
                res.rows.forEach(function (data) {

                    scope.options_projects.push({
                        uuid: data.uuid,
                        text: data.project_name
                    })
                
                })
            })
        },

        getSupplier: function () {
           var scope = this

            scope.GET('suppliers').then(res => {

                res.rows.forEach(function (data) {
                    scope.options_supplier.push({
                        uuid: data.uuid,
                        text: data.supplier_shortname,
                        lead_time: data.lead_time,
                        vat_uuid: data.vat_uuid
                    })
                
                })

                scope.selected_supplier = (scope.options_supplier.length < 1) ? [] : {
                            uuid: scope.options_supplier[0].uuid,
                            text: scope.options_supplier[0].text
                        }

            })
        },

        save: function() {
            var scope = this

            scope.formdata.supplier_uuid = (scope.selected_supplier == null) ? null : scope.selected_supplier.uuid
            scope.formdata.branch_location_uuid = (scope.selected_branch_location == null) ? null : scope.selected_branch_location.uuid

            console.log(scope.selected_project)
            if (scope.selected_project != null){
                scope.selected_project.forEach(function (data) {
                    scope.formdata.projects.push({
                        uuid: data.uuid,
                    })

                })

            }


            var qs = jQuery.param( scope.formdata );
            scope.ROUTE({path: '/buy-and-pay/bills/create-expenses?' + qs })
            return

        },
    },
    mounted() {
        var scope = this

        scope.getUser();

        scope.getSupplier();
        scope.getProjects();
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}
</style>