<template>
    <div>
        <div class="col-12">
            <div class="page-title-box d-flex align-items-center justify-content-between">
                <h4 class="mb-0 font-size-18">Dashboard</h4>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="overflow-hidden card">
                    <div class="bg-primary bg-soft">
                        <div class="row">
                            <div class="col-7">
                                <div class="text-primary p-3">
                                    <h5 class="text-primary">Welcome Back!</h5>
                                    <p>Elevating OME's. Empowering Entrepreneurs.</p>
                                </div>
                            </div>
                            <div class="align-self-end col-5">
                                <img src="/images/profile-img.43b59e59.png" alt class="img-fluid">
                            </div>
                        
                        </div>
                    </div>
                    <div class="pt-0 card-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="avatar-md profile-user-wid mb-4">
                                    <img class="img-thumbnail rounded-circle" src="/images/avatar-1.3921191a.jpg">
                                    <h5 style="white-space: nowrap;font-size: 15px!important">Cynthia Price</h5>
                                    <p style="white-space: nowrap;">Cashier</p>
                                </div>
                            </div>
                                <div class="col-sm-8">
                                    <div class="pt-4">
                                        <div class="row">

                                        </div>
                                        <div class="mt-4">
                                            <a class="btn btn-primary btn-sm" href="">
                                                View Profile
                                                <i class="mdi mdi-arrow-right ms-1"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="row">
                    <div class="col-md-3">
                        <div class="mini-stats-wid card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted fw-medium">Purchase Orders this month</p>
                                        <h4 class="mb-0">370</h4>
                                        <a :href="'/buy-and-pay/orders'" target="_blank">View</a>
                                    </div>
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mini-stats-wid card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted fw-medium">Received this month</p>
                                        <h4 class="mb-0">203</h4>
                                        <a :href="'/buy-and-pay/receipts'" target="_blank">View</a>
                                    </div>
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="bx bx-archive-in font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mini-stats-wid card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted fw-medium">Billed this month</p>
                                        <h4 class="mb-0">111</h4>
                                        <a :href="'/buy-and-pay/bills'" target="_blank">View</a>
                                    </div>
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="bx bx-purchase-tag-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="mini-stats-wid card">
                            <div class="card-body">
                                <div class="media">
                                    <div class="media-body">
                                        <p class="text-muted fw-medium">Paid this month</p>
                                        <h4 class="mb-0">268</h4>
                                        <a :href="'/buy-and-pay/payments'" target="_blank">View</a>
                                    </div>
                                    <div class="mini-stat-icon avatar-sm rounded-circle bg-primary align-self-center">
                                        <span class="avatar-title">
                                            <i class="bx bx-copy-alt font-size-24"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>
        </div>
    </div>
</template>

<style scoped>
.bg-primary.bg-soft {
    background-color: rgba(85,110,230,.25)!important;
}

.font-size-15 {
    font-size: 15px!important;
}
.text-truncate {
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
}

</style>