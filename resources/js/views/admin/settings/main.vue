<template>
    <div>
        <div class="hx-tab-1 round">                    
            <ul class="nav nav-tabs" role="tablist">    
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#cost-center" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Cost Center</span>    
                    </a> 
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#report-groups" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Report Groups</span>    
                    </a>  
                </li>  
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#account-groups" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Account Groups</span>    
                    </a>     
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#chart-of-accounts" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Chart of Accounts</span>    
                    </a>    
                </li>
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#company-list" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Company List</span>    
                    </a>    
                </li>    
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="company-list" role="tabpanel">        
                    <company-list></company-list>   
                </div>
                <div class="tab-pane" id="chart-of-accounts" role="tabpanel">        
                    <admin-chart-of-accounts></admin-chart-of-accounts>    
                </div>
                <div class="tab-pane" id="account-groups" role="tabpanel">        
                    <admin-coa-account-group></admin-coa-account-group>    
                </div>
                <div class="tab-pane" id="report-groups" role="tabpanel">        
                    <admin-coa-report-group></admin-coa-report-group>    
                </div> 
                <div class="tab-pane" id="cost-center" role="tabpanel">        
                    <admin-cost-center></admin-cost-center>    
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
