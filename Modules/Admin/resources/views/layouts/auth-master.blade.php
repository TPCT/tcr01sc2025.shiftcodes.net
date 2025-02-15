<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Tajeer</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{url('/')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/assets/css/authentication/form-1.css" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->    
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/forms/switches.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/custom.css">
</head>
<body class="form">

    <div class="form-container">

        @section("content")
        @show

        @include('admin::layouts.parts.auth-left')
    </div>


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{url('/')}}/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{url('/')}}/bootstrap/js/popper.min.js"></script>
    <script src="{{url('/')}}/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <script src="{{url('/')}}/assets/js/authentication/form-1.js"></script>

</body>
</html>