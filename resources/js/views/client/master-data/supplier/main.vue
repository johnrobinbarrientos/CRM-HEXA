<template>
    <div>
        <div class="hx-tab-1 round">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">    
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#supplier-group" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Supplier Group</span>    
                    </a>   
                </li>
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#supplier-list" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Supplier</span>    
                    </a>  
                </li>   
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="supplier-list" role="tabpanel">        
                    <list></list>   
                </div>    
                <div class="tab-pane" id="supplier-group" role="tabpanel">        
                    <group></group>    
                </div>    
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
    },
    methods: {

    }
}
</script>
