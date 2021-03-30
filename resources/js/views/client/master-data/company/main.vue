<template>
    <div>
        <div class="hx-side-tab">                   
            <ul class="nav" role="tablist">
                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#company-details" role="tab">
                        <span>Company Detail</span>
                        <i class="fas fa-angle-right"></i>
                    </a> 
                </li>
                <li class="nav-item"> 
                    <a class="nav-link" data-toggle="tab" href="#department" role="tab">
                        <span>Department</span>
                        <i class="fas fa-angle-right"></i>
                    </a>  
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#company-branch" role="tab">
                        <span>Branch</span>
                        <i class="fas fa-angle-right"></i>
                    </a> 
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#company-locations" role="tab">
                        <span>Location</span>
                        <i class="fas fa-angle-right"></i>
                    </a>    
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#chart-of-accounts" role="tab">
                        <span>Chart Of Account</span>
                        <i class="fas fa-angle-right"></i>
                    </a> 
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#account-group">
                        <span>Account Group</span>
                        <i class="fas fa-angle-right"></i>
                    </a>
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#report-group" role="tab">
                        <span>Report Group</span>
                        <i class="fas fa-angle-right"></i>
                    </a>  
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#payment-terms" role="tab">
                        <span>Payment Term</span>
                        <i class="fas fa-angle-right"></i>
                    </a>     
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#taxation-table" role="tab">
                        <span>Tax Table</span>
                        <i class="fas fa-angle-right"></i>
                    </a>  
                </li>
                <li class="nav-item">        
                    <a class="nav-link" data-toggle="tab" href="#system-users" role="tab">
                        <span>System User</span>
                        <i class="fas fa-angle-right"></i>
                    </a>  
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#accounting-period" role="tab">
                        <span>Accounting Period</span>
                        <i class="fas fa-angle-right"></i>
                    </a>      
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#address-list" role="tab">
                        <span>Address List</span>
                        <i class="fas fa-angle-right"></i>
                    </a>      
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#cost-center" role="tab">
                        <span>Cost Center</span>
                        <i class="fas fa-angle-right"></i>
                    </a>      
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#uom" role="tab">
                        <span>UOM</span>
                        <i class="fas fa-angle-right"></i>
                    </a>      
                </li> 
            </ul>

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

                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div id="accordion">
                                <div class="card shadow-none">
                                    <a href="#collapseOne" class="text-dark" data-toggle="collapse" aria-expanded="false" aria-controls="collapseOne">
                                        <div class="card-header" id="headingOne">
                                            <h5 class="m-0">Supplier/Customer</h5>
                                            <i class="las la-plus-circle fs-30"></i>
                                        </div>
                                    </a>
                                
                                    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <taxation></taxation>
                                        </div>            
                                    </div>
                                </div>
                                <div class="card shadow-none">
                                    <a href="#collapseTwo" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseTwo">
                                        <div class="card-header" id="headingTwo">
                                            <h5 class="m-0">Item</h5>
                                            <i class="las la-plus-circle fs-30"></i>
                                        </div>
                                    </a>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                                        <div class="card-body">
                                            <taxation-item></taxation-item> 
                                        </div>         
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>  
                    <!-- <taxation></taxation>     -->
                </div> 
                <div class="tab-pane" id="system-users" role="tabpanel">
                    <!-- <employment-type></employment-type>     -->          
                </div>    
                <div class="tab-pane" id="accounting-period" role="tabpanel">
                    <accounting-period></accounting-period>              
                </div>
                <div class="tab-pane" id="address-list" role="tabpanel">
                    <address-list></address-list>              
                </div>
                <div class="tab-pane" id="cost-center" role="tabpanel">
                    <cost-center></cost-center>              
                </div>
                <div class="tab-pane" id="uom" role="tabpanel">
                    <uom></uom>              
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
import TaxationItem from './taxation-item'
import Department from './department'
import AccountingPeriod from './accounting-period'
import AddressList from './address-list'
import CostCenter from './cost-center'
import UOM from './uom'


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
        'taxation-item': TaxationItem,
        'department': Department,
        'accounting-period': AccountingPeriod,
        'address-list': AddressList,
        'cost-center': CostCenter,
        'uom': UOM,

    },
        mounted() {
        var scope = this

    },
}
</script>
