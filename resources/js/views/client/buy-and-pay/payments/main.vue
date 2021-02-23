<template>
    <div>
        <div class="hx-tab">

            <ul class="nav nav-tabs">    
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#item-receipts">Payments</a>    
                </li>       
            </ul>

            <div class="tab-content">    
                <div class="tab-pane active" id="item-receipts">        
                    <list></list>   
                </div>  
            </div>
        </div>
    </div>
</template>

<script>
import PaymentList from './list'

export default {
    components: {
        'list': PaymentList
    }
}
</script>
