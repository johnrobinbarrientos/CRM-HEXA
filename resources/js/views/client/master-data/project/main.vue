<template>
    <div class="hx-tab">
        <ul class="nav nav-tabs">    
            <li class="nav-item">        
                <a class="nav-link active" data-toggle="tab" href="#project-list">Project List</a>    
            </li>    
        </ul>

        <div class="tab-content">    
            <div class="tab-pane active" id="project-list">        
                <list></list>   
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
