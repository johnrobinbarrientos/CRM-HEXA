<template>
    <div>
        <div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="form-group">
                        <label>Customer</label>
                        <multiselect  v-model="selected_customer" :options="options_customers" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="true">
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
                        <label>Location</label>
                        <multiselect  v-model="selected_branch_location" :options="options_branch_location" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="true">
                            <span slot="noResult">No Results</span>
                        </multiselect>
                    </div>
                </div>

                <div class="col-12 col-md-6">
                    <div class="form-group mb-4">
                        <label class="form-label" for="project-list"><strong>Project</strong></label>
                        <multiselect  v-model="selected_project" :options="options_projects" track-by="uuid" label="text" :allow-empty="false"  deselect-label="Selected" selectLabel="Select" :preselectFirst="true">
                            <span slot="noResult">No Results</span>
                        </multiselect>
                    </div>
                </div>

            </div>
        </div>
        <br/>

        <div style="padding:10px 0px; text-align:right;">
            <button style="max-width:150px; display:inline-block;"  @click="save()" class="hx-btn hx-btn-shineblue" type="button" data-toggle="modal" href="javascript:void(0)">Next</button>
        </div>
    </div>
</template>

<script>

export default {
    name: 'progress-form',
    props: ['properties'],
    data: function () {
        return {
            formdata: {
                uuid: null,
                customer_uuid: null,
                branch_uuid: null,
                branch_location_uuid: null,
                project_uuid: null
            },

            selected_customer: [],
            options_customers: [],

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

                scope.selected_project = (scope.options_projects.length < 1) ? [] : {
                            uuid: scope.options_projects[0].uuid,
                            text: scope.options_projects[0].text
                        }
            })
        },

        getCustomers: function () {
           var scope = this

            scope.GET('customers/all').then(res => {

                res.rows.forEach(function (data) {
                    scope.options_customers.push({
                        uuid: data.uuid,
                        text: data.business_name,
                    })
                
                })

                scope.selected_customer = (scope.options_customers.length < 1) ? [] : {
                            uuid: scope.options_customers[0].uuid,
                            text: scope.options_customers[0].text
                        }

            })
        },

        save: function() {
            var scope = this

            scope.formdata.customer_uuid = (scope.selected_customer == null) ? null : scope.selected_customer.uuid
            scope.formdata.branch_location_uuid = (scope.selected_branch_location == null) ? null : scope.selected_branch_location.uuid
            scope.formdata.project_uuid = (scope.selected_project == null) ? null : scope.selected_project.uuid



            var qs = jQuery.param( scope.formdata );
            scope.ROUTE({path: '/sell-and-collect/bills/create-billings?' + qs })
            return

        },
    },
    mounted() {
        var scope = this

        scope.getUser();

        scope.getCustomers();
        scope.getProjects();
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}
</style>