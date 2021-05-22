<template>
    <div>
        <div class="hx-tab-1 round">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">    

                <li class="nav-item">        
                    <a class="nav-link active" data-toggle="tab" href="#progress-billing" role="tab">
                        <span class="d-block d-sm-none"></span>
                        <span class="d-none d-sm-block">Progress Billing</span>    
                    </a> 
                </li> 
            </ul>

            <div class="clearfix"></div>
            <!-- Tab panes -->

            <div class="tab-content">    
                <div class="tab-pane active" id="progress-billing" role="tabpanel">        
                    <progress-form></progress-form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import ProgressForm from './progress-billing/form'

export default {
    name: 'invoicing-type-list',
    props: ['properties'],
    data: function () {
        return {
        }
    },
    components: {
        'progress-form' : ProgressForm,
    },
    computed: {

    },
    methods: {

    },
    mounted() {
        var scope = this
    },
}
</script>

<style scoped>
.table-tranx { table-layout: auto; width: 200%;}

</style>