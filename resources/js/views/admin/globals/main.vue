<template>
    <div>
        <div class="card">
            <div class="card-body">                    

                <ul class="nav nav-tabs">    
                    <li class="nav-item">        
                        <a class="nav-link active" data-toggle="tab" href="#address-list">Address List</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#cost-center">Cost Center</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#customer-chain">Customer Chain</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#customer-channel">Customer Channel</a>    
                    </li>   
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#customer-type">Customer Type</a>    
                    </li>   
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#global-uom">Global UOM</a>    
                    </li>    
                </ul>

                <div class="tab-content">    
                    <div class="tab-pane active" id="address-list">        
                        <address-list></address-list>   
                    </div>
                    <div class="tab-pane" id="cost-center">        
                        <cost-center></cost-center>    
                    </div>
                    <div class="tab-pane" id="customer-chain">        
                        <customer-chain></customer-chain>    
                    </div>
                    <div class="tab-pane" id="customer-channel">        
                        <customer-channel></customer-channel>    
                    </div> 
                    <div class="tab-pane" id="customer-type">        
                        <customer-type></customer-type>    
                    </div> 
                    <div class="tab-pane" id="global-uom">        
                        <global-uom></global-uom>    
                    </div> 
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
