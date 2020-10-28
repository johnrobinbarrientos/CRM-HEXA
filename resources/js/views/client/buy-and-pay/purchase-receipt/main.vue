<template>
    <div>
        <div class="hx-tab">

            <ul class="nav nav-tabs">    
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#list">Purchase Order</a>    
                </li>       
            </ul>

            <div class="tab-content">    
                <div class="tab-pane active" id="list">        
                    <list></list>   
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
