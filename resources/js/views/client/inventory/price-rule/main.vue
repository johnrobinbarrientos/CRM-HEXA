<template>
    <div>
        <div class="card">
            <div class="card-body">

                <ul class="nav nav-tabs">    
                    <li class="nav-item">        
                        <a class="nav-link active" data-toggle="tab" href="#price-rule">Price Rule</a>    
                    </li>       
                </ul>

                <div class="tab-content p-3">    
                    <div class="tab-pane active" id="price-rule">        
                        <list></list>   
                    </div>      
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import List from './list'

export default {
    components: {
        'list': List
    }
}
</script>
