<template>
    <div>
        <div style="margin-top: 60px;"></div>
        
        <div class="nk-content nk-content-fluid">          
            <div class="container-fluid">
                <div class="nk-content-body">

                    <ul class="nav nav-tabs">    
                        <li class="nav-item">        
                            <a class="nav-link active" data-toggle="tab" href="#customer-list">Customer List</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#customer-discounts">Discounts</a>    
                        </li>     
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#customer-group">Customer Group</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#customer-type">Customer Type</a>    
                        </li> 
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#customer-chain">Chain</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#customer-channel">Channel</a>    
                        </li>     
                    </ul>

                    <div class="tab-content">    
                        <div class="tab-pane active" id="customer-list">        
                            <customer-list></customer-list>   
                        </div>    
                        <div class="tab-pane" id="customer-discounts">        
                            <customer-discounts></customer-discounts>    
                        </div>
                        <div class="tab-pane" id="customer-group">        
                            <customer-group></customer-group>    
                        </div>
                        <div class="tab-pane" id="customer-type">        
                            <customer-type></customer-type>    
                        </div>
                        <div class="tab-pane" id="customer-chain">        
                            <customer-chain></customer-chain>    
                        </div>
                        <div class="tab-pane" id="customer-channel">        
                            <customer-channel></customer-channel>    
                        </div>    
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
import CustomerList from './customer-list'
import CustomerType from './customer-type'
import CustomerGroup from './customer-group'
import CustomerChain from './customer-chain'
import CustomerChannel from './customer-channel'
import CustomerDiscounts from './customer-discounts'

export default {
    components: {
        'customer-list': CustomerList,
        'customer-type': CustomerType,
        'customer-group': CustomerGroup,
        'customer-chain': CustomerChain,
        'customer-channel': CustomerChannel,
        'customer-discounts': CustomerDiscounts
    }
}
</script>
