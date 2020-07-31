<template>
    <div>
        <div style="margin-top: 60px;"></div>
        
        <div class="nk-content nk-content-fluid">  <!-- nk-content-fluid -->         
            <div class="container-fluid">
                <div class="nk-content-body">

                    <ul class="nav nav-tabs">    
                        <li class="nav-item">        
                            <a class="nav-link active" data-toggle="tab" href="#item-list">Items List</a>    
                        </li>    
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#item-group">Item Group</a>    
                        </li>    
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#asset-group">Asset Group</a>    
                            </li>    
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#category1">Category 1</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#category2">Category 2</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#category3">Category 3</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#category4">Category 4</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#category5">Category 5</a>    
                        </li>
                    </ul>
                    <div class="tab-content">    
                        <div class="tab-pane active" id="item-list">        
                            <item-list ></item-list>   
                        </div>    
                        <div class="tab-pane" id="item-group">        
                            <item-group></item-group>    
                        </div>    
                        <div class="tab-pane" id="asset-group">        
                            <asset-group></asset-group>     
                        </div>    
                        <div class="tab-pane" id="category1">        
                            <category-1></category-1>     
                        </div>
                        <div class="tab-pane" id="category2">        
                            <category-2></category-2>    
                        </div>
                        <div class="tab-pane" id="category3">        
                            <category-3></category-3>     
                        </div>
                        <div class="tab-pane" id="category4">        
                            <category-4></category-4>     
                        </div>
                        <div class="tab-pane" id="category5">        
                            <category-5></category-5>     
                        </div>
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
