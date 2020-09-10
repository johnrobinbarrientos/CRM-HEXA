<template>
    <div>

        <div style="margin-top:10px; margin-bottom:10px;">
            <div class="row">
                <div class="col-12 col-md-3">
                    <input type="text" class="form-control" placeholder="Search Item">
                </div>
                <div class="col-12 col-md-2 offset-md-7">
                    <a href="javascript:void(0)" @click="OPEN_MODAL('#modalRegularDiscount');resetData()" class="btn btn-block btn-primary" data-toggle="modal">
                        <em class="icon ni ni-plus"></em> <span>New Regular Discount</span>
                    </a>
                </div>
            </div>
        </div>

         <table class="table table-striped table-bordered responsiveTable">
                <thead>
                    <tr class="tb-tnx-head">
                        <th width="100">Actions</th>
                        <th width="100">#</th>
                        <th>Discount Name</th>
                        <th>Discount Rate</th>
                        <th>Discount Fixed</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="(regular_discount, index) in regularDiscounts" :key="regular_discount.uuid" class="tb-tnx-item">
                        <td>
                            <span class="">
                                <a href="javascript:void(0)"  @click="OPEN_MODAL('#modalRegularDiscount');setData(regular_discount)" class="btn btn-sm btn-light"><i class="bx bx-pencil"></i></a>
                                <a href="javascript:void(0)"  @click="remove(regular_discount)" class="btn btn-sm btn-danger"><i class="bx bx-trash"></i></a>
                            </span>
                        </td>
                        <td><span class="">{{ (index + 1) }}</span></td>
                        <td><span class="">{{ regular_discount.discount_name }}</span></td>
                        <td><span class="">{{ regular_discount.discount_rate }} %</span></td>
                        <td><span class="">{{ regular_discount.discount_fixed }}</span></td>
                    </tr>
                </tbody>
            </table>
 

        <!-- Modal Discount Group Form -->
        <div class="modal fade" tabindex="-1" id="modalRegularDiscount">
            <div class="modal-dialog modal-md " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Regular Discount Details</h5>
                        <a href="javascript:void(0)"  @click="CLOSE_MODAL('#modalRegularDiscount');" class="close" data-dismiss="modal" aria-label="Close">
                            <i class="bx bx-x"></i>
                        </a>
                    </div>
                    <div class="modal-body">
                        <form action="#" class="form-validate is-alter">

                            <div class="row">
                                <div class="col-md-12 col-12">
                                    <div class="form-group">
                                        <label class="form-label" for="discount-name">Discount Name</label>
                                        <div class="form-control-wrap">
                                            <input v-model="formdata.discount_name" type="text" class="form-control" id="discount-name-regular" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">    
                                            <input v-model="formdata.discount_type" value ="rate" type="radio" id="option-rate-regular" class="custom-control-input">    
                                            <label class="custom-control-label" for="option-rate-regular">Rate</label>
                                        </div> 

                                        <div class="form-control-wrap">
                                            <input v-model="formdata.discount_rate" :disabled="isDisabledRate" type="text" class="form-control" id="discount-rate-regular" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <div class="custom-control custom-radio">    
                                            <input v-model="formdata.discount_type" value ="fixed" type="radio" id="option-fixed-regular" class="custom-control-input">    
                                            <label class="custom-control-label" for="option-fixed-regular">Fixed</label>
                                        </div> 

                                        <div class="form-control-wrap">
                                            <input v-model="formdata.discount_fixed" :disabled="isDisabledFixed" type="text" class="form-control" id="discount-fixed-regular" required>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6 col-12">
                                    <div class="form-group">
                                        <div class="form-control-wrap">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" v-model="formdata.is_active" value="1" class="custom-control-input" id="is-active">
                                                <label class="custom-control-label" for="is-active">Is Active?</label>
                                            </div>
                                        </div>
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
</template>

<script>

import Swal from 'sweetalert2'

export default {
    name: 'supplier-regular-discount',
    props: ['properties'],
    data: function () {
        return {
            regularDiscounts: [],
            formdata: { 
                uuid: null,
                supplier_uuid: '', 
                discount_type: 'rate',
                discount_name: '',
                discount_rate: '',
                discount_fixed: '',
                is_active: 1
            }

        }
    },
    computed: {
      isDisabledRate() {
        var scope = this
        if (scope.formdata.discount_type =='rate'){
            return false
        }
        else{
            scope.formdata.discount_rate = ''
            return true
        }  
      },
      isDisabledFixed() {
        var scope = this
        if (scope.formdata.discount_type =='fixed'){
            return false
        }
        else{
            scope.formdata.discount_fixed = ''
            return true
        }  
      }
    },
    methods: {
        getregularDiscounts: function () {
           var scope = this
            scope.GET('suppliers/supplier-regular-discount/' + scope.formdata.supplier_uuid).then(res => {
                scope.regularDiscounts = res.rows
            })
        },
        resetData: function () {
            var scope = this
            scope.formdata.uuid = null
            scope.formdata.discount_type = 'rate'
            scope.formdata.discount_name = ''
            scope.formdata.discount_rate = ''
            scope.formdata.discount_fixed = ''
            scope.formdata.is_active = 1
        },
        setData: function (data) {
            var scope = this
            scope.formdata.uuid = data.uuid
            scope.formdata.discount_type = data.discount_type
            scope.formdata.discount_name = data.discount_name
            scope.formdata.discount_rate = data.discount_rate
            scope.formdata.discount_fixed = data.discount_fixed
            scope.formdata.is_active = data.is_active
        },
        save: function () {
            var scope = this
            scope.POST('suppliers/supplier-regular-discount', scope.formdata).then(res => {
                if (res.success) {
                    window.swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Discount Successfuly Saved',
                        showConfirmButton: false,
                        timer: 1500
                    }).then(() => {
                        scope.getregularDiscounts()
                        scope.CLOSE_MODAL('#modalRegularDiscount')
                    })
                } else {
                    alert('ERROR:' + res.code)
                }
                
            })
        },
        update: function () {
            var scope = this
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
                    scope.POST('suppliers/supplier-regular-discount', scope.formdata).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Discount Updated',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                                scope.getregularDiscounts()
                                scope.CLOSE_MODAL('#modalRegularDiscount')
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
                    scope.POST('suppliers/supplier-regular-discount/delete', data).then(res => {
                        if (res.success) {
                            window.swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'Discount Group Deleted',
                                showConfirmButton: false,
                                timer: 1500
                            }).then(() => {
                            scope.getregularDiscounts()
                            scope.CLOSE_MODAL('#modalRegularDiscount')
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
        scope.formdata.supplier_uuid = scope.properties
        scope.getregularDiscounts()
        //console.log(scope.properties)
    },
}
</script>

<style scoped>
/* .table-tranx { table-layout: auto; width: 200%;} */

</style>