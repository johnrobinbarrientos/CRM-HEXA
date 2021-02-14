<template>
    <div>
        <div class="card">
            <div class="card-body">                    

                <ul class="nav nav-tabs">    
                    <li class="nav-item">        
                        <a class="nav-link active" data-toggle="tab" href="#company-list">Company List</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#chart-of-accounts">Chart of Accounts</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#account-groups">Account Groups</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#report-groups">Report Groups</a>    
                    </li>   
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#cost-center">Cost Center</a>    
                    </li>      
                </ul>

                <div class="tab-content">    
                    <div class="tab-pane active" id="company-list">        
                        <company-list></company-list>   
                    </div>
                    <div class="tab-pane" id="chart-of-accounts">        
                        <admin-chart-of-accounts></admin-chart-of-accounts>    
                    </div>
                    <div class="tab-pane" id="account-groups">        
                        <admin-coa-account-group></admin-coa-account-group>    
                    </div>
                    <div class="tab-pane" id="report-groups">        
                        <admin-coa-report-group></admin-coa-report-group>    
                    </div> 
                    <div class="tab-pane" id="cost-center">        
                        <admin-cost-center></admin-cost-center>    
                    </div> 
                </div>

            </div>
        </div>       
    </div>
</template>

<script>
import CompanyList from './company-list'
import ChartOfAccounts from './admin-chart-of-accounts'
import AccountGroups from './admin-coa-account-group'
import ReportGroups from './admin-coa-report-group'
import CostCenter from './admin-cost-center'


export default {
    name: 'super-admin-main',
    data: function () {
        return {

        }
    },
    components: {
        'company-list': CompanyList,
        'admin-chart-of-accounts': ChartOfAccounts,
        'admin-coa-account-group': AccountGroups,
        'admin-coa-report-group': ReportGroups,
        'admin-cost-center': CostCenter,
    },

    mounted() {
    var scope = this

    },
}
</script>
