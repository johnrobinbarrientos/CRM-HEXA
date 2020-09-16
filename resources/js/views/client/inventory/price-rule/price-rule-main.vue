<template>
    <div>
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs">    
                    <li class="nav-item">        
                        <a class="nav-link active" data-toggle="tab" href="#price-rule-supplier">Supplier</a>    
                    </li>    
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#price-rule-customer">Customer</a>    
                    </li>    
                </ul>

                <div class="tab-content p-3">    
                    <div class="tab-pane active" id="price-rule-supplier">        
                        <price-rule-supplier></price-rule-supplier>   
                    </div>    
                    <div class="tab-pane" id="price-rule-customer">        
                        <price-rule-customer></price-rule-customer>    
                    </div>    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PriceRuleSupplier from './price-rule-supplier'
import PriceRuleCustomer from './price-rule-customer'

export default {
    components: {
        'price-rule-supplier': PriceRuleSupplier,
        'price-rule-customer': PriceRuleCustomer
    }
}
</script>
