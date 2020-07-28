<template>
    <div>
        <div style="margin-bottom:40px;" class="nk-fmg-body-head d-none d-lg-flex">
        </div>
        
        <div class="nk-content nk-content-fluid">          
            <div class="container-fluid">
                <div class="nk-content-body">

                    <ul class="nav nav-tabs">    
                        <li class="nav-item">        
                            <a class="nav-link active" data-toggle="tab" href="#company-details">Company Details</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#company-branch">Branch</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#company-branch-locations">Locations</a>    
                        </li>   
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#chart-of-accounts">Chart Of Accounts</a>    
                        </li>   
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#account-group">Account Group</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#report-group">Report Group</a>    
                        </li>
                        <li class="nav-item">        
                            <a class="nav-link" data-toggle="tab" href="#cost-center">Cost Centers</a>    
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
                    </ul>

                    <div class="tab-content">    
                        <div class="tab-pane active" id="company-details">        
                            <!-- <company-details></company-details>    -->
                        </div>    
                        <div class="tab-pane" id="company-branch">        
                            <company-branch></company-branch>    
                        </div>
                        <div class="tab-pane" id="company-branch-locations">        
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
                        <div class="tab-pane" id="cost-center">        
                            <company-cost-center></company-cost-center>    
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
import CompanyCostCenter from './company-cost-center'
import CompanyPaymentTerms from './company-payment-terms'
import CompanyTaxation from './company-taxation'

export default {
    components: {
        'company-details': CompanyDetails,
        'company-branch': CompanyBranch,
        'company-branch-location': CompanyBranchLocation,
        'company-coa': CompanyChartOfAccounts,
        'company-coa-account-group': CompanyAccountGroup,
        'company-coa-report-group': CompanyReportGroup,
        'company-cost-center': CompanyCostCenter,
        'company-payment-terms': CompanyPaymentTerms,
        'company-taxation': CompanyTaxation
    }
}
</script>
