<template>
    <div class="hx-tab-1 round">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">

            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#customer-type" role="tab">
                    <span class="d-block d-sm-none"></span>
                    <span class="d-none d-sm-block">Customer Type</span>    
                </a>  
            </li>

            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#customer-channel" role="tab">
                    <span class="d-block d-sm-none"></span>
                    <span class="d-none d-sm-block">Customer Channel</span>    
                </a>  
            </li>

            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#customer-chain" role="tab">
                    <span class="d-block d-sm-none"></span>
                    <span class="d-none d-sm-block">Customer Chain</span>    
                </a>  
            </li>    
              
            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#customer-group" role="tab">
                    <span class="d-block d-sm-none"></span>
                    <span class="d-none d-sm-block">Customer Group</span>    
                </a>  
            </li>
            <li class="nav-item">        
                <a class="nav-link active" data-toggle="tab" href="#customer-list" role="tab">
                    <span class="d-block d-sm-none"></span>
                    <span class="d-none d-sm-block">Customer</span>    
                </a>  
            </li>  
        </ul>

        <div class="clearfix"></div>
            <!-- Tab panes -->

        <div class="tab-content">    
            <div class="tab-pane active" id="customer-list" role="tabpanel">        
                <list></list>   
            </div>    
            <div class="tab-pane" id="customer-group" role="tabpanel">        
                <group></group>    
            </div>   
            <div class="tab-pane" id="customer-chain" role="tabpanel">        
                <customer-chain></customer-chain>    
            </div> 
            <div class="tab-pane" id="customer-channel" role="tabpanel">        
                <customer-channel></customer-channel>    
            </div> 
            <div class="tab-pane" id="customer-type" role="tabpanel">        
                <customer-type></customer-type>    
            </div>
        </div>  
    </div>
</template>

<script>
import List from './list'
import Group from './group'
import CustomerChain from './customer-chain'
import CustomerChannel from './customer-channel'
import CustomerType from './customer-type'

export default {
    components: {
        'list': List,
        'group': Group,
        'customer-chain': CustomerChain,
        'customer-channel': CustomerChannel,
        'customer-type': CustomerType,
    }
}
</script>
