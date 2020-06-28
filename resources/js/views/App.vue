<template>
    <div>
        <notifications group="notification" />
        <p style="display:none;">
            <router-link :to="{ name: 'home' }">Home</router-link> |
            <router-link :to="{ name: 'hello' }">Hello World</router-link>
            <router-link :to="{ name: 'auth' }">Auth</router-link>
        </p>
        <router-view></router-view>
    </div>
</template>

<script>
    export default {}
</script>

<style>
    @import url("https://fonts.googleapis.com/css?family=Montserrat:400,400i,700");
    @import url("https://fonts.googleapis.com/css?family=Open+Sans:400,400i,700");
    * { 
        -moz-box-sizing: border-box; 
        -webkit-box-sizing: border-box; 
        box-sizing: border-box; 
    }
    body { font-family: Montserrat, sans-serif; padding:0px; margin:0px; }
    
    .kx-btn { cursor:pointer; transform:0.2; min-width: 120px; text-align:center; height:35px; line-height:35px; border-radius:4px; font-weight:600; background:#096bef; color:#fff; padding:0px; border:1px solid #096bef; }
    .kx-btn:hover {opacity:0.8; }
    .kx-btn-block { width:100%; }
    .kx-btn-rounded { border-radius:25px; }

    .kx-alert-red { background:#fa625c; color:#fff; width:100%; font-size:12px; padding:10px 12px; margin-bottom:10px; }
    
    .kx-form-group { margin-bottom:10px; }
    .kx-form-group label { color:#5c717d; font-weight:600; display:inline-block; padding-bottom:5px; }
    .kx-form-control { display: block; height:35px; line-height:35px; padding:0px 10px; width:100%; border:1px solid #d2dadf; border-radius:4px; }

    .kx-sidebar { position:fixed; top:0px; left:0px; width:250px; height:100vh; background:#354051; border-right:1px solid #e6e9eb; }
    .kx-sidebar .logo { background:transparent;  border-bottom:1px solid transparent;  color:#fff; text-align:center; padding:10px; font-weight:600; }
    .kx-sidebar .navs .item {  color:#fff; background:transparent;  padding:8px 10px; padding-left:45px; position:relative; border-bottom:1px solid #3f4a5a; font-size:14px;  }
    .kx-sidebar .navs .item:hover { cursor:pointer; background:#3f4a5a; color:#ffa32c; }
    .kx-sidebar .navs .item .icon { position:absolute; top:5px; left:10px; font-size:22px;  }

    .kx-content-wrapper { min-height:100vh; background:#f7f7f7; padding:0px; padding-left:250px; }
    .kx-content-wrapper .kx-content-heading { background:#fff; margin-bottom:20px; padding:10px 20px; border-bottom:1px solid #ccc; }
    .kx-content-wrapper .kx-content-heading h2 { margin:0px; }

    .kx-content-wrapper .kx-content { padding:20px;}

    .kx-panel { background:#ffffff; border:1px solid #efefef; margin:0px auto; margin-bottom:20px; width:100%; max-width:650px; }
    .kx-panel .kx-panel-header { padding:15px 0px; font-size:20px; font-weight:600; padding:10px; }
    .kx-panel .kx-panel-content { padding:10px; }
    .kx-panel .kx-panel-footer { padding:10px 0px; padding-bottom:20px; text-align:center; }

    .kx-form-group { width:100%; margin-bottom:10px; }

    .kx-form-group  input[type=text], 
    .kx-form-group  input[type=password], 
    .kx-form-group  input[type=email] { width:100%; height:40px; line-height:40px; padding:0px 15px; border:1px solid #ccc; }

    .kx-btn-orange { cursor:pointer; padding:0px 10px; background:#ffa32c; color:#fff; border:1px solid #ffa32c; height:40px; line-height:40px; }
    .kx-btn-white { cursor:pointer; padding:0px 10px; background:#efefef; color:#444; border:1px solid #ccc; height:40px; line-height:40px; }

    .kx-table { width:100%; border:1px solid #efefef; }
    .kx-table thead tr { background:#fff; border-bottom:1px solid #edefef; }
    .kx-table thead tr th { text-align:left; padding:8px 10px; }

    .kx-table tbody tr { background:#fff; border-bottom:1px solid #edefef; }
    .kx-table tbody tr:hover, .kx-table tbody tr:nth-child(even):hover { background:#448df7; color:#fff; } 
    .kx-table tbody tr:nth-child(even) { background:#f5ebe4; border-bottom:1px solid #edefef; }
    .kx-table tbody tr td { text-align:left; padding:8px 10px; }
</style>