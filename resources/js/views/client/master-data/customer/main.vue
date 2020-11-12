<template>
    <div class="hx-tab">
        <ul class="nav nav-tabs">    
            <li class="nav-item">        
                <a class="nav-link active" data-toggle="tab" href="#customer-list">Customer List</a>    
            </li>    
            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#customer-group">Customer Group</a>    
            </li>   
        </ul>

        <div class="tab-content">    
            <div class="tab-pane active" id="customer-list">        
                <customer-list></customer-list>   
            </div>    
            <div class="tab-pane" id="customer-group">        
                <customer-group></customer-group>    
            </div>   
        </div>   
    </div>
</template>

<script>
import List from './list'
import Group from './group'

export default {
    components: {
        'list': List,
        'group': Group
    }
}
</script>
