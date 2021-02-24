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
                    <a class="nav-link" data-toggle="tab" href="#credit-memo" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Credit Memo</span>    
                    </a>  
                </li>

                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#invoicing" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Invoicing</span>    
                    </a>      
                </li>    
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="invoicing" role="tabpanel">        
                </div>
                <div class="tab-pane" id="credit-memo" role="tabpanel">        
                </div>
                <div class="tab-pane" id="reason-code" role="tabpanel">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-12">   
                    
                                <div id="accordion">
                                    <div class="card shadow-none">
                                        <a href="#collapseOne" class="text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="m-0">Invoicing</h5>
                                                <i class="las la-plus-circle fs-30"></i>
                                            </div>
                                        </a>
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <reason-codes-invoicing></reason-codes-invoicing>
                                                </div>
                                            </div>        
                                        </div>
                                    </div>
                                    <div class="card shadow-none">
                                        <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                            <div class="card-header" id="headingTwo">
                                                <h5 class="m-0">Credit Memo</h5>
                                                <i class="las la-plus-circle fs-30"></i>
                                            </div>
                                        </a>
                                        <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <reason-codes-credit-memo></reason-codes-credit-memo>
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

import InvoicingReasonCodes from './invoicing/reason-codes'
import CreditMemoReasonCodes from './credit-memo/reason-codes'

export default {
    components: {
        'reason-codes-invoicing': InvoicingReasonCodes,
        'reason-codes-credit-memo': CreditMemoReasonCodes
    }
}
</script>
