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
                    <item-list></item-list>
                </div>
                <div class="tab-pane" id="item-group" role="tabpanel">
                    <item-group></item-group> 
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
                    <item-cat-department></item-cat-department>
                    <item-cat-section></item-cat-section>
                    <item-cat-category></item-cat-category>
                    <item-cat-manufacturer></item-cat-manufacturer>
                    <item-cat-item-type></item-cat-item-type>
                    <item-cat-brand></item-cat-brand>
                    <item-cat-form></item-cat-form>
                    <item-cat-packing-type></item-cat-packing-type>
                    <item-cat-sizes></item-cat-sizes>
                </div>
            </div>
        </div> 
    </div>
</template>

<script>
import ItemList from './item-list'
import ItemGroup from './item-group'
import ItemAssetGroup from './item-asset-group'

import ItemCatBrand from './item-cat-brand'
import ItemCatCategory from './item-cat-category'
import ItemCatDepartment from './item-cat-department'
import ItemCatForm from './item-cat-form'
import ItemCatItemType from './item-cat-item-type'
import ItemCatManufacturer from './item-cat-manufacturer'
import ItemCatPackingType from './item-cat-packing-type'
import ItemCatSection from './item-cat-section'
import ItemCatSizes from './item-cat-sizes'


export default {
    name: 'item-main',
    props: ['properties'],
    data: function () {
        return {
        }
    },
    components: {
        'item-list': ItemList,
        'item-group': ItemGroup,
        'asset-group': ItemAssetGroup,
        'item-cat-brand': ItemCatBrand,
        'item-cat-category': ItemCatCategory,
        'item-cat-department': ItemCatDepartment,
        'item-cat-form': ItemCatForm,
        'item-cat-item-type': ItemCatItemType,
        'item-cat-manufacturer': ItemCatManufacturer,
        'item-cat-packing-type': ItemCatPackingType,
        'item-cat-section': ItemCatSection,
        'item-cat-sizes': ItemCatSizes
    },
    methods: {

    }
}
</script>