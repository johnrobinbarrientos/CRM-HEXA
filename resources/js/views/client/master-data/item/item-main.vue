<template>
    <div>
        <div class="hx-tab">
            <!-- Nav tabs -->
            <ul v-if="showNavTabs" class="nav nav-tabs" role="tablist">
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
                    <a class="nav-link" data-toggle="tab" href="#item-discount-group" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Item Discount Group</span>    
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
                <div class="tab-pane" id="item-discount-group" role="tabpanel">
                    <item-discount-group></item-discount-group>
                </div>
                <div class="tab-pane" id="categories" role="tabpanel">
                    <div class="actions-bar">
                        <div class="w-100">
                            <h1 class="title h-36"><i class="las la-layer-group"></i> Categories</h1>
                        </div>
                        <div class="bar-right"></div>
                    </div>
                    <category-1></category-1>
                    <category-2></category-2>
                    <category-3></category-3>
                    <category-4></category-4>
                    <category-5></category-5>
                </div>
            </div>
        </div> 
    </div>
</template>

<script>
import ItemList from './item-list'
import ItemGroup from './item-group'
import ItemAssetGroup from './item-asset-group'
import ItemDiscountGroup from './item-discount-group'
import ItemCategory1 from './item-category-1'
import ItemCategory2 from './item-category-2'
import ItemCategory3 from './item-category-3'
import ItemCategory4 from './item-category-4'
import ItemCategory5 from './item-category-5'

export default {
    name: 'item-main',
    props: ['properties'],
    data: function () {
        return {
            showNavTabs: true
        }
    },
    components: {
        'item-list': ItemList,
        'item-group': ItemGroup,
        'asset-group': ItemAssetGroup,
        'item-discount-group': ItemDiscountGroup,
        'category-1': ItemCategory1,
        'category-2': ItemCategory2,
        'category-3': ItemCategory3,
        'category-4': ItemCategory4,
        'category-5': ItemCategory5
    },
    methods: {
        toggleNavTabs: function() {
            var scope = this
            scope.showNavTabs = !scope.showNavTabs
        }
    }
}
</script>

        hide_navTabs() {
            
        }