<template>
    <div class="hx-tab">
        <ul class="nav nav-tabs">    
            <li class="nav-item">        
                <a class="nav-link active" data-toggle="tab" href="#employee-list">Employee List</a>    
            </li>    
            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#employment-type">Employement Type</a>    
            </li>
            <li class="nav-item">        
                <a class="nav-link" data-toggle="tab" href="#employment-status">Employement Status</a>    
            </li> 
        </ul>

        <div class="tab-content">    
            <div class="tab-pane active" id="employee-list">        
                <employee-list></employee-list>   
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
import EmployeeList from './employee-list'
import EmploymentType from './employee-employment-type'
import EmploymentStatus from './employee-employment-status'

export default {
    components: {
        'employee-list': EmployeeList,
        'employment-type': EmploymentType,
        'employment-status': EmploymentStatus
    }
}
</script>
