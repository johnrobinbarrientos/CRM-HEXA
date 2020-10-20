<template>
    <div>
        <div v-show="show_preloader">
            <Spinner />
        </div>

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
                        <company-details></company-details>   
                    </div>
                    <div class="tab-pane" id="department">        
                        <company-department></company-department>    
                    </div>
                    <div class="tab-pane" id="company-branch">        
                        <company-branch></company-branch>    
                    </div>
                    <div class="tab-pane" id="company-locations">        
                        <company-branch-location></company-branch-location>    
                    </div> 
                    <div class="tab-pane" id="chart-of-accounts">        
                        <company-coa></company-coa>    
                    </div> 
                    <div class="tab-pane" id="account-group">        
                        <company-coa-account-group></company-coa-account-group>    
                    </div> 
                    <div class="tab-pane" id="report-group">        
                        <company-coa-report-group></company-coa-report-group>    
                    </div>
                    <div class="tab-pane" id="payment-terms">        
                        <company-payment-terms></company-payment-terms>    
                    </div> 
                    <div class="tab-pane" id="taxation-table">        
                        <company-taxation></company-taxation>    
                    </div> 
                    <div class="tab-pane" id="system-users">
                        <!-- <employment-type></employment-type>     -->          
                    </div>    
                    <div class="tab-pane" id="accounting-period">
                        <company-accounting-period></company-accounting-period>              
                    </div>
                </div>

            </div>
        </div>       
    </div>
</template>

<script>
import CompanyDetails from './company-details'
import CompanyBranch from './company-branch'
import CompanyBranchLocation from './company-branch-location'
import CompanyChartOfAccounts from './company-coa'
import CompanyAccountGroup from './company-coa-account-group'
import CompanyReportGroup from './company-coa-report-group'
import CompanyPaymentTerms from './company-payment-terms'
import CompanyTaxation from './company-taxation'
import CompanyDepartment from './company-department'
import AccountingPeriod from './company-accounting-period'


export default {
    data: function () {
        return {
            show_preloader: true
        }
    },
    components: {
        'company-details': CompanyDetails,
        'company-branch': CompanyBranch,
        'company-branch-location': CompanyBranchLocation,
        'company-coa': CompanyChartOfAccounts,
        'company-coa-account-group': CompanyAccountGroup,
        'company-coa-report-group': CompanyReportGroup,
        'company-payment-terms': CompanyPaymentTerms,
        'company-taxation': CompanyTaxation,
        'company-department': CompanyDepartment,
        'company-accounting-period': AccountingPeriod

    },
        mounted() {
        var scope = this

        setTimeout(function(){ scope.show_preloader = false },2000)
    },
}
</script>
