<template>
    <div>      
        Supplier Details 2
    </div>
</template>

<script>
export default {
    name: 'buying-by-supplier',
    props: ['properties'],
    components: {

    },
    data: function () {
        return {

           
        }
    },
    computed: {

    },
    methods: {
        getSupplierGroups: function () {
           var scope = this
             scope.GET('suppliers/supplier-group?keyword=&page=1&take=100&with=suppliers').then(res => {
           
            })
        }
    },
    mounted() {
        var scope = this
        scope.getSupplierGroups()
    },
}
</script>