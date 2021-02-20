<template>
    <div>
        <div class="hx-tab">

            <ul class="nav nav-tabs">    
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#sale-orders">Sales Orders</a>    
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#reason-code">Reason Code</a>    
                </li>     
            </ul>

            <div class="tab-content">    
                <div class="tab-pane active" id="sale-orders">        
                </div>
                <div class="tab-pane" id="reason-code">        
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
