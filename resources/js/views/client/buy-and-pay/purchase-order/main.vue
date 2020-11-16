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
                    <list></list>   
                </div>    
                <div class="tab-pane" id="purchase-reason-code">        
                    <reason-codes></reason-codes>    
                </div>    
            </div>
        </div>
    </div>
</template>

<script>
import PurchaseList from './list'
import ReasonCodes from './reason-codes'

export default {
    components: {
        'list': PurchaseList,
        'reason-codes': ReasonCodes
    }
}
</script>
