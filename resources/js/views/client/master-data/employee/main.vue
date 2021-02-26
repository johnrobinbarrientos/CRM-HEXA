<template>
    <div class="hx-tab-1 round">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">    

            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#employment-status" role="tab">
                    <span class="d-block d-sm-none"></span>
                    <span class="d-none d-sm-block">Employment Status</span>    
                </a>   
            </li>
            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#employment-type" role="tab">
                    <span class="d-block d-sm-none"></span>
                    <span class="d-none d-sm-block">Employment Type</span>    
                </a>
            </li>
            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#employee-system-user-list" role="tab">
                    <span class="d-block d-sm-none"></span>
                    <span class="d-none d-sm-block">System User</span>    
                </a>
            </li>
            
            <li class="nav-item">        
                <a class="nav-link active" data-toggle="tab" href="#employee-list" role="tab">
                    <span class="d-block d-sm-none"></span>
                    <span class="d-none d-sm-block">Employee</span>    
                </a>
            </li> 
        </ul>

        <div class="clearfix"></div>
            <!-- Tab panes -->

        <div class="tab-content">    
            <div class="tab-pane active" id="employee-list" role="tabpanel">        
                <list></list>   
            </div>    
            <div class="tab-pane" id="employee-system-user-list" role="tabpanel">        
                <system-user-list></system-user-list>   
            </div>    
            <div class="tab-pane" id="employment-type" role="tabpanel">        
                <employment-type></employment-type>    
            </div>
            <div class="tab-pane" id="employment-status" role="tabpanel">        
                <employment-status></employment-status> 
            </div> 
        </div>
    </div>
</template>

<script>
import List from './list'
import SystemUserList from './system-user-list'
import EmploymentType from './employment-type'
import EmploymentStatus from './employment-status'


export default {
    components: {
        'list': List,
        'system-user-list': SystemUserList,
        'employment-type': EmploymentType,
        'employment-status': EmploymentStatus
    }
}
</script>
