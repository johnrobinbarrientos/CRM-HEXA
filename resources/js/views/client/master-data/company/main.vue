<template>
    <div>

        <div class="card">
            <div class="card-body">                    

                <ul class="nav nav-tabs">    
                    <li class="nav-item">        
                        <a class="nav-link active" data-toggle="tab" href="#company-details">Company Details</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#department">Departments</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#company-branch">Branches</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#company-locations">Locations</a>    
                    </li>   
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#chart-of-accounts">Chart Of Accounts</a>    
                    </li>   
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#account-group">Account Groups</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#report-group">Report Groups</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#payment-terms">Payment Terms</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#taxation-table">Taxation Table</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#system-users">System Users</a>    
                    </li>
                    <li class="nav-item">        
                        <a class="nav-link" data-toggle="tab" href="#accounting-period">Accounting Period</a>    
                    </li>      
                </ul>

                <div class="tab-content">    
                    <div class="tab-pane active" id="company-details">        
                        <details></details>   
                    </div>
                    <div class="tab-pane" id="department">        
                        <department></department>    
                    </div>
                    <div class="tab-pane" id="company-branch">        
                        <branch></branch>    
                    </div>
                    <div class="tab-pane" id="company-locations">        
                        <branch-location></branch-location>    
                    </div> 
                    <div class="tab-pane" id="chart-of-accounts">        
                        <coa></coa>    
                    </div> 
                    <div class="tab-pane" id="account-group">        
                        <coa-account-group></coa-account-group>    
                    </div> 
                    <div class="tab-pane" id="report-group">        
                        <coa-report-group></coa-report-group>    
                    </div>
                    <div class="tab-pane" id="payment-terms">        
                        <payment-terms></payment-terms>    
                    </div> 
                    <div class="tab-pane" id="taxation-table">        
                        <taxation></taxation>    
                    </div> 
                    <div class="tab-pane" id="system-users">
                        <!-- <employment-type></employment-type>     -->          
                    </div>    
                    <div class="tab-pane" id="accounting-period">
                        <accounting-period></accounting-period>              
                    </div>
                </div>

            </div>
        </div>       
    </div>
</template>

<script>
import Details from './details'
import Branch from './branch'
import BranchLocation from './branch-location'
import ChartOfAccounts from './coa'
import AccountGroup from './coa-account-group'
import ReportGroup from './coa-report-group'
import PaymentTerms from './payment-terms'
import Taxation from './taxation'
import Department from './department'
import AccountingPeriod from './accounting-period'


export default {
    data: function () {
        return {

        }
    },
    components: {
        'details': Details,
        'branch': Branch,
        'branch-location': BranchLocation,
        'coa': ChartOfAccounts,
        'coa-account-group': AccountGroup,
        'coa-report-group': ReportGroup,
        'payment-terms': PaymentTerms,
        'taxation': Taxation,
        'department': Department,
        'accounting-period': AccountingPeriod

    },
        mounted() {
        var scope = this

    },
}
</script>
