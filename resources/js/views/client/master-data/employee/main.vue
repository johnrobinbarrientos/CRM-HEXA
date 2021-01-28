<template>
    <div class="hx-tab">
        <ul class="nav nav-tabs">    
            <li class="nav-item">        
                <a class="nav-link active" data-toggle="tab" href="#employee-list">Employee List</a>    
            </li>    
            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#employee-system-user-list">System Users</a>    
            </li>   
            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#employment-type">Employment Type</a>    
            </li>
            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#employment-status">Employment Status</a>    
            </li> 
        </ul>

        <div class="tab-content">    
            <div class="tab-pane active" id="employee-list">        
                <list></list>   
            </div>    
            <div class="tab-pane" id="employee-system-user-list">        
                <system-user-list></system-user-list>   
            </div>    
            <div class="tab-pane" id="employment-type">        
                <employment-type></employment-type>    
            </div>
            <div class="tab-pane" id="employment-status">        
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
