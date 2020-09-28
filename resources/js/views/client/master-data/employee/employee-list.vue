<template>
    <div>
        <div v-show="show_preloader">
            <Spinner />
        </div>
        <div v-show="!show_form">
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title"><!--<i class="las la-users"></i>--><i class="las la-list-ul"></i> Employee List</h1>
                </div>
                <div class="bar-right">
                    <input type="text" class="form-control border-transparent form-focus-none" placeholder="Search">
                    <a @click="toggleForm();resetData()" class="hx-btn hx-btn-shineblue" data-toggle="modal" href="javascript:void(0)">
                        <i class="las la-plus"></i> New
                    </a>
                </div>
            </div>
            <div class="table-responsive"> 
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <!-- <th class="table-fixed-column" style="left:0px; width:150px; background: #f5f6fa;">Actions</th>
                            <th class="table-fixed-column" style="left:150px; width:100px; background: #f5f6fa;">#</th>
                            <th class="table-fixed-column" style="left:250px; width:200px; background: #f5f6fa; border-right:1px solid #dbdfea;">Shortname</th> -->
                            <th>Actions</th>
                            <th>#</th>
                            <th>Employee ID</th>
                            <th>First Name</th>
                            <th>Middle Name</th>
                            <th>Last Name</th>
                            <th>Ext</th>
                            <th>Is Custodian?</th>
                            <th>Is Driver?</th>
                            <th>Is System User?</th>
                            <th>Is Active</th>
                            <th>Contact No</th>
                            <th>Emergency Contact</th>
                            <th>Contact Relation</th>
                            <th>Relation Contact No</th>
                            <th>Location</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(employee, index) in employeeList" :key="employee.uuid">
                            <!-- <th class="table-fixed-column" style="border-top:1px solid #dbdfea; left:0px; width:150px; background:#fff;">Actions</th>
                            <td class="table-fixed-column" style="border-top:1px solid #dbdfea; left:150px; width:100px; background:#fff;">#</td>
                            <td class="table-fixed-column" style="border-top:1px solid #dbdfea; left:250px; width:200px; background:#fff; border-right:1px solid #dbdfea;">Shortname Tide</td> -->
                            <td>
                                <span class="d-block w-65px mx-auto">
                                    <a @click="setData(employee); toggleForm() " class="btn btn-sm btn-light" href="javascript:void(0)"><i class="mdi mdi-pencil"></i></a>
                                    <a @click="remove(employee)" class="btn btn-sm btn-danger" href="javascript:void(0)"><i class="mdi mdi-trash-can"></i></a>
                                </span>
                            </td>
                            <td class="text-right">{{ (index + 1) }}</td>
                            <td class="text-right">{{employee.emp_id}}</td>
                            <td>
                                <span class="d-block w-100px">
                                    {{employee.first_name}}
                                </span>
                            </td>
                            <td>
                                <span class="d-block w-100px">
                                    {{employee.middle_name}}
                                </span>
                            </td>
                            <td>
                                <span class="d-block w-100px">
                                    {{employee.last_name}}
                                </span>
                            </td>
                            <td class="text-right">{{employee.ext}}</td>
                            <td v-if="employee.is_custodian === 1">Yes</td>
                            <td v-else>No</td>
                            <td v-if="employee.is_driver === 1">Yes</td>
                            <td v-else>No</td>
                            <td v-if="employee.is_system_user === 1">Yes</td>
                            <td v-else>No</td>
                            <td v-if="employee.is_active === 1">Yes</td>
                            <td v-else>No</td>
                            <td class="text-right">{{employee.contact_no}}</td>
                            <td>
                                <span class="d-block w-120px">
                                    {{employee.emergeny_contact}}
                                </span>
                            </td>
                            <td>
                                <span class="d-block w-100px">
                                    {{employee.emergeny_contact_relation}}
                                </span>
                            </td>
                            <td class="text-right">{{employee.relation_contact_no}}</td>
                            <td>
                                <span class="d-block w-200px">
                                    {{employee.branch_location.location_name}}
                                </span>        
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>  

        <div v-show="show_form">
            <div class="actions-bar">
                <div class="w-100">
                    <h1 class="title">New Employee Details</h1>
                </div>
                <div class="bar-right">
                    <a v-if="formdata.uuid === null" @click="save()" type="submit" class="hx-btn hx-btn-primary" href="javascript:void(0)">Save</a>
                    <a v-else @click="update()" type="submit" class="hx-btn hx-btn-primary" href="javascript:void(0)">Save Changes</a>
                    <a @click="toggleForm(); resetData();" type="submit" class="hx-btn hx-btn-danger" href="javascript:void(0)">Cancel</a>       
                </div>
            </div>

            <form action="#" class="form-validate is-alter">

                <div class="row">
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="employee-id">Employee ID</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.emp_id" type="text" class="form-control" id="employee-id" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="first-name">First Name</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.first_name" type="text" class="form-control" id="first-name" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="middle-name">Middle Name</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.middle_name" type="text" class="form-control" id="middle-name" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="last-name">Last Name</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.last_name" type="text" class="form-control" id="last-name" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="ext">Ext</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.ext" type="text" class="form-control" id="ext" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="location">Location</label>
                            <select class="form-select-branch-location" v-model="selected_branch_location" :options="options_branch_location" name="location">
                            </select>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" v-model="formdata.is_custodian" true-value="1" false-value="0" class="custom-control-input" id="is-custodian">
                                    <label class="custom-control-label" for="is-custodian">Is Custodian?</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" v-model="formdata.is_driver " true-value="1" false-value="0" class="custom-control-input" id="is-driver">
                                    <label class="custom-control-label" for="is-driver">Is Driver?</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" v-model="formdata.is_system_user" true-value="1" false-value="0" class="custom-control-input" id="is-system-user">
                                    <label class="custom-control-label" for="is-system-user">Is System User?</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <div class="form-control-wrap">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" v-model="formdata.is_active" true-value="1" false-value="0" class="custom-control-input" id="is-active">
                                    <label class="custom-control-label" for="is-active">Is Active?</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="email">Email</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.email" type="text" class="form-control" id="email" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="contact-no">Contact No</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.contact_no " type="text" class="form-control" id="contact-no" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="emergency-contact">Emergency Contact</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.emergeny_contact" type="text" class="form-control" id="emergency-contact" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="contact-relation">Contact Relation</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.emergeny_contact_relation" type="text" class="form-control" id="contact-relation" required>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 col-12">
                        <div class="form-group">
                            <label class="form-label" for="relation-contact-no">Relation Contact No</label>
                            <div class="form-control-wrap">
                                <input v-model="formdata.relation_contact_no" type="text" class="form-control" id="relation-contact-no" required>
                            </div>
                        </div>
                    </div>
                    
                          
                </div>

                <br/>
                <ul class="nav nav-tabs">    
                        <li class="nav-item">        
                            <a class="nav-link active" data-toggle="tab" href="#employement">Employment</a>    
                        </li>    
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#financial">Financial and Contribution</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#address">Address</a>    
                        </li>     
                    </ul>

                    <div class="tab-content">    
                        <div class="tab-pane active" id="employement">
                    
                            <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="employment-type">Employment Type</label>
                                    <select class="form-select-employment-type" v-model="selected_employment_type" :options="options_employment_type" name="employment-type">
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="date-hired">Date Hired</label>
                                    <div class="form-control-wrap">
                                        <date-picker v-model="formdata.date_hired" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="date-regularized">Date Regularized</label>
                                    <div class="form-control-wrap">
                                        <date-picker v-model="formdata.date_regularized" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="date-terminated">Date Terminated</label>
                                    <div class="form-control-wrap">
                                        <date-picker v-model="formdata.date_terminated" :config="{format: 'YYYY-MM-DD'}"></date-picker>
                                    </div>
                                </div>
                            </div>
 
                        </div>

                        <div class="tab-pane" id="financial">
                            <div class="row">
                              
                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.is_min_wage" true-value="1" false-value="0" class="custom-control-input" id="is-min-wage">
                                                <label class="custom-control-label" for="is-min-wage">Is Minimum Wage?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="daily-wage">Daily Wage</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.daily_wage" type="text" class="form-control" id="daily-wage" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="cost-center">Cost Center</label>
                                        <select class="form-select-cost-center" v-model="selected_cost_center" :options="options_cost_center" name="cost-center">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.is_applied_tax" true-value="1" false-value="0" class="custom-control-input" id="is-applied-tax">
                                                <label class="custom-control-label" for="is-applied-tax">Is Applied WTax?</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="vat">Tax</label>
                                        <select class="form-select-ewt" v-model="selected_ewt" :options="options_ewt" name="vat">
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="tax-id">Tax ID</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.tax_id" type="text" class="form-control" id="tax-id" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="sss-id">SSS ID</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.sss_id" type="text" class="form-control" id="sss-id" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="phic-id">PHIC ID</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.phic_id" type="text" class="form-control" id="phic-id" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="hdmf-id">HDMF ID</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.hdmf_id" type="text" class="form-control" id="hdmf-id" required>
                                        </div>
                                    </div>
                                </div>
                            </div>    
                        </div>

                        <div class="tab-pane" id="address"> 

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="address1">Purok/Street/Zone</label>
                                    <div class="form-control-wrap">
                                        <input v-model="formdata.address1" type="text" class="form-control" id="address1" required>
                                    </div>
                                </div>
                            </div>
         
                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <select class="form-select-address-list" v-model="selected_global_address" :options="options_global_address" name="address-list">
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="barangay">Barangay</label>
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="barangay">{{barangay}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="city-municipality">City/Municipality</label>
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="city-municipality">{{city_municipality}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="province">Province</label>
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="province">{{province}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="region">Region</label>
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="region">{{region}}</label>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-12">
                                <div class="form-group">
                                    <label class="form-label" for="postal-code">Postal Code</label>
                                    <div class="form-control-wrap">
                                        <label class="form-label" for="postal-code">{{postal_code}}</label>
                                    </div>
                                </div>
                            </div>

                        </div>     
                 </div>
            </form>
        </div>        
             
    </div>
</template>

<script>

import Swal from 'sweetalert2'
import Spinner from '../../../components/Spinner'

export default {
    name: 'employee-list',
    props: ['properties'],
    data: function () {
        return {
            show_preloader: true,
            selected_branch_location: null,
            options_branch_location: [],

            selected_employment_type: null,
            options_employment_type: [],

            selected_cost_center: null,
            options_cost_center: [],

            selected_ewt: null,
            options_ewt: [],

            selected_global_address: null,
            options_global_address: [],

            show_form: false,

            employeeList: [],

            formdata: { 
                uuid: null, 
                emp_id: '', 
                first_name: '', 
                middle_name: '',
                last_name: '',
                ext: '',
                branch_location_uuid: '',
                is_custodian: '',
                is_driver: '',
                is_system_user: '',
                is_active: '',
                email: '',
                contact_no: '',
                emergeny_contact: '',
                emergeny_contact_relation: '',
                relation_contact_no: '',
                employment_type_uuid: '',
                date_hired: '',
                date_regularized: '',
                date_terminated: '',
                is_min_wage: '',
                daily_wage: '',
                cost_center_uuid: '',
                is_applied_tax: '',
                wt_uuid: '',
                tax_id: '',
                sss_id: '',
                phic_id: '',
                hdmf_id: '',
                global_address_uuid: '',
                address1: ''
            },

            barangay: '',
            city_municipality: '',
            province: '',
            region: '',
            postal_code: ''

        }
    },
    components: { Spinner },
    methods: {
        toggleForm() {
            var scope = this
            scope.show_form = !scope.show_form
        },
        
        getEmployeeList: function () {
           var scope = this
            scope.GET('employees/employee-list').then(res => {
                scope.employeeList = res.rows
            })
        },

        getBranchLocation: function () {
           var scope = this
            scope.GET('company/branch-location').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_branch_location.push({
                        id: data.uuid,
                        text: data.location_name
                    })
                })

                $(".form-select-branch-location").select2({data: scope.options_branch_location});
                
                scope.selected_branch_location = scope.options_branch_location[0].id
            })

        },

        getEmploymentType: function () {
           var scope = this
            scope.GET('employees/employment-type').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_employment_type.push({
                        id: data.uuid,
                        text: data.employment_type
                    })
                })

                $(".form-select-employment-type").select2({data: scope.options_employment_type});
                
                scope.selected_employment_type = scope.options_employment_type[0].id
            })

        },

        getCostCenter: function () {
           var scope = this
            scope.GET('company/cost-center').then(res => {
                res.rows.forEach(function (data) {
                    scope.options_cost_center.push({
                        id: data.uuid,
                        text: data.cost_center_name
                    })
                })

                $(".form-select-cost-center").select2({data: scope.options_cost_center});
                
                scope.selected_cost_center = scope.options_cost_center[0].id
            })

        },

        getEwt: function () {
           var scope = this
            scope.GET('company/taxation-wt').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_ewt.push({
                        id: data.uuid,
                        text: data.tax_name
                    })
                
                })

                $(".form-select-ewt").select2({data: scope.options_ewt});
                
                scope.selected_ewt = scope.options_ewt[0].id
            })

        },

        getAddressList: function () {
           var scope = this
            scope.GET('globals/address-list').then(res => {
                
                res.rows.forEach(function (data) {

                    scope.options_global_address.push({
                        id: data.uuid,
                        text: data.barangay + ' ' + data.city_municipality + ' ' + data.province + ' ' + data.region + ' ' + data.postal_code,
                        barangay: data.barangay,
                        city_municipality: data.city_municipality,
                        province: data.province,
                        region: data.region,
                        postal_code: data.postal_code

                    })
                
                })

                $(".form-select-address-list").select2({data: scope.options_global_address});
                scope.selected_global_address= scope.options_global_address[0].id
                scope.fillAddress()
                
            })

            

        },
        fillAddress: function () {
           var scope = this
            for (var i = 0; i < scope.options_global_address.length; i++) {
                if(scope.options_global_address[i].id==scope.selected_global_address){
                    scope.barangay = scope.options_global_address[i].barangay
                    scope.city_municipality = scope.options_global_address[i].city_municipality
                    scope.province = scope.options_global_address[i].province
                    scope.region = scope.options_global_address[i].region
                    scope.postal_code = scope.options_global_address[i].postal_code
                }
            }
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.emp_id = ''
            scope.formdata.first_name = ''
            scope.formdata.middle_name = ''
            scope.formdata.last_name = ''
            scope.formdata.ext = ''
            scope.formdata.branch_location_uuid = ''
            scope.formdata.is_custodian = ''
            scope.formdata.is_driver = ''
            scope.formdata.is_system_user = ''
            scope.formdata.is_active = ''
            scope.formdata.email = ''
            scope.formdata.contact_no = ''
            scope.formdata.emergeny_contact = ''
            scope.formdata.emergeny_contact_relation = ''
            scope.formdata.relation_contact_no = ''
            scope.formdata.employment_type_uuid = ''
            scope.formdata.date_hired = ''
            scope.formdata.date_regularized = ''
            scope.formdata.date_terminated = ''
            scope.formdata.is_min_wage = ''
            scope.formdata.daily_wage = ''
            scope.formdata.cost_center_uuid = ''
            scope.formdata.is_applied_tax = ''
            scope.formdata.wt_uuid = ''
            scope.formdata.tax_id = ''
            scope.formdata.sss_id = ''
            scope.formdata.phic_id = ''
            scope.formdata.hdmf_id = ''
            scope.formdata.global_address_uuid = ''
            scope.formdata.address1 = ''

        },
        setData: function (data) {
            var scope = this
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
            scope.formdata.emergeny_contact = data.emergeny_contact
            scope.formdata.emergeny_contact_relation = data.emergeny_contact_relation
            scope.formdata.relation_contact_no = data.relation_contact_no
            scope.formdata.employment_type_uuid = data.employment_type_uuid
            scope.formdata.date_hired = data.date_hired
            scope.formdata.date_regularized = data.date_regularized
            scope.formdata.date_terminated = data.date_terminated
            scope.formdata.is_min_wage = data.is_min_wage
            scope.formdata.daily_wage = data.daily_wage
            scope.formdata.is_applied_tax = data.is_applied_tax
            scope.formdata.wt_uuid = data.wt_uuid
            scope.formdata.tax_id = data.tax_id
            scope.formdata.sss_id = data.sss_id
            scope.formdata.phic_id = data.phic_id
            scope.formdata.hdmf_id = data.hdmf_id
            scope.formdata.address1 = data.address1

            $('.form-select-branch-location').val(data.branch_location_uuid);
            $('.form-select-branch-location').trigger('change');

            $('.form-select-employment-type').val(data.employment_type_uuid);
            $('.form-select-employment-type').trigger('change');

            $('.form-select-cost-center').val(data.cost_center_uuid);
            $('.form-select-cost-center').trigger('change');

            $('.form-select-ewt').val(data.wt_uuid);
            $('.form-select-ewt').trigger('change');


            $('.form-select-address-list').val(data.global_address_uuid);
            $('.form-select-address-list').trigger('change');
        },
        save: function () {
            var scope = this
            scope.formdata.branch_location_uuid = scope.selected_branch_location
            scope.formdata.employment_type_uuid = scope.selected_employment_type
            scope.formdata.cost_center_uuid = scope.selected_cost_center
            scope.formdata.wt_uuid = scope.selected_ewt
            scope.formdata.global_address_uuid = scope.selected_global_address

            scope.POST('employees/employee-list', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Employee Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getEmployeeList()
                        scope.toggleForm()
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.formdata.branch_location_uuid = scope.selected_branch_location
            scope.formdata.employment_type_uuid = scope.selected_employment_type
            scope.formdata.cost_center_uuid = scope.selected_cost_center
            scope.formdata.wt_uuid = scope.selected_ewt
            scope.formdata.global_address_uuid = scope.selected_global_address
            
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
                    scope.POST('employees/employee-list', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Employee Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getEmployeeList()
                                scope.toggleForm()
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
                    scope.POST('employees/employee-list/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Employee Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getEmployeeList()
                            scope.toggleForm()
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
        scope.getEmployeeList()

        scope.getBranchLocation()
        scope.getEmploymentType()
        scope.getCostCenter()
        scope.getEwt()
        scope.getAddressList()


        $('.form-select-branch-location').on("change", function(e) { 
            scope.selected_branch_location = $('.form-select-branch-location').val();
        })
        
        $('.form-select-employment-type').on("change", function(e) { 
            scope.selected_employment_type = $('.form-select-employment-type').val();
        })

        $('.form-select-cost-center').on("change", function(e) { 
            scope.selected_cost_center = $('.form-select-cost-center').val();
        })

        $('.form-select-ewt').on("change", function(e) { 
            scope.selected_ewt = $('.form-select-ewt').val();
        })

        $('.form-select-address-list').on("change", function(e) { 
            scope.selected_global_address = $('.form-select-address-list').val();
            scope.fillAddress()
        })

        setTimeout(function(){ scope.show_preloader = false },2000)
    },
}
</script>

<style scoped>
.form-group { margin-top:10px !important; }
</style>