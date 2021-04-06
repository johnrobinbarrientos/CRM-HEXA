<template>
    <div v-if="ready">
        <div class="card hx-card-override">
            <div class="card-header">
                <h5 class="mb-0">General Information</h5>
            </div>
            <div class="card-body">
                <div class="actions-bar">
                    <div class="w-100">
                        <span v-if ="view_mode">
                            <h1 class="title">View Details</h1>
                        </span>
                        <span v-else>
                            <span v-if ="!formdata.uuid">
                                <h1 class="title">New Details</h1>
                            </span>
                            <span v-else>
                                <h1 class="title">
                                    <i class="bx bx-data" @click="ROUTE({path: '/employee-main/' })"></i>
                                    <i class="las la-angle-right"></i>
                                    <span @click="ROUTE({path: '/employee-main/' })">Employee List</span>
                                    <i class="las la-angle-right ml-5px"></i>
                                    Form
                                </h1>
                            </span>
                        </span>
                    </div>
                    <div class="bar-right">
                        <span v-if ="view_mode">
                            <a @click="ROUTE({path: '/employee-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Close</a>
                            <a @click="ROUTE({path: '/employees/' + formdata.uuid })" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">Edit</a>
                        </span>
                        <span v-else>
                            <a @click="ROUTE({path: '/employee-main/' })" class="hx-btn hx-btn-gray" href="javascript:void(0)">Cancel</a>
                            <a  @click="save()" type="submit" class="hx-btn hx-btn-shineblue" href="javascript:void(0)">
                                <template v-if="!formdata.uuid">Save</template>
                                <template v-else>Update</template>
                            </a>
                        </span>
                    </div>
                </div>

                <form action="#" class="form-validate is-alter">
                    <div class="row">

                        <div class="col-md-3 col-12">
                            <div style="padding-right: 50px;">
                                <div class="form-group">
                                    <label class="form-label" for="employee-id">Employee ID</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.emp_id" style= "font-weight: bold;" type="text" class="form-control" id="employee-id" :readonly="view_mode">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="validationCustom03">First Name</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.first_name" type="text" style="text-transform: uppercase; font-weight: bold;" class="form-control" id="validationCustom03" :readonly="view_mode">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="middle-name">Middle Name</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.middle_name" type="text" style="text-transform: uppercase; font-weight: bold;" class="form-control" id="middle-name" :readonly="view_mode">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="last-name">Last Name</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.last_name" type="text" style="text-transform: uppercase; font-weight: bold;" class="form-control" id="last-name" :readonly="view_mode">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="form-label" for="ext">Ext Name</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.ext" type="text" style="text-transform: uppercase; font-weight: bold;" class="form-control" id="ext" :readonly="view_mode">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div style="padding-right: 50px;">
                                <div class="form-group">
                                    <label class="form-label" for="employee-branch">Branch</label>
                                    <strong><select class="form-select-branch" v-model="selected_branch" :options="options_branch" name="employee-branch" :disabled="view_mode">
                                    </select></strong>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="location">Assign Location</label>
                                    <strong><select class="form-select-branch-location" v-model="selected_branch_location" :options="options_branch_location" name="location" :disabled="view_mode">
                                    </select></strong>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="job-title">Job Title</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.job_title" style="text-transform: uppercase; font-weight: bold;" type="text" class="form-control" id="job-title" :readonly="view_mode">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="department">Department</label>
                                    <strong><select class="form-select-department" v-model="selected_department" :options="options_department" name="department" :disabled="view_mode">
                                    </select></strong>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="supervisor">Supervisor Name</label>
                                    <strong><select class="form-select-supervisor" v-model="selected_supervisor" :options="options_supervisor" name="supervisor" :disabled="view_mode">
                                    </select></strong>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="birth-date">Birth Date</label>
                                    <div class="form-control-wrap">
                                        <date-picker style="font-weight: bold;" v-model="formdata.birth_date" :config="{format: 'YYYY-MM-DD'}" :disabled="view_mode"></date-picker>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-md-3 col-12">
                            <div style="padding-right: 50px;">

                                <div class="form-group" style="margin-bottom: 40px;">
                                    <label class="form-label" for="gender">Gender</label>
                                    <strong><select class="form-select-gender" v-model="selected_gender" :options="options_gender" name="gender" :disabled="view_mode">
                                    </select></strong>
                                </div>

                                <div class="form-group" style="margin-top: 30px;">
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" v-model="formdata.is_custodian" true-value="1" false-value="0" class="custom-control-input" id="is-custodian" :disabled="view_mode">
                                            <label class="custom-control-label" for="is-custodian">Is Custodian?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 30px;">
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" v-model="formdata.is_driver " true-value="1" false-value="0" class="custom-control-input" id="is-driver" :disabled="view_mode">
                                            <label class="custom-control-label" for="is-driver">Is Driver?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 30px;">
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" v-model="formdata.is_system_user" true-value="1" false-value="0" class="custom-control-input" id="is-system-user" :disabled="view_mode">
                                            <label class="custom-control-label" for="is-system-user">Is System User?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 30px">
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" v-model="formdata.is_supervisor" true-value="1" false-value="0" class="custom-control-input" id="is-supervisor" :disabled="view_mode">
                                            <label class="custom-control-label" for="is-supervisor">Is Supervisor?</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group" style="margin-top: 30px;">
                                    <div class="form-control-wrap">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" v-model="formdata.is_active" true-value="1" false-value="0" class="custom-control-input" id="is-active" :disabled="view_mode">
                                            <label class="custom-control-label" for="is-active">Is Active?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div style="padding-right: 50px;">
                                <div @click="$refs.fileInput.click()" class="mb-3 text-center">
                                    <div v-if="fileImage"><img :src="fileImage"></div>
                                    <div v-else><img src='/images/default_pic.png'></div>
                                </div>
                                <input v-on:change="displayImage" ref="fileInput" type="file" class="employee-profile-pic hx-btn-upload" name="employee-profile-pic" accept=".png, .jpg, .jpeg">
                            </div>
                        </div>

                    </div>

                    <br/>
                    <br/>
                    <div class="hx-tab-2 round">
                            <ul class="nav nav-tabs">
                                <li>        
                                    <a class="" data-toggle="tab" href="#government">Government</a>    
                                </li>
                                <li>        
                                    <a class="" data-toggle="tab" href="#financial">Financial</a>    
                                </li>
                                <li>        
                                    <a class="" data-toggle="tab" href="#employement">Employment</a>    
                                </li>
                                <li>        
                                    <a class="" data-toggle="tab" href="#emergency-contact">Emergency Contact</a>    
                                </li>
                                <li>        
                                    <a class="active" data-toggle="tab" href="#address">Contact and Address</a>    
                                </li>
                            </ul>

                            <div class="clearfix"></div>

                            <div class="tab-content">

                                <div class="tab-pane active" id="address">
                                        <div class="row">
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="email">Email</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.email" style="font-weight: bold;" type="text" class="form-control" id="email" :readonly="view_mode">
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="form-label" for="contact-no">Contact No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.contact_no " style="font-weight: bold;" type="text" class="form-control" id="contact-no" :readonly="view_mode">
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-md-7 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="address-list">Search Address</label>
                                                    <strong><select class="form-select-address-list" v-model="selected_address" :options="options_address" name="address-list" :disabled="view_mode">
                                                    </select></strong>
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="address1">Purok/Street/Zone</label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="formdata.address1" style="text-transform: uppercase; font-weight: bold;" type="text" class="form-control" id="address1" :readonly="view_mode">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="province">Province:<small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="province" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="province" readonly="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="barangay">Barangay:<small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="barangay" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="barangay" readonly="true">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="region">Region:<small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="region" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="region" readonly="true">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="city-municipality">City/Municipality:<small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="city_municipality" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="city-municipality" readonly="true">
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="postal-code">Postal Code:<small style="color: #999; font-style: italic">(Auto Fill)</small></label>
                                                            <div class="form-control-wrap">
                                                                <input v-model="postal_code" style="text-transform: uppercase; font-weight: bold; background: #dddddd;" type="text" class="form-control" id="postal-code" readonly="true">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>


                                </div>

                                <div class="tab-pane" id="emergency-contact">
                                        <div class="row">

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="emergency-contact">Emergency Contact</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.emergency_contact" style="text-transform: uppercase;  font-weight: bold; " type="text" class="form-control" id="emergency-contact" :readonly="view_mode">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="contact-relation">Contact Relation</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.contact_relation" style="text-transform: uppercase; font-weight: bold;" type="text" class="form-control" id="contact-relation" :readonly="view_mode">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label class="form-label" for="emergency-contact-no">Emergency Contact No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.emergency_contact_no" style="text-transform: uppercase;  font-weight: bold; " type="text" class="form-control" id="emergency-contact-no" :readonly="view_mode">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane" id="employement">
                                        <div class="row">
                                            <div class="col-lg-7">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="employment-type">Employment Type</label>
                                                            <strong><select class="form-select-employment-type" v-model="selected_employment_type" :options="options_employment_type" name="employment-type" :disabled="view_mode">
                                                            </select></strong>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="form-group">
                                                            <label class="form-label" for="employment-status">Employment Status</label>
                                                            <strong><select class="form-select-employment-status" v-model="selected_employment_status" :options="options_employment_status" name="employment-status" :disabled="view_mode">
                                                            </select></strong>
                                                        </div>
                                                    </div>
                                                

                                                    <div class="col-lg-4 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="date-hired">Date Hired</label>
                                                            <div class="form-control-wrap">
                                                                <date-picker v-model="formdata.date_hired" style="font-weight: bold;" :config="DATEPICKER_CONFIG()" :disabled="view_mode"></date-picker>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-4 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="date-separated">Date Separated</label>
                                                            <div class="form-control-wrap">
                                                                <date-picker v-model="formdata.date_separated" style="font-weight: bold;" :config="DATEPICKER_CONFIG()" :disabled="view_mode"></date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
            


                                                    <div class="col-lg-4 col-12">
                                                        <div class="form-group">
                                                            <label class="form-label" for="date-regularized">Date Regularized</label>
                                                            <div class="form-control-wrap">
                                                                <date-picker v-model="formdata.date_regularized" style="font-weight: bold;" :config="DATEPICKER_CONFIG()" :disabled="view_mode"></date-picker>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane" id="financial">
                                        <div class="row">

                                            <div class="col-lg-3 col-12">
                                                <div class="h-100 d-flex align-items-center">
                                                    <div class="form-group">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" v-model="formdata.is_min_wage" true-value="1" false-value="0" class="custom-control-input" id="is-min-wage" :disabled="view_mode">
                                                            <label class="custom-control-label" for="is-min-wage">Is Minimum Wage?</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="daily-wage">Daily Wage</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.daily_wage" style="font-weight: bold;" type="text" class="form-control" id="daily-wage" :readonly="view_mode">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-lg-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="cost-center">Cost Center</label>
                                                    <strong><select class="form-select-cost-center" v-model="selected_cost_center" :options="options_cost_center" name="cost-center" :disabled="view_mode">
                                                    </select></strong>
                                                </div>
                                            </div>
                                        </div>
                                </div>

                                <div class="tab-pane" id="government">
                                        <div class="row">

                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="tax-id">TIN</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.tax_id" style="text-transform: uppercase;  font-weight: bold;" type="text" class="form-control" id="tax-id" :readonly="view_mode">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="phic-id">PHIC No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.phic_id" style="text-transform: uppercase;  font-weight: bold;" type="text" class="form-control" id="phic-id" :readonly="view_mode">
                                                    </div>
                                                </div>
                                            </div>
                                        
                                        </div>


                                        <div class="row">
                                            
                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="sss-id">SSS/UMID No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.sss_id" style="text-transform: uppercase;  font-weight: bold;" type="text" class="form-control" id="sss-id" :readonly="view_mode">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-3 col-12">
                                                <div class="form-group">
                                                    <label class="form-label" for="hdmf-id">HDMF No</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.hdmf_id" style="text-transform: uppercase;  font-weight: bold;" type="text" class="form-control" id="hdmf-id" :readonly="view_mode">
                                                    </div>
                                                </div>
                                            </div>
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

