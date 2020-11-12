<template>
    <div>
        <div class="hx-tab">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#item-list" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Item List</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#item-group" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Item Group</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#asset-group" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Assets Group</span>    
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#categories" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Categories</span>    
                    </a>
                </li>
            </ul>

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
                <div class="tab-pane container" id="categories" role="tabpanel">
                    <div class="actions-bar">
                        <div class="w-100">
                            <h1 class="title h-36"><i class="las la-layer-group"></i> Categories</h1>
                        </div>
                        <div class="bar-right"></div>
                    </div>
                    <cat-department></cat-department>
                    <cat-section></cat-section>
                    <cat-category></cat-category>
                    <cat-manufacturer></cat-manufacturer>
                    <cat-item-type></cat-item-type>
                    <cat-brand></cat-brand>
                    <cat-form></cat-form>
                    <cat-packing-type></cat-packing-type>
                    <cat-sizes></cat-sizes>
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