<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <meta name="theme-color" content="#000000">
        <meta name="description" content="Web site created using create-react-app">
        <title>HEXA SUITE</title>
        


        <link href="/app/vendors/select2/css/select2.min.css?ver=1.6.0" rel="stylesheet" />
		
		<!-- Bootstrap Css -->
        <link href="/themes/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="/themes/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="/themes/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />
        
   
        <link href="/app/css/fonts.css" rel="stylesheet" />
        <link href="/app/css/customs.css" rel="stylesheet" />
        <link href="/app/css/color-palette.css" rel="stylesheet" />

   
    </head>
    <body data-sidebar="dark" data-sidebar-size="" data-topbar="light" data-layout-size="fluid" class="">
        <noscript>You need to enable JavaScript to run this app.</noscript>
        <div id="root">
            <div id="preloader" style="display: none;">
                <div id="status" style="display: none;">
                    <div class="spinner-chase">
                        <div class="chase-dot"></div>
                        <div class="chase-dot"></div>
                        <div class="chase-dot"></div>
                        <div class="chase-dot"></div>
                        <div class="chase-dot"></div>
                        <div class="chase-dot"></div>
                    </div>
                </div>
            </div>
            <div id="app">
                <app></app>
            </div>
        </div>
           <!-- JAVASCRIPT -->
        <script src="/themes/libs/jquery/jquery.min.js"></script>
		 <script src="/app/vendors/select2/js/select2.full.min.js?ver=1.6.0'"></script>
		 
        <script src="/themes/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="/themes/libs/metismenu/metisMenu.min.js"></script>
        <script src="/themes/libs/simplebar/simplebar.min.js"></script>
        <script src="/themes/libs/node-waves/waves.min.js"></script>
	
        <script src="/themes/js/app.js"></script>
       
		
        <script src="{{ mix('js/app.js') }}?v={{ time() }}"></script>
        <script src="/app/js/customs.js"></script>

    </body>
</html>