import Swal from 'sweetalert2'


export default {
    name: 'employee-list',
    props: ['properties','view_mode'],
    data: function () {
        return {
            prerequiste: {
                getCompanyDepartment: false,
                getBranch: false,
                getBranchLocation: false,
                getEmploymentType: false,
                getEmploymentStatus: false,
                getCostCenter: false,
                getAddressList: false,
                getSupervisors: false,
                getEmployeeDetails: false
            },

            selected_department: null,
            options_department: [],

            selected_branch: null,
            options_branch: [],

            selected_branch_location: null,
            options_branch_location: [],

            selected_employment_type: null,
            options_employment_type: [],

            selected_employment_status: null,
            options_employment_status: [],

            selected_cost_center: null,
            options_cost_center: [],

            selected_gender: null,
            options_gender: [
                {id: 'MALE', text: 'MALE'},
                {id: 'FEMALE', text: 'FEMALE'}
            ],

            selected_address: null,
            options_address: [],

            selected_supervisor: null,
            options_supervisor: [],

            employeeList: [],

            picture_file: null,
            fileImage: null,

            formdata: { 
                uuid: null,
                emp_id: '', 
                first_name: '', 
                middle_name: '',
                last_name: '',
                ext: '',
                branch_uuid: '',
                branch_location_uuid: '',
                is_custodian: '',
                is_driver: '',
                is_system_user: '',
                is_active: 1,
                email: '',
                contact_no: '',
                emergency_contact: '',
                contact_relation: '',
                emergency_contact_no: '',
                employment_type_uuid: '',
                employment_status_uuid: '',
                date_hired: '',
                date_regularized: '',
                date_separated: '',
                is_min_wage: '',
                daily_wage: '',
                cost_center_uuid: '',
                tax_id: '',
                sss_id: '',
                phic_id: '',
                hdmf_id: '',
                address_uuid: '',
                address1: '',
                job_title: '',
                is_supervisor: '',
                birth_date: '',
                department_uuid: '',
                supervisor_emp_uuid: '',
                gender: '',
                profile_pic: ''
            },

            barangay: '',
            city_municipality: '',
            province: '',
            region: '',
            postal_code: ''

        }
    },
    computed: {
        ready: function () {
            var scope = this

            if (scope.prerequiste.getEmployeeDetails && scope.prerequiste.getCompanyDepartment && scope.prerequiste.getBranch & scope.prerequiste.getBranchLocation  && scope.prerequiste.getEmploymentType && scope.prerequiste.getEmploymentStatus 
                && scope.prerequiste.getCostCenter && scope.prerequiste.getAddressList && scope.prerequiste.getSupervisors) {
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
                    $('.form-select-branch').val();
                    $('.form-select-branch').trigger('change');

                    $('.form-select-branch-location').val();
        
                    $(".form-select-department").select2({data: scope.options_department});
                    scope.selected_department = (scope.formdata.department_uuid) ? scope.formdata.department_uuid : scope.options_department[0].id
                    $(".form-select-department").val(scope.selected_department).trigger('change');
                    
                    $(".form-select-branch").select2({data: scope.options_branch});
                    scope.selected_branch = (scope.formdata.branch_uuid) ? scope.formdata.branch_uuid : scope.options_branch[0].id
                    $(".form-select-branch").val(scope.selected_branch).trigger('change');

                    $(".form-select-branch-location").select2({data: scope.options_branch_location});
                    if (scope.options_branch_location.hasOwnProperty('id')){ // select if list has values
                        scope.selected_branch_location = (scope.formdata.branch_location_uuid) ? scope.formdata.branch_location_uuid : scope.options_branch_location[0].id
                        $(document.body).find(".form-select-branch-location").val(scope.selected_branch_location).trigger('change')
                    }
                    
                    $(".form-select-employment-type").select2({data: scope.options_employment_type});
                    scope.selected_employment_type = (scope.formdata.employment_type_uuid) ? scope.formdata.employment_type_uuid : scope.options_employment_type[0].id
                    $(".form-select-employment-type").val(scope.selected_employment_type).trigger('change');

                    $(".form-select-employment-status").select2({data: scope.options_employment_status});
                    scope.selected_employment_status = (scope.formdata.employment_status_uuid) ? scope.formdata.employment_status_uuid : scope.options_employment_status[0].id
                    $(".form-select-employment-status").val(scope.selected_employment_status).trigger('change');

                    $(".form-select-cost-center").select2({data: scope.options_cost_center});
                    scope.selected_cost_center = (scope.formdata.cost_center_uuid) ? scope.formdata.cost_center_uuid : scope.options_cost_center[0].id
                    $(".form-select-cost-center").val(scope.selected_cost_center).trigger('change');

                    $(".form-select-supervisor").select2({data: scope.options_supervisor});
                    scope.selected_supervisor= (scope.formdata.supervisor_emp_uuid) ? scope.formdata.supervisor_emp_uuid : scope.options_supervisor[0].id
                    $(".form-select-supervisor").val(scope.selected_supervisor).trigger('change');

                    $(".form-select-gender").select2({data: scope.options_gender});
                    scope.selected_gender = (scope.formdata.gender) ? scope.formdata.gender : scope.options_gender[0].id
                    $(".form-select-gender").val(scope.selected_gender).trigger('change');

                    $(".form-select-address-list").select2({data: scope.options_address});
                    scope.selected_address= (scope.formdata.address_uuid) ? scope.formdata.address_uuid : scope.options_address[0].id
                    $(".form-select-address-list").val(scope.selected_address).trigger('change');
                    scope.fillAddress()
                    
                    

                    $(document).on('change','.form-select-gender', function(e) { 
                        scope.selected_gender = $('.form-select-gender').val();
                    })

                    $(document).on('change','.form-select-supervisor', function(e) { 
                        scope.selected_supervisor = $('.form-select-supervisor').val();
                    })

                    $(document).on('change','.form-select-department', function(e) { 
                        scope.selected_department = $('.form-select-department').val();
                    })

                    $(document).on('change','.form-select-branch', function(e) { 
                        scope.selected_branch = $('.form-select-branch').val();
                        scope.getBranchLocation(scope.selected_branch)
                    })

                    $(document).on('change','.form-select-branch-location', function(e) { 
                        scope.selected_branch_location = $('.form-select-branch-location').val();
                    })

                    $(document).on('change','.form-select-employment-type', function(e) { 
                        scope.selected_employment_type = $('.form-select-employment-type').val();
                    })

                    $(document).on('change','.form-select-employment-status', function(e) { 
                        scope.selected_employment_status = $('.form-select-employment-status').val();
                    })

                    $(document).on('change','.form-select-cost-center', function(e) { 
                        scope.selected_cost_center = $('.form-select-cost-center').val();
                    })

                    $(document).on('change','.form-select-address-list', function(e) { 
                        scope.selected_address = $('.form-select-address-list').val();
                        scope.fillAddress()
                    })

                },500) 
            } 
        },
    },

    methods: {

        displayImage: function () {
            let scope = this
            let reader = new FileReader()
            scope.picture_file = this.$refs.fileInput.files[0]

            reader.onload = function () {
                const image = new Image()
                image.src = reader.result.toString()
                scope.fileImage = image.src
            }

            reader.readAsDataURL(scope.picture_file)
        },

        getCompanyDepartment: function () {
           var scope = this
            scope.GET('company/department').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_department.push({
                        id: data.uuid,
                        text: data.department.toUpperCase()
                    })
                })

                scope.prerequiste.getCompanyDepartment = true

            })


        },
        getBranch: function () {
           var scope = this
            scope.GET('company/branch').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_branch.push({
                        id: data.uuid,
                        text: data.branch_name.toUpperCase()
                    })
                })

                // scope.getBranchLocation(scope.formdata.branch_uuid)

                scope.getBranchLocation((scope.formdata.branch_uuid) ? scope.formdata.branch_uuid : scope.options_branch[0].id)
                

                scope.prerequiste.getBranch = true
            })



        },
        getBranchLocation: function (branch_uuid) {
           var scope = this

           scope.options_branch_location = []

           console.log('branch_uuid')
           console.log(branch_uuid)

            scope.GET('company/branch-location/' + branch_uuid).then(res => {
                var branch_location_uuids = [];

                console.log(res.rows)

                res.rows.forEach(function (data) {
                    scope.options_branch_location.push({
                        id: data.uuid,
                        text: data.location_name.toUpperCase()
                    })
                    branch_location_uuids.push(data.uuid);
                })

                $(".form-select-branch-location").select2();
                $(".form-select-branch-location").html('');
                $(".form-select-branch-location").select2({data: scope.options_branch_location});
               
               scope.prerequiste.getBranchLocation = true
            })


        },

        getEmploymentType: function () {
           var scope = this
            scope.GET('employees/employment-type').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_employment_type.push({
                        id: data.uuid,
                        text: data.employment_type.toUpperCase()
                    })
                })

                scope.prerequiste.getEmploymentType = true


            })


        },

        getEmploymentStatus: function () {
           var scope = this
            scope.GET('employees/employment-status').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_employment_status.push({
                        id: data.uuid,
                        text: data.employment_status.toUpperCase()
                    })
                })
                
                scope.prerequiste.getEmploymentStatus = true

            })


        },

        getCostCenter: function () {
           var scope = this
            scope.GET('company/cost-center').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_cost_center.push({
                        id: data.uuid,
                        text: data.cost_center_name.toUpperCase()
                    })
                })

                scope.prerequiste.getCostCenter = true

            })


        },

        getAddressList: function () {
           var scope = this
            scope.GET('company/address-list').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_address.push({
                        id: data.uuid,
                        text: data.barangay.toUpperCase() + ', ' + data.city_municipality.toUpperCase() + ', ' + data.province.toUpperCase() + ' ' + data.postal_code.toUpperCase() + ' - ' + data.region.toUpperCase(),
                        barangay: data.barangay,
                        city_municipality: data.city_municipality,
                        province: data.province,
                        region: data.region,
                        postal_code: data.postal_code

                    })
                
                })

                scope.prerequiste.getAddressList = true


            })

        },

        getSupervisors: function () {
           var scope = this

           scope.options_supervisor.push({
               id: '',
               text: 'NONE'
           });

            scope.GET('employees/supervisors-list', {emp_uuid: scope.$route.params.employeeUUID}).then(res => {
                
                res.rows.forEach(function (data) {
                    var first_name = (data.first_name) ? data.first_name : '';
                    var middle_name = (data.middle_name) ? data.middle_name : '';
                    var last_name = (data.last_name) ? data.last_name : '';

                    scope.options_supervisor.push({
                        id: data.uuid,

                        text: first_name.toUpperCase() + ' ' + middle_name.toUpperCase() + ' ' + last_name.toUpperCase()
                    })
                
                })

                scope.prerequiste.getSupervisors = true
                
            })

        },

        fillAddress: function () {
           var scope = this
            for (var i = 0; i < scope.options_address.length; i++) {
                if(scope.options_address[i].id==scope.selected_address){
                    scope.barangay = scope.options_address[i].barangay
                    scope.city_municipality = scope.options_address[i].city_municipality
                    scope.province = scope.options_address[i].province
                    scope.region = scope.options_address[i].region
                    scope.postal_code = scope.options_address[i].postal_code
                }
            }
        },

        save: function () {
            var scope = this
            scope.formdata.department_uuid = scope.selected_department
            scope.formdata.branch_uuid = scope.selected_branch
            scope.formdata.branch_location_uuid = scope.selected_branch_location
            scope.formdata.employment_type_uuid = scope.selected_employment_type
            scope.formdata.employment_status_uuid = scope.selected_employment_status
            scope.formdata.cost_center_uuid = scope.selected_cost_center
            scope.formdata.address_uuid = scope.selected_address
            scope.formdata.supervisor_emp_uuid = scope.selected_supervisor
            scope.formdata.gender = scope.selected_gender

            let formData = new FormData()

            $.each(scope.formdata, function(index, value) {
                formData.append(index,value)
            })

            if (scope.picture_file) {
                formData.append('picture_file', scope.picture_file)
            }


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
                        scope.axios.post(window.API_URL + '/' + 'employees/'+ scope.formdata.uuid + '/update' , formData, {
                            'headers': {
                            'Content-Type': 'multipart/form-data',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Authorization': 'Bearer ' + localStorage.getItem(window.TOKEN_KEY)
                            }
                        })
                        .then(response => {
                            if (response.data.success) {
                                window.swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Updated',
                                    showConfirmButton: false,
                                    timer: 1500
                                }).then(() => {
                                    scope.ROUTE({path: '/employee-main/'})
                                })
                            }
                            else{
                                alert('ERROR:' + response.code)
                            }
                        }).catch(error => {
                            if (error.response.status == 411){
   
                            }
                        })            
                    }                              
                })

            }

            else{
                    scope.axios.post(window.API_URL + '/' + 'employees' , formData, {
                        'headers': {
                        'Content-Type': 'multipart/form-data',
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': 'Bearer ' + localStorage.getItem(window.TOKEN_KEY)
                        }
                    })
                    .then(response => {
                        if (response.data.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Saved',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.ROUTE({path: '/employee-main/'})
                            })
                        } else{
                            alert('ERROR:' + response.code)
                        }
                    }).catch(error => {
                        if (error.response.status == 411){

                        }
                    })
                } 

        },


        remove: function (data) {
            var scope = this

            window.swal.fire({
                title: 'Delete?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#548235',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.value) {
                    scope.POST('employees/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            })
                        }
                        else{
                            alert('ERROR:' + res.code)
                        }
                    })            
                }                              
            })
        },

        getEmployeeDetails: function (employeeUUID) {
            var scope = this

            if (!employeeUUID) {
                scope.getCompanyDepartment()
                scope.getBranch()
                scope.getEmploymentType()
                scope.getEmploymentStatus()
                scope.getCostCenter()
                scope.getAddressList()
                scope.getSupervisors()

                scope.prerequiste.getEmployeeDetails = true
                return;
            } 

            scope.GET('employees/' + employeeUUID).then(res => {
                let data = res.data

                    scope.formdata.uuid = data.uuid
                    scope.formdata.emp_id = data.emp_id
                    scope.formdata.first_name = data.first_name
                    scope.formdata.middle_name = data.middle_name
                    scope.formdata.last_name = data.last_name
                    scope.formdata.ext = data.ext
                    scope.formdata.is_custodian = data.is_custodian
                    scope.formdata.is_driver = data.is_driver
                    scope.formdata.is_system_user = data.is_system_user
                    scope.formdata.is_active = data.is_active
                    scope.formdata.email = data.email
                    scope.formdata.contact_no = data.contact_no
                    scope.formdata.emergency_contact = data.emergency_contact
                    scope.formdata.contact_relation = data.contact_relation
                    scope.formdata.emergency_contact_no = data.emergency_contact_no
                    scope.formdata.employment_type_uuid = data.employment_type_uuid
                    scope.formdata.employment_status_uuid = data.employment_status_uuid
                    scope.formdata.date_hired = data.date_hired
                    scope.formdata.date_regularized = data.date_regularized
                    scope.formdata.date_separated = data.date_separated
                    scope.formdata.is_min_wage = data.is_min_wage
                    scope.formdata.daily_wage = data.daily_wage
                    scope.formdata.tax_id = data.tax_id
                    scope.formdata.sss_id = data.sss_id
                    scope.formdata.phic_id = data.phic_id
                    scope.formdata.hdmf_id = data.hdmf_id
                    scope.formdata.address1 = data.address1
                    scope.formdata.job_title = data.job_title
                    scope.formdata.is_supervisor = data.is_supervisor
                    scope.formdata.birth_date = data.birth_date
                    scope.formdata.profile_pic = data.profile_pic

                    scope.formdata.branch_uuid = data.branch_uuid
                    console.log('details')
                    console.log(scope.formdata.branch_uuid)
                    scope.formdata.branch_location_uuid = data.branch_location_uuid
                    scope.formdata.address_uuid = data.address_uuid
                    scope.formdata.gender = data.gender


                    if (data.profile_pic) {
                        scope.fileImage = '/images/employees/' + data.profile_pic
                    }

                    scope.getCompanyDepartment()
                    scope.getBranch()
                    scope.getEmploymentType()
                    scope.getEmploymentStatus()
                    scope.getCostCenter()
                    scope.getAddressList()
                    scope.getSupervisors()

                    scope.prerequiste.getEmployeeDetails = true

                   
            })

        }

    },
    mounted() {
        var scope = this

        scope.formdata.uuid = (scope.$route.params.employeeUUID != 'create') ? scope.$route.params.employeeUUID : null
        scope.getEmployeeDetails(scope.formdata.uuid)

    },
}
</script>