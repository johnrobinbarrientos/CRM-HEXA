<template>
    <div>
       <SideBar></SideBar>
       <div style="min-height:100vh; padding:20px; padding-left:270px;">AAA</div>
    </div>
</template>

<script>
import SideBar from './components/SideBar'
export default {
    name: 'home',
    props: ['properties'],
    data: function () {
        return {
            
        }
    },
    components: {
        SideBar
    },
    methods: {
        authenticate: function () {
           
        }
    },
    mounted() {
        
    }
}
</script>