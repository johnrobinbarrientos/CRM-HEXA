<template>
    <div>
        <div class="hx-tab-1 round">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#categories" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Category</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#asset-group" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Asset Group</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#item-group" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Item Group</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#item-list" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Item</span>
                    </a>
                </li>

            </ul>
            <div class="clearfix"></div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="item-list" role="tabpanel">
                    <list></list>
                </div>
                <div class="tab-pane" id="item-group" role="tabpanel">
                    <group></group> 
                </div>
                <div class="tab-pane" id="asset-group" role="tabpanel">
                    <asset-group></asset-group>
                </div>
                <div class="tab-pane" id="categories" role="tabpanel">
                    <div class="actions-bar">
                        <div class="w-100">
                            <h1 class="title h-36"><i class="las la-layer-group"></i> Categories</h1>
                        </div>
                        <div class="bar-right"></div>
                    </div>
                    <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div id="accordion">
 
                                        <div class="card shadow-none">
                                            <a href="#collapseOne" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="m-0">Department</h5>
                                                    <i class="las la-plus-circle fs-30"></i>
                                                </div>
                                            </a>
                                        
                                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container-fluid">
                                                        
                                                            <cat-department></cat-department>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card shadow-none">
                                            <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="m-0">Section</h5>
                                                    <i class="las la-plus-circle fs-30"></i>
                                                </div>
                                            </a>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container-fluid">

                                                        <cat-section></cat-section>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card shadow-none">
                                            <a href="#collapseThree" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseThree">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="m-0">Category</h5>
                                                    <i class="las la-plus-circle fs-30"></i>
                                                </div>
                                            </a>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container-fluid">

                                                        <cat-category></cat-category>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card shadow-none">
                                            <a href="#collapseFour" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFour">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="m-0">Manufacturer</h5>
                                                    <i class="las la-plus-circle fs-30"></i>
                                                </div>
                                            </a>
                                            <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container-fluid">

                                                        <cat-manufacturer></cat-manufacturer>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="card shadow-none">
                                            <a href="#collapseFive" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFive">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="m-0">Item Type</h5>
                                                    <i class="las la-plus-circle fs-30"></i>
                                                </div>
                                            </a>
                                            <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container-fluid">

                                                        <cat-item-type></cat-item-type>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card shadow-none">
                                            <a href="#collapseSix" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSix">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="m-0">Brand</h5>
                                                    <i class="las la-plus-circle fs-30"></i>
                                                </div>
                                            </a>
                                            <div id="collapseSix" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container-fluid">

                                                        <cat-brand></cat-brand>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card shadow-none">
                                            <a href="#collapseSeven" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseSeven">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="m-0">Form</h5>
                                                    <i class="las la-plus-circle fs-30"></i>
                                                </div>
                                            </a>
                                            <div id="collapseSeven" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container-fluid">

                                                        <cat-form></cat-form>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card shadow-none">
                                            <a href="#collapseEight" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseEight">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="m-0">Packing Type</h5>
                                                    <i class="las la-plus-circle fs-30"></i>
                                                </div>
                                            </a>
                                            <div id="collapseEight" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container-fluid">

                                                        <cat-packing-type></cat-packing-type>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="card shadow-none">
                                            <a href="#collapseNine" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseNine">
                                                <div class="card-header" id="headingOne">
                                                    <h5 class="m-0">Sizes</h5>
                                                    <i class="las la-plus-circle fs-30"></i>
                                                </div>
                                            </a>
                                            <div id="collapseNine" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                                <div class="card-body">
                                                    <div class="container-fluid">

                                                        <cat-sizes></cat-sizes>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

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
import List from './list'
import Group from './group'
import AssetGroup from './asset-group'

import CatBrand from './cat-brand'
import CatCategory from './cat-category'
import CatDepartment from './cat-department'
import CatForm from './cat-form'
import CatItemType from './cat-item-type'
import CatManufacturer from './cat-manufacturer'
import CatPackingType from './cat-packing-type'
import CatSection from './cat-section'
import CatSizes from './cat-sizes'


export default {
    name: 'item-main',
    props: ['properties'],
    data: function () {
        return {
        }
    },
    components: {
        'list': List,
        'group': Group,
        'asset-group': AssetGroup,
        'cat-brand': CatBrand,
        'cat-category': CatCategory,
        'cat-department': CatDepartment,
        'cat-form': CatForm,
        'cat-item-type': CatItemType,
        'cat-manufacturer': CatManufacturer,
        'cat-packing-type': CatPackingType,
        'cat-section': CatSection,
        'cat-sizes': CatSizes
    },
    methods: {

    }
}
</script>