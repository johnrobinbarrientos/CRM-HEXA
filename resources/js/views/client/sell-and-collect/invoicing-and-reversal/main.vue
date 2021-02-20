<template>
    <div>
        <div class="hx-tab">

            <ul class="nav nav-tabs">    
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#invoicing">Invoicing</a>    
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#credit-memo">Credit Memo</a>    
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#reason-code">Reason Code</a>    
                </li>     
            </ul>

            <div class="tab-content">    
                <div class="tab-pane active" id="invoicing">        
                </div>
                <div class="tab-pane" id="credit-memo">        
                </div>
                <div class="tab-pane" id="reason-code">        
                    
                     <div id="accordion">
                        <div class="card shadow-none">
                            <a href="#collapseOne" class="text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                <div class="card-header" id="headingOne">
                                    <h5 class="m-0">Invoicing</h5>
                                    <i class="las la-plus-circle fs-30"></i>
                                </div>
                            </a>
                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                <reason-codes-invoicing></reason-codes-invoicing>
                            </div>
                            
                            <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="m-0">Credit Memo</h5>
                                    <i class="las la-plus-circle fs-30"></i>
                                </div>
                            </a>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <reason-codes-credit-memo></reason-codes-credit-memo>
                            </div>
                        </div>
                    </div>
                    
                </div> 
            </div>
        </div>
    </div>
</template>

<script>

import InvoicingReasonCodes from './invoicing/reason-codes'
import CreditMemoReasonCodes from './credit-memo/reason-codes'

export default {
    components: {
        'reason-codes-invoicing': InvoicingReasonCodes,
        'reason-codes-credit-memo': CreditMemoReasonCodes
    }
}
</script>
