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
                    
                    <div id="accordion">
                        <div class="card shadow-none">
                            <a href="#collapseOne" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                <div class="card-header" id="headingOne">
                                    <h5 class="m-0">Billing</h5>
                                    <i class="las la-plus-circle fs-30"></i>
                                </div>
                            </a>
                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <reason-codes-billing></reason-codes-billing>
                            </div>
                            
                            <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                <div class="card-header" id="headingTwo">
                                    <h5 class="m-0">Debit Memo</h5>
                                    <i class="las la-plus-circle fs-30"></i>
                                </div>
                            </a>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                <reason-codes-debit-memo></reason-codes-debit-memo>
                            </div>
                        </div>
                    </div>
                    
                </div> 
            </div>
        </div>
    </div>
</template>

<script>
import BillingList from './list'
import ReasonCodesBilling from './reason-codes-billing'
import ReasonCodesDebitMemo from './reason-codes-debit-memo'

export default {
    components: {
        'billing-list': BillingList,
        'reason-codes-billing': ReasonCodesBilling,
        'reason-codes-debit-memo': ReasonCodesDebitMemo
    }
}
</script>
