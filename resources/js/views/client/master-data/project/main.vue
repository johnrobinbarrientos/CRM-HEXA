<template>
    <div>
        <div class="hx-tab-1 round">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#project-scope" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Project Scope</span>    
                    </a>    
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#project-type" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Project Type</span>    
                    </a>    
                </li>
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
                <div class="tab-pane" id="project-type" role="tabpanel">        
                    <project-type></project-type>   
                </div>
                <div class="tab-pane" id="project-scope" role="tabpanel">        
                    <project-scope></project-scope>   
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import List from './list'
import ProjectType from './project-type'
import ProjectScope from './project-scope'

export default {
    components: {
        'list': List,
        'project-type': ProjectType,
        'project-scope': ProjectScope,
    }
}
</script>
