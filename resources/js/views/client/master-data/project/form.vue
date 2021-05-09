<template>
    <div v-if="ready">
        <div class="card hx-card-override">
            <div class="card-header">
                <h5 class="mb-0">General Information</h5>
            </div>
            <div class="card-body">
                <div class="actions-bar">
                    <div class="w-100">
                        <span v-if="view_mode">
                            <h1 class="title">
                                <i class="bx bx-data" @click="ROUTE({path: '/project-main/' })"></i>
                                <span @click="ROUTE({path: '/project-main/' })">Project</span>
                                <i class="las la-angle-right"></i>
                                View
                            </h1>
                        </span>
                        <span v-else>
                            <span v-if="!formdata.uuid">
                                <h1 class="title">
                                    <i class="bx bx-data" @click="ROUTE({path: '/project-main/' })"></i>
                                    <span @click="ROUTE({path: '/project-main/' })">Project</span>
                                    <i class="las la-angle-right"></i>
                                    New
                                </h1>
                            </span>
                            <span v-else>
                                <h1 class="title">
                                    <i class="bx bx-data" @click="ROUTE({path: '/project-main/' })"></i>
                                    <span @click="ROUTE({path: '/project-main/' })">Project</span>
                                    <i class="las la-angle-right"></i>
                                    Edit
                                </h1>
                            </span>
                        </span>
                    </div>
                    <div class="bar-right">
                        <span v-if="view_mode">
                            <a @click="ROUTE({path: '/supplier-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Close</a>
                            <a @click="ROUTE({path: '/projects/' + formdata.uuid })" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Edit</a>
                        </span>
                        <span v-else>
                            <a @click="ROUTE({path: '/project-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)"><span>Cancel</span></a>
                            <a @click="save()" type="button" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">
                                <template v-if="formdata.uuid">Update</template>
                                <template v-else>Save</template>
                            </a>
                        </span> 
                    </div>
                </div>

                <form action="#" class="form-validate is-alter">

                    <div class="row">
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="project-code">Project Code</label>
                                <input type="text" class="form-control disabled" v-model="formdata.project_code" readonly>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="project-name">Project Name</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.project_name" type="text" class="form-control" id="project-name" :readonly="view_mode">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="project-shortname">Project Shortname</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.project_shortname" type="text" class="form-control" id="project-shortname" :readonly="view_mode">
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="main-project-type">Project Type</label>
                                <multiselect  v-model="selected_project_type" :options="options_project_type" track-by="uuid" label="text" :allow-empty="false" deselect-label="Selected" selectLabel="Select" :preselectFirst="project_new_mode">
                                    <span slot="noResult">No Results</span>
                                </multiselect>
                            </div>
                        </div>


                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                    <label class="form-label" for="date-start">Date Start</label>
                                    <div class="form-control-wrap">
                                        <DatePicker v-model="formdata.date_start" valueType="format" :format="'DD-MMM-YYYY'" :clearable="false" :disabled="view_mode"></DatePicker>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                    <label class="form-label" for="end-date">End Date</label>
                                    <div class="form-control-wrap">
                                        <DatePicker v-model="formdata.end_date" valueType="format" :format="'DD-MMM-YYYY'" :disabled="view_mode"></DatePicker>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                <label class="form-label" for="cost">Cost</label>
                                <div class="form-control-wrap">
                                    <input v-model="formdata.cost" type="text" class="form-control" id="cost" :readonly="view_mode">
                                </div>
                            </div>
                        </div>
      
                         
                    </div>

                </form>     
                </div>
            </div>


    </div>
</template>

<script>


// import ScopeOfWork from './scope-of-work'
import moment from 'moment'

export default {
    name: 'project-form',
    props: ['properties','view_mode'],

    data: function () {
        return {
            prerequiste: {
                getProjectType: false,
            },

            project_new_mode: true,

            selected_project_type: [],
            options_project_type: [],

            formdata: { 
                uuid: null,
                project_code: '',
                project_name: '', 
                project_shortname: '',
                project_type_uuid: '',
                date_start: moment(Date.now()).format('DD-MMM-YYYY'),
                end_date: '',
                cost: '',
            }
        }
    },

    computed: {
        ready: function () {
            var scope = this

            if (scope.prerequiste.getProjectType) {
                return true
            }

            return false
        }
    },

    watch: {
        ready: function (val) {
            var scope = this
            if (val) {
                setTimeout(function(){
                    
                scope.getProjectDetails(scope.formdata.uuid)

                },100) 
            } 
        },

    },

    methods: {

        getProjectType: function () {
           var scope = this

            scope.GET('projects/project-type').then(res => {
                res.rows.forEach(function (data) {

                    scope.options_project_type.push({
                        uuid: data.uuid,
                        text: data.type
                    })
                })

                scope.prerequiste.getProjectType = true
            })

        },

        save: function () {
            var scope = this

            scope.formdata.project_type_uuid = (scope.selected_project_type == null) ? null : scope.selected_project_type.uuid

            if (scope.formdata.uuid) {

                window.swal.fire({
                    title: 'Update?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#548235',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.value) {
                        scope.POST('projects', scope.formdata).then(res => {
                            if (res.success) {
                                window.swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Updated',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    scope.ROUTE({path: '/project-main/'})
                                })
                            } else {
                                alert('ERROR:' + res.code)
                            }
                        })
                    }                              
                })

            }
            else{
                scope.POST('projects', scope.formdata).then(res => {
                    if (res.success) {
                        window.swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Saved',
                            showConfirmButton: false,
                            timer: 1500
                        }).then(() => {
                            scope.ROUTE({path: '/project-main/'})
                        })
                    } else {
                        alert('ERROR:' + res.code)
                    }
                })
            }

        },

        getProjectDetails: function (projectUUID) {
            var scope = this

            if (projectUUID == null) {
                scope.formdata.project_code = "To be generated"
                return;
            }

            scope.GET('projects/' + projectUUID).then(res => {
            
                let data = res.data

                scope.project_new_mode = false

                scope.formdata.uuid = projectUUID
            
                scope.formdata.project_code = data.project_code
                scope.formdata.project_name = data.project_name
                scope.formdata.project_shortname = data.project_shortname
                scope.formdata.date_start = moment(data.date_start).format('DD-MMM-YYYY')
                scope.formdata.end_date =  moment(data.end_date).format('DD-MMM-YYYY')
                scope.formdata.cost = data.cost


                if (data.project_type !== null){
                    scope.selected_project_type = {
                        uuid: data.project_type.uuid,
                        text: data.project_type.type
                    }
                }

                
            })
        }
    },
    mounted() {
        var scope = this

        scope.getProjectType()

        scope.formdata.uuid = (scope.$route.params.projectUUID != 'create') ? scope.$route.params.projectUUID : null

    },
}
</script>
