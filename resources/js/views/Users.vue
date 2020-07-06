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
                        <a href="javascript:void(0)" @click="OPEN_MODAL('#modalForm');resetData()" class="btn btn-primary" data-toggle="modal">
                            <em class="icon ni ni-plus"></em> <span>New User</span>
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
                                    <th><span class="">Full Name</span></th>
                                    <th><span class="">Phone #</span></th>
                                    <th><span class="">Company</span></th>
                                    <th><span class="">Date Added</span></th>
                                    <th><span class="">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(user, index) in users" :key="user.id" class="tb-tnx-item">
                                    <td><span class="">{{ (index + 1) }}</span></td>
                                    <td><span class="">{{ user.first_name }} {{ user.last_name }}</span></td>
                                    <td><span class="">{{ user.phone }}</span></td>
                                    <td><span class="">{{ user.company_id }}</span></td>
                                    <td><span class="">{{ user.created_at }}</span></td>
                                    <td>
                                        <span class="">
                                            <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalForm');setData(user)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                            <a href="javascript:void(0)"  @click="remove(user)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
                                        </span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                    <!-- Modal Form -->
                    <div class="modal fade" tabindex="-1" id="modalForm">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">User Info</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalForm');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-validate is-alter">
                                        <div class="row">
                                            <div class="col-12 col-md-6">
                                                 <div class="form-group">
                                                    <label class="form-label" for="full-name">First Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.first_name" type="text" class="form-control" id="first-name" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-6">
                                                 <div class="form-group">
                                                    <label class="form-label" for="full-name">Last Name</label>
                                                    <div class="form-control-wrap">
                                                        <input v-model="formdata.last_name" type="text" class="form-control" id="last-name" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br/>
                                        <div class="form-group">
                                            <label class="form-label" for="email-address">Email address</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.email" type="text" class="form-control" id="email-address" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="phone-no">Phone No</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.phone" type="text" class="form-control" id="phone-no">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label">Company</label>
                                            <div class="form-control-wrap">
                                                <select class="select-companies" name="state"> </select>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button v-if="formdata.id == null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
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
export default {
    name: 'home',
    props: ['properties'],
    data: function () {
        return {
            users: [],
            companies: [],
            formdata: { 
                id: null, 
                uuid: null, 
                company_id: null, 
                email: '', 
                first_name: '', 
                last_name: '', 
                phone: '' 
            }
        }
    },
    methods: {
        getUsers: function () {
           var scope = this
            scope.GET('users').then(res => {
                scope.users = res.rows
            })
        },
        getCompanies: function () {
           var scope = this
            scope.GET('companies').then(res => {
                for (let i = 0; i < res.rows.length; i++) {
                    let row = res.rows[i]
                    scope.companies.push({
                        id: row.id,
                        text: row.name,
                    })
                }
            })
        },
        setData: function (data) {
            var scope = this
            scope.formdata.id = data.id
            scope.formdata.company_id = data.company_id
            scope.formdata.email = data.email
            scope.formdata.first_name = data.first_name
            scope.formdata.last_name = data.last_name
            scope.formdata.phone = data.phone

            $('.select-companies').val( data.company_id).select2();
        },
        resetData: function () {
            var scope = this
            scope.formdata.id = null
            scope.formdata.uuid = null
            scope.formdata.company_id = null
            scope.formdata.email = ''
            scope.formdata.first_name = ''
            scope.formdata.last_name = ''
            scope.formdata.phone = ''
            $('.select-companies').val(1).select2();
        },
        remove: function (data) {
            swal({
                text: "Hello world!",
            })
        },
        save: function () {
            var scope = this
            scope.formdata.company_id = $('.select-companies').val()
            scope.POST('users', scope.formdata).then(res => {
                if (res.success) {
                    scope.rows.push(res.data)
                    scope.CLOSE_MODAL('#modalForm')
                } else {
                    alert('ERROR:' + res.code)
                }
            })
        },
        update: function () {
            var scope = this
            scope.formdata.company_id = $('.select-companies').val()
            scope.PUT('users', scope.formdata).then(res => {
                if (res.success) {
                    scope.getUsers()
                    scope.CLOSE_MODAL('#modalForm')
                } else {
                    alert('ERROR:' + res.code)
                }
            })
        },
        
    },
    mounted() {
        var scope = this
        scope.getUsers()
        scope.getCompanies()
        setTimeout(function(){
            $('.select-companies').select2({
                data: scope.companies
            });
        },1000);
    },
}
</script>