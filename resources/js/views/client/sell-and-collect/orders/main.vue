<template>
    <div>
        <div class="hx-tab-1 round">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">    
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#reason-code" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Reason Code</span>    
                    </a> 
                </li>
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#sale-orders" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Sales Orders</span>    
                    </a> 
                </li>
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="sale-orders" role="tabpanel"> 
      
                </div>
                <div class="tab-pane" id="reason-code" role="tabpanel">        
                     <reason-codes></reason-codes>
                    
                </div> 
            </div>
        </div>
    </div>
</template>

<script>

import ReasonCodes from './reason-codes'

export default {
    components: {
        'reason-codes': ReasonCodes
    }
}
</script>
