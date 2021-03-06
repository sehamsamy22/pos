@extends('admin.layout.master')
@section('title','نظام التجارة واداره مركز التغذية')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <h4 class="page-title">الصفحة الرئيسية</h4>
        </div>
    </div>


    <div class="row">


        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 m-b-30">   اشتراكات العملاء</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1">
                        <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#e36c09 "
                               data-bgColor="rgba(227, 108, 9, .4)" value="{{ $subscriptions }}"
                               data-skin="tron" data-angleOffset="180" data-readOnly=true
                               data-thickness=".15"/>
                    </div>
                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> {{ $subscriptions }}</h2>
                        <p class="text-muted">  اجمالى عدد الاشنركات المفعلة </p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->

        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 m-b-30">أيرادات اليوم</h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">
                        <span class="badge badge-success pull-left m-t-20"> {{ $sales+$subscriptions_client }}%<i class="zmdi zmdi-trending-up"></i> </span>
                        <h2 class="m-b-0"> {{ $sales+$subscriptions_client }}</h2>
                        <p class="text-muted m-b-25">أيرادات اليوم</p>
                    </div>
                    <div class="progress progress-bar-success-alt progress-sm m-b-0">
                        <div class="progress-bar progress-bar-success" role="progressbar"
                             aria-valuenow="{{ $sales }}" aria-valuemin="0" aria-valuemax="100"
                             style="width: {{ $sales }}%">
                            <span class="sr-only">{{ $sales }}% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->



        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">  مصروفات اليوم</h4>

                <div class="widget-box-2">
                    <div class="widget-detail-2">
                        <span class="badge badge-pink pull-left m-t-20">{{ $purchases}}% <i class="zmdi zmdi-trending-up"></i> </span>
                        <h2 class="m-b-0">{{ $purchases}} </h2>
                        <p class="text-muted m-b-25">   مصروفات اليوم</p>
                    </div>
                    <div class="progress progress-bar-pink-alt progress-sm m-b-0">
                        <div class="progress-bar progress-bar-pink" role="progressbar"
                             aria-valuenow="" aria-valuemin="0" aria-valuemax="100"
                             style="width: {{ $purchases}}%;">
                            <span class="sr-only">{{ $purchases}}% Complete</span>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- end col -->


        <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 m-b-30">المنتجات والوجبات</h4>

                <div class="widget-chart-1">
                    <div class="widget-chart-box-1">
                        <input data-plugin="knob" data-width="80" data-height="80" data-fgColor="#e36c09"
                               data-bgColor="rgba(227, 108, 9, .4)" value="{{ $meals }}"
                               data-skin="tron" data-angleOffset="180" data-readOnly=true
                               data-thickness=".15"/>
                    </div>
                    <div class="widget-detail-1">
                        <h2 class="p-t-10 m-b-0"> {{ $meals }}</h2>
                        <p class="text-muted">عدد الوجبات المتاحة اليوم</p>
                    </div>
                </div>
            </div>
        </div><!-- end col -->


    </div>
    <!-- end row -->

    <div class="row">
       <div class="col-lg-4 col-md-6 col-xs-12">
           <div class="card-box">
               <h4 class="header-title m-t-0">احصائية  الاشتركات والعملاء</h4>
               <div class="widget-chart text-center">
                   <div id="morris-donut-clients"  style="height: 280px;"></div>

               </div>
           </div>
       </div><!-- end col -->

       <div class="col-lg-4 col-md-6 col-xs-12">
           <div class="card-box">
               {{--  <div class="dropdown pull-right">
                   <a href="#" class="dropdown-toggle card-drop" data-toggle="dropdown" aria-expanded="false">
                       <i class="zmdi zmdi-more-vert"></i>
                   </a>

               </div>  --}}
               <h4 class="header-title m-t-0"> مبيعات السنة</h4>
               <div id="morris-bar-sales" style="height: 280px;"></div>
           </div>
       </div>
       <!-- end col -->

       <div class="col-lg-4 col-md-6 col-xs-12">
        <div class="card-box">

            <h4 class="header-title m-t-0">  الايرادات والمصروفات الشهريه</h4>
            <div id="morris-line-purchases" style="height: 280px;"></div>
        </div>
    </div><!-- end col -->



    </div>
    <!-- end row -->



@endsection
@section('scripts')
    <script>
!function($) {
"use strict";

var Dashboard1 = function() {
this.$realData = []
};

//creates Bar chart
Dashboard1.prototype.createBarChart  = function(element, data, xkey, ykeys, labels, lineColors) {
Morris.Bar({
element: element,
data: data,
xkey: xkey,
ykeys: ykeys,
labels: labels,
hideHover: 'auto',
resize: true, //defaulted to true
gridLineColor: '#eeeeee',
barSizeRatio: 0.2,
barColors: lineColors
});
},

// //creates line chart
Dashboard1.prototype.createLineChart = function(element, data, xkey, ykeys, labels, opacity, Pfillcolor, Pstockcolor, lineColors) {
Morris.Line({
element: element,
data: data,
xkey: xkey,
ykeys: ykeys,
labels: labels,
fillOpacity: opacity,
pointFillColors: Pfillcolor,
pointStrokeColors: Pstockcolor,
behaveLikeLine: true,
gridLineColor: '#eef0f2',
hideHover: 'auto',
resize: true, //defaulted to true
pointSize: 0,
lineColors: lineColors,
    parseTime: false
});
},

//creates Donut chart
Dashboard1.prototype.createDonutChart = function(elementdonut, data, colors) {
Morris.Donut({
element: elementdonut,
data: data,
resize: true, //defaulted to true
colors: colors
});
},


Dashboard1.prototype.init = function() {

//creating bar chart
var $barData  = [
    @foreach($sales_year as $month=>$sale)

{ y: '{{$month}}', a: '{{$sale}}' },

@endforeach

];
this.createBarChart('morris-bar-sales', $barData, 'y', ['a'], ['ريال'], ['#188ae2']);

//create line chart
var $qdata  = [
    @foreach($Profit_year as $month=>$profit)
{ y: '{{$month}}', a: {{$profit[0]}}, b:{{$profit[1]}}  },
    @endforeach
];

 this.createLineChart('morris-line-purchases', $qdata,  'y', ['a','b'], ['مبيعات','مشتريات'],['#ffffff'],['#999999'], ['#e36c09','#10c469']);

//creating donut chart
var $donutData = [
    @foreach($subscription_cat as $cat)
    {label:'{{$cat['name']}}', value: {{ $cat['count']}} },
    @endforeach

];
this.createDonutChart('morris-donut-clients',$donutData, ['#ff8acc', '#5b69bc', "#35b8e0"]);
},
//init
$.Dashboard1 = new Dashboard1, $.Dashboard1.Constructor = Dashboard1
}(window.jQuery),

//initializing
function($) {
"use strict";
$.Dashboard1.init();
}(window.jQuery);
</script>
@endsection
