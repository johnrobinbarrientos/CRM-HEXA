<template>
    <div>
        <div class="hx-tab-1 round">                   
            <ul class="nav nav-tabs" role="tablist">    
                
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#accounting-period" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Accounting Period</span> 
                    </a>      
                </li>

                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#system-users" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">System Users</span> 
                    </a>  
                </li>

                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#taxation-table" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Taxation Table</span> 
                    </a>  
                </li>

                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#payment-terms" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Payment Terms</span> 
                    </a>     
                </li>

                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#report-group" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Report Groups</span> 
                    </a>  
                </li>

                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#account-group">Account Groups</a>    
                </li>

                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#chart-of-accounts" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Chart Of Accounts</span> 
                    </a> 
                </li> 

                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#company-locations" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Locations</span> 
                    </a>    
                </li>

                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#company-branch" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Branches</span> 
                    </a> 
                </li>

                <li class="nav-item"> 
                    <a class="nav-link" data-toggle="tab" href="#department" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Departments</span> 
                    </a>  
                </li>

                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#company-details" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Company Details</span>    
                    </a> 
                </li>
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="company-details" role="tabpanel">        
                    <details></details>   
                </div>
                <div class="tab-pane" id="department" role="tabpanel">        
                    <department></department>    
                </div>
                <div class="tab-pane" id="company-branch" role="tabpanel">        
                    <branch></branch>    
                </div>
                <div class="tab-pane" id="company-locations" role="tabpanel">        
                    <branch-location></branch-location>    
                </div> 
                <div class="tab-pane" id="chart-of-accounts" role="tabpanel">        
                    <coa></coa>    
                </div> 
                <div class="tab-pane" id="account-group" role="tabpanel">        
                    <coa-account-group></coa-account-group>    
                </div> 
                <div class="tab-pane" id="report-group" role="tabpanel">        
                    <coa-report-group></coa-report-group>    
                </div>
                <div class="tab-pane" id="payment-terms" role="tabpanel">        
                    <payment-terms></payment-terms>    
                </div> 
                <div class="tab-pane" id="taxation-table" role="tabpanel">        
                    <taxation></taxation>    
                </div> 
                <div class="tab-pane" id="system-users" role="tabpanel">
                    <!-- <employment-type></employment-type>     -->          
                </div>    
                <div class="tab-pane" id="accounting-period" role="tabpanel">
                    <accounting-period></accounting-period>              
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
