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
                            <em class="icon ni ni-plus"></em> <span>New Company</span>
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
                                    <th><span class="">Company Name</span></th>
                                    <th><span class="">Phone</span></th>
                                    <th><span class="">Address</span></th>
                                    <th><span class="">Date Added</span></th>
                                    <th><span class="">Actions</span></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr v-for="(company, index) in companies" :key="company.id" class="tb-tnx-item">
                                    <td><span class="">{{ (index + 1) }}</span></td>
                                    <td><span class="">{{ company.name }}</span></td>
                                    <td><span class="">{{ company.phone }}</span></td>
                                    <td><span class="">{{ company.address }}</span></td>
                                    <td><span class="">{{ company.created_at }}</span></td>
                                    <td>
                                        <span class="">
                                            <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalForm');setData(company)" class="btn btn-sm btn-light"><em class="icon ni ni-pen2"></em></a>
                                            <a href="javascript:void(0)"  @click="remove(company)" class="btn btn-sm btn-danger"><em class="icon ni ni-trash"></em></a>
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
                                    <h5 class="modal-title">Company Info</h5>
                                    <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalForm');" class="close" data-dismiss="modal" aria-label="Close">
                                        <em class="icon ni ni-cross"></em>
                                    </a>
                                </div>
                                <div class="modal-body">
                                    <form action="#" class="form-validate is-alter">
                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Company Name</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.name" type="text" class="form-control" id="first-name" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <label class="form-label" for="full-name">Phone</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.phone" type="text" class="form-control" id="last-name" required>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label class="form-label" for="email-address">Address</label>
                                            <div class="form-control-wrap">
                                                <input v-model="formdata.address" type="text" class="form-control" id="email-address" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="form-label" for="email-address">Description</label>
                                            <div class="form-control-wrap">
                                                <textarea v-model="formdata.description" type="text" class="form-control" id="email-address" required></textarea>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer bg-light">
                                    <button v-if="formdata.id === null" @click="save()" type="submit" class="btn btn-lg btn-primary">Save</button>
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
            companies: [],
            formdata: { 
                id: null, 
                name: '', 
                phone: '', 
                address: '', 
                description: '' 
            }
        }
    },
    methods: {
        getCompanies: function () {
           var scope = this
            scope.GET('companies').then(res => {
                scope.companies = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.id = null
            scope.formdata.name = null
            scope.formdata.phone = ''
            scope.formdata.address = ''
            scope.formdata.description = ''
        },
        setData: function (data) {
            var scope = this
            scope.formdata.id = data.id
            scope.formdata.name = data.name
            scope.formdata.phone = data.phone
            scope.formdata.address = data.address
            scope.formdata.description = data.description
        },
        save: function () {
            var scope = this
            scope.POST('companies', scope.formdata).then(res => {
                if (res.success) {
                    scope.companies.push(res.data)
                    scope.CLOSE_MODAL('#modalForm')
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
            scope.PUT('companies', scope.formdata).then(res => {
                if (res.success) {
                    scope.getCompanies()
                    scope.CLOSE_MODAL('#modalForm')
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        }
    },
    mounted() {
        var scope = this
        scope.getCompanies()
    },
}
</script>