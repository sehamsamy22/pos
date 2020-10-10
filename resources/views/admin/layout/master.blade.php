<!DOCTYPE html>
<html lang="en" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc.">
    <meta name="author" content="Coderthemes">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{asset('admin/assets/images/logo-sm.png')}}">

    <!-- Firebase -->




    <link rel="manifest" href="{{asset('manifest.json')}}">

    @if(auth()->check())
    <script>
    var userId = '{{ auth()->id() }}';

    var lang = '{{ config('app.locale') }}';
    </script>
    @endif


    <title>@yield('title')</title>

    @include('admin.layout.styles')

    @yield('styles')

</head>


<body class="fixed-left">
    
<div class="loading">    
    <div class="lds-facebook">
        <div></div>
        <div></div>
        <div></div>
    </div>
</div>      
    <!-- Begin page -->
    <div id="wrapper">

        @include('admin.layout.header')


        <!-- ========== Left Sidebar Start ========== -->
        @include('admin.layout.menu')
        <!-- Left Sidebar End -->



        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="content-page">
            <!-- Start content -->
            <div class="content">
                <div class="container">


                    @yield('content')

                </div> <!-- container -->

            </div> <!-- content -->

            @include('admin.layout.footer')
            <audio id="myAudio">
                <source src="{{asset('notification.ogg')}}" type="audio/ogg">
            </audio>

        </div>


        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->


        <!-- Notifications -->
        @include('admin.layout.notifications')
        <!-- /Notifications -->

    </div>
    <!-- END wrapper -->


    @include('admin.layout.scripts')

    @yield('scripts')
    {{--<script>--}}
        {{--$.ajaxSetup({--}}
            {{--headers: {--}}
                {{--'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')--}}
            {{--}--}}
        {{--});--}}
        {{--// Initialize Firebase--}}
        {{--var config = {--}}
            {{--apiKey: "AIzaSyALBgynBWwxUuhRz8C9MzpoZdExcMLJawU",--}}
            {{--authDomain: "panorama-hospital.firebaseapp.com",--}}
            {{--databaseURL: "https://panorama-hospital.firebaseio.com",--}}
            {{--projectId: "panorama-hospital",--}}
            {{--storageBucket: "panorama-hospital.appspot.com",--}}
            {{--messagingSenderId: "509474417332"--}}
        {{--};--}}
        {{--firebase.initializeApp(config);--}}

        {{--// Retrieve Firebase Messaging object.--}}
        {{--const messaging = firebase.messaging();--}}

        {{--messaging.requestPermission().then(function() {--}}
            {{--console.log('Notification permission granted.');--}}
            {{--// TODO(developer): Retrieve an Instance ID token for use with FCM.--}}
            {{--// ...--}}
            {{--getRegToken();--}}


        {{--}).catch(function(err) {--}}
            {{--console.log('Unable to get permission to notify.', err);--}}
        {{--});--}}




            {{--function getRegToken(){--}}
                {{--// Get Instance ID token. Initially this makes a network call, once retrieved--}}
        {{--// subsequent calls to getToken will return from cache.--}}
                {{--messaging.getToken().then(function(currentToken) {--}}
                    {{--if (currentToken) {--}}
                        {{--console.log(currentToken);--}}
                        {{--saveTokenInDatabase(currentToken);--}}
                        {{--// updateUIForPushEnabled(currentToken);--}}
                        {{--setTokenSentToServer(true);--}}
                    {{--} else {--}}
                        {{--// Show permission request.--}}
                        {{--console.log('No Instance ID token available. Request permission to generate one.');--}}
                        {{--// Show permission UI.--}}
                        {{--// updateUIForPushPermissionRequired();--}}
                        {{--setTokenSentToServer(false);--}}
                    {{--}--}}
                {{--}).catch(function(err) {--}}
                    {{--console.log('An error occurred while retrieving token. ', err);--}}
        {{--//   showToken('Error retrieving Instance ID token. ', err);--}}
        {{--//   setTokenSentToServer(false);--}}
                {{--});--}}
            {{--}--}}


            {{--function setTokenSentToServer(sent) {--}}
                {{--window.localStorage.setItem('sentToServer', sent ? '1' : '0');--}}
            {{--}--}}

        {{--function isTokenSentToServer() {--}}
            {{--return window.localStorage.getItem('sentToServer') === '1';--}}
            {{--}--}}

        {{--function saveTokenInDatabase(currentToken){--}}

            {{--if (userId) {--}}
                {{--$.ajax({--}}
                    {{--type: "POST",--}}
                    {{--url: url,--}}
                    {{--data: {id: userId, token: currentToken},--}}
                    {{--success: function (data) {--}}
                        {{--console.log('token saved in database successfully')--}}
                    {{--}--}}
                {{--});--}}
            {{--}--}}

        {{--}--}}


            {{--messaging.onMessage(function(payload) {--}}
                {{--console.log('Message received. ', payload);--}}
        {{--//        title = payload.data.title;--}}
        {{--//        options = {--}}
        {{--//            'body':payload.data.body,--}}
        {{--//            'icon':payload.data.icon,--}}
        {{--//            'image':payload.data.image,--}}
        {{--//        };--}}

                {{--$('#notifyPanel').prepend(--}}

                    {{--'<li class="list-group-item"> '+--}}
                    {{--'<a href="'+payload.data.click_action+'" class="user-list-item"><span class="name">'+payload.data.username+'</span>'+--}}
                    {{--'<div class="avatar">'+--}}
                    {{--'<img src="'+payload.data.image+'" alt="">'+--}}
                    {{--'</div>'+--}}
                    {{--'<div class="user-desc">'+--}}
                    {{--'<span class="name">'+payload.data.title+'</span><span class="desc"> '+payload.data.body+' </span>'+--}}
                    {{--'</div>'+--}}
                    {{--'</a>'+--}}
                    {{--'</li>'--}}
                {{--);--}}

                {{--var sound = document.getElementById("myAudio");--}}
                {{--if(sound.play()){--}}
                    {{--console.log('sound played well');--}}
                {{--}--}}
                {{--else--}}
                {{--{--}}
                    {{--console.log('can not be played');--}}
                {{--}--}}


                {{--toastr.options = {--}}
                    {{--"closeButton": false,--}}
                    {{--"debug": false,--}}
                    {{--"newestOnTop": false,--}}
                    {{--"progressBar": false,--}}
                    {{--"positionClass": "toast-top-right",--}}
                    {{--"preventDuplicates": false,--}}
                    {{--"onclick": null,--}}
                    {{--"showDuration": "300",--}}
                    {{--"hideDuration": "1000",--}}
                    {{--"timeOut": "20000",--}}
                    {{--"extendedTimeOut": "20000",--}}
                    {{--"showEasing": "swing",--}}
                    {{--"hideEasing": "linear",--}}
                    {{--"showMethod": "fadeIn",--}}
                    {{--"hideMethod": "fadeOut"--}}
                {{--}--}}

                {{--toastr["success"](payload.data.title,payload.data.body);--}}


            {{--});--}}

    {{--</script>--}}
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

@include('sweet::alert')

     <script>
        $(document).ready(function() {
            $("button.button-menu-mobile.open-left").on('click', function() {
                $('.topbar .topbar-left').toggleClass('top-log');
            })
        })

    </script>

    <script>
        $(document).ready(function() {
                $('.loading').addClass('ready-loading');
            $('html').css('overflow' , 'auto')
            })


    </script>


</body>

</html>
