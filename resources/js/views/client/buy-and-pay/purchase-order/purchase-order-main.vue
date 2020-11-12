<template>
    <div>
        <div class="hx-tab">

            <ul class="nav nav-tabs">    
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#purchase-list">Purchase Order</a>    
                </li>    
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#purchase-reason-code">Reason Code</a>    
                </li>    
            </ul>

            <div class="tab-content">    
                <div class="tab-pane active" id="purchase-list">        
                    <purchase-order-list></purchase-order-list>   
                </div>    
                <div class="tab-pane" id="purchase-reason-code">        
                    <reason-code></reason-code>    
                </div>    
            </div>
        </div>
    </div>
</template>

<script>
import PurchaseList from './purchase-order-list'
import ReasonCode from './purchase-order-reason-codes'

export default {
    components: {
        'purchase-order-list': PurchaseList,
        'reason-code': ReasonCode
    }
}
</script>
