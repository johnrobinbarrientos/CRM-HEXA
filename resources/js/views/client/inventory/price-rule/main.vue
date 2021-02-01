<template>
    <div>
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs">    
                    <li class="nav-item">        
                        <a class="nav-link active" data-toggle="tab" href="#supplier-list">Supplier</a>    
                    </li>    
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#customer-list">Customer</a>    
                    </li>    
                </ul>

                <div class="tab-content p-3">    
                    <div class="tab-pane active" id="supplier-list">        
                        <supplier-list></supplier-list>   
                    </div>    
                    <div class="tab-pane" id="customer-list">        
                        <customer-list></customer-list>    
                    </div>    
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import SupplierList from './supplier-list'
import CustomerList from './customer-list'

export default {
    components: {
        'supplier-list': SupplierList,
        'customer-list': CustomerList
    }
}
</script>
