@extends('admin.layout.master')
@section('title',' عرض  الاشتراك')

@section('styles')
    <style>
        .erro{
            color: red;
        }
    </style>
@endsection

@section('content')
    <!-- Page Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                {{--<a href="{{route('users.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لمستخدمي النظام<span class="m-l-5"><i class="fa fa-reply"></i></span></a>--}}
            </div>
            <h4 class="page-title">  عرض  تفاصيل الاشتراك</h4>
        </div>
    </div>
    <div class="row">
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->

        <!-- Start content -->
        <div class="content">
            <div class="container">

                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <!-- <div class="panel-heading">
                                <h4>Invoice</h4>
                            </div> -->
                            <div class="panel-body">
                                <div class="clearfix">
                                    <div class="pull-left">
                                        <h3 class="logo-bill"> <img src="{{getimg(getsetting('logo'))}}"></h3>
                                    </div>
                                    <div class="pull-right">
                                        <h4>رقم الاشتراك# <br>
                                            <strong>{{ $clientSubsription->id }}</strong>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">

                                                            <div class="pull-left m-t-30">
                                            <p class="m-t-10"><strong>اسم العميل: </strong> {{$clientSubsription->client->name ??''}}</p>
                                            <p class="m-t-10"><strong>اسم الخطة: </strong> {{$clientSubsription->subscription->name}}</p>

                                            <p><strong> تاريخ بداية الاشتراك: </strong> {{$clientSubsription->start}}</p>
                                            <p><strong>تاريخ نهايةالاشتراك: </strong> {{$clientSubsription->end}}</p>
                                        </div>
                                    </div><!-- end col -->
                                </div>
                                <!-- end row -->

                                <div class="m-h-50"></div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table m-t-30">
                                                <thead>
                                                <tr>
                                                    <th></th>
                                                    <th>السبت </th>
                                                    <th>الاحد </th>
                                                    <th>الاتنين </th>
                                                    <th>الثلاثاء </th>
                                                    <th>الاربعاء </th>
                                                    <th>الخميس </th>
                                                    <th>الجمعه </th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                @foreach($types as $key => $type)

                                                <tr>
                                                  <td>{{ $type->name }}</td>
                                                  @for($i=1;$i<=7;$i++)
                                                      <td>

                                                          <div class="{{$i}}" style="display: inline">

                                                          @foreach($type->meals_sub($clientSubsription->subscription_id) as  $key=>$meal)
                                                          @foreach($dietsystems as $dietsystem)
                                                          @if ($dietsystem->meal_id==$meal->id  && $dietsystem->day_No==$i)

                                                            {{$meal->ar_name}}-{{$meal->calories}}


                                                          @endif

                                                            @endforeach
                                                          @endforeach
                                                      </div>
                                                      </td>
                                                  @endfor
                                              </tr>
                                              @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-xs-6">
                                        <div class="clearfix m-t-40">
                                            <h5 class="small text-inverse font-600">الشروط وسياسة الدفع</h5>

                                            <small>
                                                {!! getsetting('trems') !!}
                                            </small>
                                        </div>

                                    </div>
                                    <div class="col-md-3 col-sm-6 col-xs-6 col-md-offset-3">
                                        <p class="text-right"><b>الخصم:</b> {{$clientSubsription->discount}}%</p>
                                        <p class="text-right"><b>الضريبة:</b>  {{ getsetting('tax') }}%</p>
                                        <p class="text-right"><b>إجمالى الفاتورة:</b>{{$clientSubsription->total}}</p>

                                        <hr>
                                        <h3 class="text-right"><b> المدفوع:</b>{{$clientSubsription->payed}}</h3>
                                        <h3 class="text-right"><b> المتبقى:</b>{{$clientSubsription->total-$clientSubsription->payed }}</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print">
                                    <div class="pull-right">
                                        <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light print"><i class="fa fa-print"></i></a>
                                        {{--                                        <a href="#" class="btn btn-primary waves-effect waves-light">Submit</a>--}}
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
                <!-- end row -->


            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer">
            {{--            2016 - 2017 © Adminto.--}}
        </footer>



        <!-- ============================================================== -->
        <!-- End Right content here -->
        <!-- ============================================================== -->
    </div>
@endsection
@section('scripts')

<script>
	$(document).ready(function() {
		$(".print").click(function() {
			window.print();
		})
	});
</script>

@endsection