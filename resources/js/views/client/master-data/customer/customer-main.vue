<template>
    <div>
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-tabs">    
                    <li class="nav-item">        
                        <a class="nav-link active" data-toggle="tab" href="#customer-list">Customer List</a>    
                    </li>    
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#customer-group">Customer Group</a>    
                    </li>   
                </ul>

                <div class="tab-content p-3">    
                    <div class="tab-pane active" id="customer-list">        
                        <customer-list></customer-list>   
                    </div>    
                    <div class="tab-pane" id="customer-group">        
                        <customer-group></customer-group>    
                    </div>   
                </div>
            </div>
        </div>     
    </div>
</template>

<script>
import CustomerList from './customer-list'
import CustomerGroup from './customer-group'

export default {
    components: {
        'customer-list': CustomerList,
        'customer-group': CustomerGroup
    }
}
</script>
