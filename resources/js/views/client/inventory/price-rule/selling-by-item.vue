<template>
    <div>
        <div id="accordion">
            <div class="card shadow-none">
                <a href="#collapseFive" class="text-dark collapsed" data-toggle="collapse" aria-expanded="false" aria-controls="collapseFive">
                    <div class="card-header" id="headingOne">
                        <h5 class="m-0">By Items</h5>
                        <i class="las la-plus-circle fs-30"></i>
                    </div>
                </a>
                <div id="collapseFive" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                    
                     Item Details

                </div>
            </div>
        </div>
    </div>
</template>


<script>
export default {

}
</script>