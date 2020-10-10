<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta name="HandheldFriendly" content="true">
    <title> رواد الخبرة </title>
    <link rel="stylesheet" href="{{asset('website/css/bootstrap.min.css')}}">
    <link rel="shortcut icon" href="{{asset('website/img/logo-sm.png')}}">
    <link rel="stylesheet" href="{{asset('website/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('website/css/animate.css')}}">


@yield('styles')
    <!----------->
    <link rel="stylesheet" href="{{asset('website/css/style.css')}}">
    <!------ IE -------->
    <script src="{{asset('website/js/html5shiv.min.js')}}"></script>
    <script src="{{asset('website/js/respond.min.js')}}"></script>
</head>



<body data-spy="scroll" data-target=".nav.cf" data-offset="100">
<div class="body-overlay"></div>
<!-- Start Loading-Page -->
<div class="loader">
    <div class="wrapper">
        <div class="text-container">
            <div class="animated-text">ر</div>
            <div class="animated-text">و</div>
            <div class="animated-text">ا</div>
            <div class="animated-text">د</div>
            <div class="animated-text"> </div>
            <div class="animated-text">ا</div>
            <div class="animated-text">لـ</div>
            <div class="animated-text">خـ</div>
            <div class="animated-text">ب</div>
            <div class="animated-text">ر</div>
            <div class="animated-text">ة</div>
            <div class="animated-text">.</div>
            <div class="animated-text">.</div>

        </div>
    </div>
</div>
<!-- End Loading-Page -->





<!-- ********************************************** Content Area **************************************************** -->
@yield('content')
<!-- ********************************************** Content Area **************************************************** -->



        <!-- Start Footer -->
        <section class="footer">
            <div class="container">
                <div class="footer-content">
                    <div class="row">

                        <div class="col-sm-4 col-xs-12 ">
                            <div class="foot1">
                                <h3>معلومات التواصل</h3>
                                <ul>
                                    <li>
                                        <span> <i class="fas fa-home"></i> </span>
                                        {{ getsetting('address') }}
                                                           </li>
                                    <li> <a href="mailto:{{getsetting('email')}}">
                                            <span> <i class="fas fa-envelope"></i> </span>
                                            {{ getsetting('email') }}</a>
                                    </li>
                                    <li> <a href="https://wa.me/{{getsetting('phone')}}">
                                            <span> <i class="fas fa-phone"></i> </span>
                                            {{ getsetting('phone') }}</a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-4 col-xs-7">
                            <div class="foot1">
                                <h3>معلومات التواصل</h3>
                                <ul class="social">
<!--
                                    <li>
                                        <a href="{{getsetting('facebook')}}">
                                            <span> <i class="fab fa-facebook"></i> </span>
                                            Like us on Facebook
                                        </a>
                                    </li>
-->
                                    <li>
                                        <a href="{{getsetting('twitter')}}">
                                            <span> <i class="fab fa-twitter"></i> </span>
                                            Follow us on Twitter
                                        </a>
                                    </li>
                                    <li>
                                        <a href="https://wa.me/{{getsetting('phone')}}">
                                            <span> <i class="fab fa-whatsapp"></i></span>
                                            Add us on Whatsapp
                                        </a>
                                    </li>
<!--
                                    <li>
                                        <a href="{{getsetting('linkin')}}">
                                            <span> <i class="fab fa-linkedin-in"></i> </span>
                                            Follow us on Linkedi
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{getsetting('email')}}">
                                            <span> <i class="fas fa-rss"></i> </span>
                                            Subscribe us on RSS
                                        </a>
                                    </li>
-->
                                </ul>

                            </div>
                        </div>

                        <div class="col-sm-4 col-xs-5">
                            <div class="foot1">
                                <h3>معلومات التواصل</h3>
                                <ul>
                                    <li> <a href="{{route('speech')}}">كلمة  المدير العام </a> </li>
                                    <li> <a href="{{route('goals')}}">الرؤية والرسالة </a> </li>
                                    <li> <a href="{{route('responsability')}}">المسئولية الاجتماعية </a> </li>
                                    <li> <a href="{{route('index')}}#contact">اتصل بنا </a> </li>
                                    <li> <a href="{{route('index')}}#testimon">رسائل العملاء</a> </li>
                                </ul>
                            </div>
                        </div>


                    </div>

                </div>


            </div>

            <div class="copyright">
                <span>&copy;</span> رواد النخبة <a href="http://panorama-alqassim.com" target=”_blank” rel="noopener noreferrer">Panorama Al Qassim</a>
            </div>

        </section>
        <!-- End Footer -->



        <!--Scroll Button-->
        <div id="scroll-top">
            <i class="fa fa-angle-up"></i>
        </div>



        <!-- Strat End -->
        <!--===============================
             SCRIPT
             ===================================-->

        <script src="{{asset('website/js/jquery-1.11.1.min.js')}}"></script>
        <script src="{{asset('website/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('website/js/all.min.js')}}"></script>
        <script src="{{asset('website/js/wow.min.js')}}"></script>
        <script>
            new WOW().init();

        </script>


        <!----------------- These for here Only ----------------->
        <!--            <script type="text/javascript" src="https://unpkg.com/onscreen/dist/on-screen.umd.min.js"></script>-->



        <script>
            $(document).ready(function() {
                $('[data-spy="scroll"]').each(function() {
                    var $spy = $(this).scrollspy('refresh')
                });
            });

        </script>

     @yield('scripts')
        <!--
            <script>
                $(document).ready(function() {
                    new Vivus('my-svg', {
                        type: 'delayed',
                        duration: 150,
                        animTimingFunction: Vivus.EASE
                    });
                });

            </script>

            <script>

                $(window).scroll(function (event) {
                    new Vivus('my-svg', {
                        type: 'delayed',
                        duration: 150,
                        animTimingFunction: Vivus.EASE
                    });
         var scroll = $(window).scrollTop();
         var one = $('#theAnim').position().top;
         var count = 0;
         if (scroll > one) {
           var newCount = count + 1;
           if (newCount === 1) {
             $("#theAnim").addClass('start');
           };
         };
        });

            </script>
        -->
        <!-- <script type="text/javascript">
             $(document).ready(function () {

                 $("#theAnim path").removeClass('start');

                 $(window).scroll(function () {
                     if ($("section#our-system").isVisible()) {
                         $("#theAnim").addClass('start');
                         alert('visible')
                     }
                 });
             });

             // Add wave animation
             $.fn.isVisible = function () {
                 // Current distance from the top of the page
                 var windowScrollTopView = $(window).scrollTop();

                 // Current distance from the top of the page, plus the height of the window
                 var windowBottomView = windowScrollTopView + $(window).height();

                 // Element distance from top
                 var elemTop = $(this).offset().top;

                 // Element distance from top, plus the height of the element
                 var elemBottom = elemTop + $(this).height();

                 return ((elemBottom <= windowBottomView) && (elemTop >= windowScrollTopView));
             };
         </script>
         <script type="text/javascript" src="js/snap.svg-min.js"></script>

             <script type="text/javascript" src="js/pathformer.js"></script>-->

    </body>

    </html>
