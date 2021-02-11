<template>
    <div>
        <div id="accordion">
            <div class="card shadow-none">
                <a href="#collapseFour" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFour">
                    <div class="card-header" id="headingOne">
                        <h5 class="m-0">By Customer</h5>
                        <i class="las la-plus-circle fs-30"></i>
                    </div>
                </a>
                <div id="collapseFour" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    
                     Customer Details

                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {

}
</script>