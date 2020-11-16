<template>
    <div>
        <div class="hx-tab">

            <ul class="nav nav-tabs">    
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#billing-list">Bill</a>    
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#debit-memo">Debit Memo</a>    
                </li> 
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#reason-code">Reason Code</a>    
                </li>     
            </ul>

            <div class="tab-content">    
                <div class="tab-pane active" id="billing-list">        
                    <billing-list></billing-list>   
                </div>
                <div class="tab-pane active" id="debit-memo">        

                </div>
                <div class="tab-pane active" id="reason-code">        
  
                </div> 
            </div>
        </div>
    </div>
</template>

<script>
import BillingList from './billing-list'

export default {
    components: {
        'billing-list': BillingList
    }
}
</script>
