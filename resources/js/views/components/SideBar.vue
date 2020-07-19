<template>
    <!-- sidebar @s -->
    <div class="nk-sidebar nk-sidebar-fat nk-sidebar-fixed" data-content="sidebarMenu">
        <div class="nk-sidebar-element nk-sidebar-head">
            <div class="nk-sidebar-brand">
               <a href="html/general/index.html" class="logo-link nk-sidebar-logo">
                    <img class="logo logo-img logo-img-lg" :src="logo"  alt="logo">
                    <img class="logo-dark logo-img logo-img-lg" :src="logo"  alt="logo-dark">
                    <span class="nio-version">SYSTEM</span>
                </a>
            </div>
            <div class="nk-menu-trigger mr-n2">
                <a href="#" class="nk-nav-toggle nk-quick-nav-icon d-xl-none" data-target="sidebarMenu"><em class="icon ni ni-arrow-left"></em></a>
            </div>
        </div><!-- .nk-sidebar-element -->
        <div class="nk-sidebar-element">
            <div class="nk-sidebar-body" data-simplebar>
                <div class="nk-sidebar-content">
                    <div class="nk-sidebar-menu">
                        <!-- Menu -->
                        <ul class="nk-menu">

                            <li class="nk-menu-heading">
                                <h6 class="overline-title">Menu</h6>
                            </li>
                
                            <li class="nk-menu-item has-sub">
                                <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-db-fill"></em></span>
                                    <span class="nk-menu-text">Masterdata</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-text">Item</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Item Details</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Item Group</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Asset Group</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Category 1</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Category 2</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Category 3</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Category 4</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Category 5</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Unit of Measure</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>

                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-text">Supplier</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" @click="link('supplier')" class="nk-menu-link">
                                                    <span class="nk-menu-text">Supplier Details</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Discount</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Supplier Group</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-text">Customer</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Customer Details</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Discount</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Customer Group</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Chain</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Channel</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Customer Type</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-text">Employee</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Employee Details</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Employment Type</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Witholding Tax Table</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">SSS Table</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">PHIC Table</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">HDMF Table</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-text">Project</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Project Details</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Scope of Work</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <!-- <li class="nk-menu-item">
                                        <a href="javascript:void(0);" @click="link('locations')" class="nk-menu-link">
                                            <span class="nk-menu-text">LOCATIONS</span>
                                        </a>
                                    </li> -->
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                            <span class="nk-menu-text">Company</span>
                                        </a>
                                        <ul class="nk-menu-sub">
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Company Details</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Branch</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Location</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Address</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Chart of Account</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Cost Centers</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Taxation Table</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">Payment Terms</span>
                                                </a>
                                            </li>
                                            <li class="nk-menu-item has-sub">
                                                <a href="javascript:void(0);" class="nk-menu-link">
                                                    <span class="nk-menu-text">System Users</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>

                            
                            <li class="nk-menu-item has-sub">
                                <a href="javascript:void(0);"  class="nk-menu-link  nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-money"></em></span>
                                    <span class="nk-menu-text">Buy and Pay</span>
                                </a>
                                <ul class="nk-menu-sub">
                                     <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Ordering</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Receiving</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Returns</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Billing</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Payment</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                        
                            <li class="nk-menu-item has-sub">
                                <a href="javascript:void(0);"  class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-coins"></em></span>
                                    <span class="nk-menu-text">Sell and Collect</span>
                                </a>
                                <ul class="nk-menu-sub">
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Ordering</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Fulfillment</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Invoicing</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Reversal</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Collection</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nk-menu-item has-sub">
                                <a href="javascript:void(0);"  class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-report-profit"></em></span>
                                    <span class="nk-menu-text">Stock</span>
                                </a>
                                <ul class="nk-menu-sub">
                                     <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Stock Entry</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Price Rule</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

                            <li class="nk-menu-item has-sub">
                                <a href="javascript:void(0);"  class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-report-profit"></em></span>
                                    <span class="nk-menu-text">Accounting</span>
                                </a>
                                <ul class="nk-menu-sub">
                                     <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Reconcile Bank</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Reconcile Cash Fund</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Maintain Fixed Asset</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Make Payroll</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Make Adjustment</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>


                            <li class="nk-menu-item has-sub">
                                <a href="javascript:void(0);" class="nk-menu-link nk-menu-toggle">
                                    <span class="nk-menu-icon"><em class="icon ni ni-reports"></em></span>
                                    <span class="nk-menu-text">Financial Report</span>
                                </a>
                                <ul class="nk-menu-sub">
                                     <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Bank Reconciliation</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Funds Reconciliation</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Lapsing Schedule</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Payroll Summary</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Journal and Ledger</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Profit &amp; Loss</span>
                                        </a>
                                    </li>
                                    <li class="nk-menu-item">
                                        <a href="javascript:void(0);" class="nk-menu-link">
                                            <span class="nk-menu-text">Balance Sheet</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>

<!-- 
                            <li class="nk-menu-heading">
                                <h6 class="overline-title">Settings</h6>
                            </li>

                            <li class="nk-menu-item">
                                <a @click="link('users')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-user-c"></em></span>
                                    <span class="nk-menu-text">USERS</span>
                                </a>
                            </li>
                            <li class="nk-menu-item">
                                <a href="javascript:void(0);" @click="link('companies')" class="nk-menu-link">
                                    <span class="nk-menu-icon"><em class="icon ni ni-building"></em></span>
                                    <span class="nk-menu-text">COMPANIES</span>
                                </a>
                            </li> -->
                        
                        </ul><!-- .nk-menu -->     
                    </div>
                </div><!-- .nk-sidebar-contnet -->
            </div><!-- .nk-sidebar-body -->
        </div><!-- .nk-sidebar-element -->
    </div>
    <!-- sidebar @e -->
</template>

<script>
    import logo from '../../assets/themes/images/hexa-logo.png';
    
    export default {
    name: 'SideBar',
    props: ['properties'],
    data: function () {
        return {
            logo
        }
    },
    components: {
    
    },
    methods: {
        link: function (name) {
           var scope = this
           scope.$router.push({name: name})
        },
    },
    mounted() {
        var scope = this
    }
}
</script>

<style scoped>
.nk-menu {
      max-height: calc(100vh - 9rem);
      overflow-y: auto;
 }

</style>