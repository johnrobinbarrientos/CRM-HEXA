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
                    <a class="nav-link" data-toggle="tab" href="#debit-memo" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Debit Memo</span>    
                    </a> 
                </li> 
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#billing-list" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Bill</span>    
                    </a> 
                </li> 
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="billing-list" role="tabpanel">        
                    <billing-list></billing-list>   
                </div>
                <div class="tab-pane" id="debit-memo" role="tabpanel">        

                </div>
                <div class="tab-pane" id="reason-code" role="tabpanel">        
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div id="accordion">
                                    <div class="card shadow-none">
                                        <a href="#collapseOne" class="text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="m-0">Billing</h5>
                                                <i class="las la-plus-circle fs-30"></i>
                                            </div>
                                        </a>
                                    
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <reason-codes-billing></reason-codes-billing>
                                                </div>
                                            </div>            
                                        </div>
                                    </div>
                                    <div class="card shadow-none">
                                        <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="m-0">Debit Memo</h5>
                                                <i class="las la-plus-circle fs-30"></i>
                                            </div>
                                        </a>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <reason-codes-debit-memo></reason-codes-debit-memo>
                                                </div>
                                           </div>         
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>            
                    
                </div> 
            </div>
        </div>
    </div>
</template>

<script>
import BillingList from './billing/list'
import ReasonCodesBilling from './billing/reason-codes'
import ReasonCodesDebitMemo from './debit-memo/reason-codes'

export default {
    components: {
        'billing-list': BillingList,
        'reason-codes-billing': ReasonCodesBilling,
        'reason-codes-debit-memo': ReasonCodesDebitMemo
    }
}
</script>
