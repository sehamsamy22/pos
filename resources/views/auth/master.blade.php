<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Omar Zain (Backend Developer)">

    <!-- App Favicon -->
    <link rel="shortcut icon" href="{{asset('/website/img/small_logo.png')}}">

    <!-- App title -->
    <title> نظام التجارة واداره مركز التغذية</title>

    <!-- App CSS -->
    <link href="{{asset('/admin/assets/css/bootstrap-rtl.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin/assets/css/core.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin/assets/css/components.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin/assets/css/pages.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin/assets/css/menu.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('/admin/assets/css/responsive.css')}}" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shiv and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

    <script src="{{asset('/admin/assets/js/modernizr.min.js')}}"></script>
    <link href="{{asset('admin/assets/css/customize.css')}}" rel="stylesheet" type="text/css" />

</head>
<body>

<div class="account-pages"></div>
<div class="account-pages">
    <div class="clearfix"></div>
    <div class="wrapper-page">
        <div class="text-center">
            {{--</div>--}}
            {{--</div>--}}

        </div>
    </div>


    @yield('content')

    {{--<div class="row">--}}
    {{--<div class="col-sm-12 text-center">--}}
    {{--<p class="text-muted">Don't have an account? <a href="#" class="text-primary m-l-5"><b>Sign Up</b></a></p>--}}
    {{--</div>--}}
    {{--</div>--}}

</div>
<!-- end wrapper page -->



<script>
    var resizefunc = [];
</script>

<!-- jQuery  -->
<script src="{{asset('/admin/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/bootstrap-rtl.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/detect.js')}}"></script>
<script src="{{asset('/admin/assets/js/fastclick.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('/admin/assets/js/waves.js')}}"></script>
<script src="{{asset('/admin/assets/js/wow.min.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.scrollTo.min.js')}}"></script>

<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="{{asset('/admin/assets/plugins/parsleyjs/dist/parsley.min.js')}}"></script>


<!-- App js -->
<script src="{{asset('/admin/assets/js/jquery.core.js')}}"></script>
<script src="{{asset('/admin/assets/js/jquery.app.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('form').parsley();
    });
</script>


</body>
</html>
