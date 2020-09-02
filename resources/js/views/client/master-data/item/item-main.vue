<template>
    <div>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs">
                    <li class="nav-item"><a class="active nav-link" style="cursor: pointer;"><span class="d-none d-sm-block">Item List</span></a></li>
                    <li class="nav-item"><a class="nav-link" style="cursor: pointer;"><span class="d-none d-sm-block">Item Group</span></a></li>
                    <li class="nav-item"><a class="nav-link" style="cursor: pointer;"><span class="d-none d-sm-block">Assets Group</span></a></li>
                    <li class="nav-item"><a class="nav-link" style="cursor: pointer;"><span class="d-none d-sm-block">Category 1</span></a></li>
                    <li class="nav-item"><a class="nav-link" style="cursor: pointer;"><span class="d-none d-sm-block">Category 2</span></a></li>
                    <li class="nav-item"><a class="nav-link" style="cursor: pointer;"><span class="d-none d-sm-block">Category 3</span></a></li>
                    <li class="nav-item"><a class="nav-link" style="cursor: pointer;"><span class="d-none d-sm-block">Category 4</span></a></li>
                    <li class="nav-item"><a class="nav-link" style="cursor: pointer;"><span class="d-none d-sm-block">Category 5</span></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active">
                        <item-list ></item-list> 
                    </div>
                    <div class="tab-pane p-3">
                        <item-group></item-group> 
                    </div>
                    <div class="tab-pane p-3">
                        <asset-group></asset-group> 
                    </div>
                    <div class="tab-pane p-3">
                        <category-1></category-1> 
                    </div>
                    <div class="tab-pane p-3">
                        <category-2></category-2> 
                    </div>
                    <div class="tab-pane p-3">
                        <category-3></category-3>
                    </div>
                    <div class="tab-pane p-3">
                        <category-4></category-4>
                    </div>
                    <div class="tab-pane p-3">
                        <category-5></category-5>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</template>

<script>
import ItemList from './item-list'
import ItemGroup from './item-group'
import ItemAssetGroup from './item-asset-group'
import ItemCategory1 from './item-category-1'
import ItemCategory2 from './item-category-2'
import ItemCategory3 from './item-category-3'
import ItemCategory4 from './item-category-4'
import ItemCategory5 from './item-category-5'

export default {
    components: {
        'item-list': ItemList,
        'asset-group': ItemAssetGroup,
        'item-group': ItemGroup,
        'category-1': ItemCategory1,
        'category-2': ItemCategory2,
        'category-3': ItemCategory3,
        'category-4': ItemCategory4,
        'category-5': ItemCategory5
    }
}
</script>
