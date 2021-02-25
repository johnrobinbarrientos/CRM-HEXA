<template>
    <div>
        <div class="hx-tab-1 round">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#global-uom" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Global UOM</span>    
                    </a>  
                </li>
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
                    <a class="nav-link" data-toggle="tab" href="#cost-center" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Cost Center</span>    
                    </a> 
                </li>
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#address-list" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Address List</span>    
                    </a>   
                </li>
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="address-list" role="tabpanel">        
                    <address-list></address-list>   
                </div>
                <div class="tab-pane" id="cost-center" role="tabpanel">        
                    <cost-center></cost-center>    
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
                <div class="tab-pane" id="global-uom" role="tabpanel">        
                    <global-uom></global-uom>    
                </div> 
            </div>

        </div>     
    </div>
</template>

<script>
import AddressList from './address-list'
import CostCenter from './cost-center'
import CustomerChain from './customer-chain'
import CustomerChannel from './customer-channel'
import CustomerType from './customer-type'
import GlobalUOM from './global-uom'


export default {
    name: 'globals-main',
    data: function () {
        return {

        }
    },
    components: {
        'address-list': AddressList,
        'cost-center': CostCenter,
        'customer-chain': CustomerChain,
        'customer-channel': CustomerChannel,
        'customer-type': CustomerType,
        'global-uom': GlobalUOM,
    },

    mounted() {
    var scope = this

    },
}
</script>
