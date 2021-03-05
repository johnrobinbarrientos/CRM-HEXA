<template>
    <div>
        <div class="hx-tab-1 round">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#scope-of-work" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Scope of Work</span>    
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
                <div class="tab-pane" id="scope-of-work" role="tabpanel">        
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-6 col-12">
                                <div id="accordion">
                                    <div class="card shadow-none">
                                        <a href="#collapseOne" class="text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                            <div class="card-header" id="headingOne">
                                                <h5 class="m-0">Scope</h5>
                                                <i class="las la-plus-circle fs-30"></i>
                                            </div>
                                        </a>
                                    
                                        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                            <div class="card-body">
                                                <div class="container-fluid">
                                                    <scope-of-work-list></scope-of-work-list>
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
import List from './list'
import ProjectType from './project-type'
import ScopeOfWorkList from './scope-of-work-list'

export default {
    components: {
        'list': List,
        'project-type': ProjectType,
        'scope-of-work-list': ScopeOfWorkList

    }
}
</script>
