<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>Tajeer</title>
    <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico"/>
    <link href="{{url('/')}}/assets/css/loader.css" rel="stylesheet" type="text/css" />
    <script src="{{url('/')}}/assets/js/loader.js"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="{{url('/')}}/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/assets/css/plugins.css" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <link href="{{url('/')}}/assets/css/buttons.bootstrap4.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />

    <!-- END GLOBAL MANDATORY STYLES -->
    <link rel="stylesheet" href="{{url('/')}}/plugins/font-icons/fontawesome/css/regular.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.0/css/solid.min.css" integrity="sha512-eUxd2YUy87FAiBLFa+aZsMC2iAZTKDAWtWoegy3t5CCz/WcB+Ug/bICT9Ifw52o1zdhnnt+lT3IEtpE0V2/9gw==" crossorigin="anonymous" referrerpolicy="no-referrer" />    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.3.0/css/brands.min.css" integrity="sha512-uR4eUG8qhd2kbhSmRfqPBxRAotjyCJ2Guo8JzBrk3bl6TvxipmFkCAl8evDJ2OxaGFI7bekGL9YtpYPC47ghbA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('/')}}/plugins/font-icons/fontawesome/css/fontawesome.css">
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{url('/')}}/plugins/apex/apexcharts.css" rel="stylesheet" type="text/css">
    <link href="{{url('/')}}/assets/css/dashboard/dash_1.css" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.css" integrity="sha512-jU/7UFiaW5UBGODEopEqnbIAHOI8fO6T99m7Tsmqs2gkdujByJfkCbbfPSN4Wlqlb9TGnsuC0YgUgWkRBK7B9A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/plugins/table/datatable/datatables.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/assets/css/forms/theme-checkbox-radio.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/plugins/table/datatable/dt-global_style.css">
    <link rel="stylesheet" type="text/css" href="{{url('/')}}/plugins/table/datatable/custom_dt_custom.css">
    <!-- END PAGE LEVEL CUSTOM STYLES -->

    <link href="{{url('/')}}/assets/css/custom_dashboard.css" rel="stylesheet" type="text/css" />

</head>
<body>

    @section('modals')
    @show

    <!-- BEGIN LOADER -->
    <!-- <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div> -->
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('admin::layouts.parts.app.header')
    <!--  END NAVBAR  -->

    <!--  BEGIN NAVBAR  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">

                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="javascript:void(0);">{{__('admin.dashboard')}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page"><span>{{__('admin.home')}}</span></li>
                            </ol>
                        </nav>

                    </div>
                </li>
            </ul>
           
        </header>
    </div>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('admin::layouts.parts.app.sidebar')
        <!--  END SIDEBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">

        @section('content')
        @show


        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <div class="faq__item faq__copy_item">
        <div class="row">
            @foreach(\Config::get("app.languages") as $key => $value)
                <div class="col-lg-6">
                    <div class="form-group row mb-4">
                        <label class="col-xl-12 col-sm-12 col-sm-12 col-form-label">{{__('admin.question')}} {{$value}}</label>
                        <div class="col-xl-12 col-lg-12 col-sm-12">
                            <input type="text" value=""  class="form-control" name="faq_question_{{$key}}[]" >
                        </div>
                    </div>
                </div>
            @endforeach 
            @foreach(\Config::get("app.languages") as $key => $value)
                <div class="col-lg-6">
                    <div class="form-group row mb-4">
                        <label class="col-xl-12 col-sm-12 col-sm-12 col-form-label">{{__('admin.answer')}} {{$value}}</label>
                        <div class="col-xl-12 col-lg-12 col-sm-12">
                            <input type="text" value=""  class="form-control" name="faq_answer_{{$key}}[]" >
                        </div>
                    </div>
                </div>
            @endforeach 
            <div class="col-lg-12">
                <button type="button" class="btn btn-danger mt-20 btn-rounded remove-faq">
                    <svg viewBox="0 0 24 24" width="24" height="24" stroke="currentColor" stroke-width="2" fill="none" stroke-linecap="round" stroke-linejoin="round" class="css-i6dzq1"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                    {{__('admin.delete')}}
                </button>
            </div>
        </div>
    </div>

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{url('/')}}/assets/js/libs/jquery-3.1.1.min.js"></script>
    <script src="{{url('/')}}/bootstrap/js/popper.min.js"></script>
    <script src="{{url('/')}}/bootstrap/js/bootstrap.min.js"></script>

    <script src="{{url('/')}}/plugins/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="{{url('/')}}/assets/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/dropzone.min.js" integrity="sha512-U2WE1ktpMTuRBPoCFDzomoIorbOyUv0sP8B+INA3EzNAhehbzED1rOJg6bCqPf/Tuposxb5ja/MAUnC8THSbLQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            App.init();
        });
    </script>
    <script src="{{url('/')}}/assets/js/custom.js"></script>

    <script src="{{url('/')}}/plugins/table/datatable/datatables.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>
    <script src="{{url('/')}}/assets/js/dataTables.buttons.min.js"></script>
    <script src="{{url('/')}}/assets/js/buttons.bootstrap4.min.js"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{url('/')}}/plugins/apex/apexcharts.min.js"></script>
    <script src="{{url('/')}}/assets/js/dashboard/dash_1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.1.0/tinymce.min.js" integrity="sha512-Va3PZJRSZ8TlnqUfjkA5YPR57+oIscCVoNGjYK1JYsOTw8VU7517hHqs90/h/YuUm8KZl9iD+Dt8K6T8uAJCqw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{url('/')}}/assets/js/core.js"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    @section('js')
    @show



</body>
</html>