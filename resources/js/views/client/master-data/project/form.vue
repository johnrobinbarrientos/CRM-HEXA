<template>
    <div>
        <div class="card hx-card-override">
            <div class="card-header">
                <h5 class="mb-0">General Information</h5>
            </div>
            <div class="card-body">
                <div class="actions-bar">
                    <div class="w-100">
                        <span v-if="view_mode">
                            <h1 class="title">View Project Details</h1>
                        </span>
                        <span v-else>
                            <span v-if="formdata.is_draft">
                                <h1 class="title">New Project Details</h1>
                            </span>
                            <span v-else>
                                <h1 class="title">Edit Project Details</h1>
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
                            <a v-if="formdata.is_draft" @click="save()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)"><span>Save</span></a>
                            <a v-else @click="update()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Update</a>
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
                                <select class="form-select-project-type" v-model="selected_project_type" :options="options_project_type" name="main-project-type" :disabled="view_mode">
                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                    <label class="form-label" for="date-start">Date Start</label>
                                    <div class="form-control-wrap">
                                        <date-picker v-model="formdata.date_start" :config="{format: 'DD-MMM-YYYY'}" :disabled="view_mode"></date-picker>
                                    </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div class="form-group">
                                    <label class="form-label" for="end-date">End Date</label>
                                    <div class="form-control-wrap">
                                        <date-picker v-model="formdata.end_date" :config="{format: 'DD-MMM-YYYY'}" :disabled="view_mode"></date-picker>
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

            <!-- <br/>
                <div class="hx-tab-2 round">
                    <ul class="nav nav-tabs">
                        <li>
                            <a class="active" data-toggle="tab" href="#scope">Detail</a>    
                        </li>    
                    </ul>
                    <div class="clearfix"></div>

                    <div class="tab-content">    
                        <div class="tab-pane active" id="scope">
                           
                        </div>
                    </div>  

                </div> -->


    </div>
</template>

<script>


// import ScopeOfWork from './scope-of-work'

export default {
    name: 'project-form',
    props: ['properties','view_mode'],

    data: function () {
        return {

            selected_project_type: null,
            options_project_type: [],

            formdata: { 
                uuid: null,
                is_draft: 1,
                project_code: '',
                project_name: '', 
                project_shortname: '',
                project_type_uuid: '',
                date_start: '',
                end_date: '',
                cost: '',
            }
        }
    },
    // components: {
    //     'scope-of-work': ScopeOfWork
    // },
    methods: {

        getProjectType: function () {
           var scope = this
            scope.GET('projects/project-type').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_project_type.push({
                        id: data.uuid,
                        text: data.type
                    })
                })

                $(".form-select-project-type").select2({data: scope.options_project_type});
                
                scope.selected_project_type = scope.options_project_type[0].id
            })

        },

        save: function () {
            var scope = this

            scope.formdata.project_type_uuid = scope.selected_project_type

            scope.PUT('projects', scope.formdata).then(res => {
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
        },

        update: function () {
            var scope = this

            scope.formdata.project_type_uuid = scope.selected_project_type
            
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
                    scope.PUT('projects', scope.formdata).then(res => {
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
        },

        getProjectDetails: function (projectUUID) {
            var scope = this
            scope.GET('projects/' + projectUUID).then(res => {
            
                let data = res.data

                scope.formdata.uuid = projectUUID
                scope.formdata.project_code = "To be generated"

                if (data.is_draft=== 0) {
                    scope.formdata.is_draft = data.is_draft
                    scope.formdata.project_code = data.project_code
                    scope.formdata.project_name = data.project_name
                    scope.formdata.project_shortname = data.project_shortname
                    scope.formdata.date_start = data.date_start
                    scope.formdata.end_date = data.end_date
                    scope.formdata.cost = data.cost


                    $('.form-select-project-type').val(data.project_type_uuid);
                    $('.form-select-project-type').trigger('change');
                }
                
            })
        }
    },
    mounted() {
        var scope = this

        var projectUUID = scope.$route.params.projectUUID
        scope.getProjectDetails(projectUUID)

        scope.getProjectType()

        $('.form-select-project-type').on("change", function(e) { 
            scope.selected_project_type = $('.form-select-project-type').val();
        })

    },
}
</script>
