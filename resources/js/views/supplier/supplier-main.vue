<template>
    <div>
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
        </div>
        
        <div class="nk-content nk-content-fluid">          
            <div class="container-fluid">
                <div class="nk-content-body">

                    <ul class="nav nav-tabs">    
                        <li class="nav-item">        
                            <a class="nav-link active" data-toggle="tab" href="#supplier-list">Supplier List</a>    
                        </li>    
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#supplier-group">Supplier Group</a>    
                        </li>    
                    </ul>

                    <div class="tab-content">    
                        <div class="tab-pane active" id="supplier-list">        
                            <supplier-list></supplier-list>   
                        </div>    
                        <div class="tab-pane" id="supplier-group">        
                            <supplier-group></supplier-group>    
                        </div>    
                    </div>
                </div>
            </div>
        </div>        
    </div>
</template>

<script>
import SupplierList from './supplier-list'
import SupplierGroup from './supplier-group'

export default {
    components: {
        'supplier-list': SupplierList,
        'supplier-group': SupplierGroup
    }
}
</script>
