<template>
    <div>
        <div class="hx-tab-1 round">
            <ul class="nav nav-tabs" role="tablist">    
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#project-list" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Project</span>    
                    </a>     
                </li>  
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="project-list" role="tabpanel">        
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
