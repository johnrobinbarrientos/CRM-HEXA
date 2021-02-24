<template>
    <div>
        <div class="hx-tab-1 round">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">    
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#purchase-reason-code" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Reason Code</span>    
                    </a>     
                </li>
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#purchase-list" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Purchase Order</span>    
                    </a>   
                </li>  
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="purchase-list" role="tabpanel">        
                    <list></list>   
                </div>    
                <div class="tab-pane" id="purchase-reason-code" role="tabpanel">        
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
