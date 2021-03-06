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
                                        <h3 class="logo-bill"> <img src="{{getimg(getsetting('logo'))}}" style="height: 109px; margin-bottom: -19px;"></h3>
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
                                            <table  class="table table-striped table-bordered">
                                                <thead>
                                                <caption> <h3> الاسبوع الاول</h3></caption>
                                                <tr>
                                                    <th></th>
                                                    <th>اليوم الاول </th>
                                                    <th>اليوم التانى </th>
                                                    <th>اليوم الثالث </th>
                                                    <th>اليوم الرابع </th>
                                                    <th>اليوم الخامس </th>
                                                    <th>اليوم السادس </th>
                                                    <th>اليوم السابع </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($week=1)
                                                @foreach($types as $key => $type)
                                                    <tr>
                                                        <td style="font-weight: 600;">{{ $type->name }}</td>
                                                        @for($i=1;$i<=7;$i++)
                                                            <td>
                                                                @foreach(mealsWeek1($clientSubsription->id,$i,$type->id) as $size)
                                                                    @if($type->id == $size->meal->type_id)
                                                                        <li style="list style:none">

                                                                            {{$size->name}}
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <table  class="table table-striped table-bordered">
                                                <thead>
                                                <caption> <h3> الاسبوع الثانى</h3></caption>
                                                <tr>
                                                    <th></th>
                                                    <th>اليوم الاول </th>
                                                    <th>اليوم التانى </th>
                                                    <th>اليوم الثالث </th>
                                                    <th>اليوم الرابع </th>
                                                    <th>اليوم الخامس </th>
                                                    <th>اليوم السادس </th>
                                                    <th>اليوم السابع </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($week=2)
                                                @foreach($types as $key => $type)
                                                    <tr>
                                                        <td style="font-weight: 600;">{{ $type->name }}</td>
                                                        @for($i=1;$i<=7;$i++)
                                                            <td>
                                                                @foreach(mealsWeek2($clientSubsription->id,$i,$type->id) as $meal)
                                                                    @if($type->id == $size->meal->type_id)
                                                                        <li style="list style:none">

                                                                            {{$size->name}}
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <table  class="table table-striped table-bordered">
                                                <thead>
                                                <caption> <h3> الاسبوع الثالث</h3></caption>

                                                <tr>
                                                    <th></th>
                                                    <th>اليوم الاول </th>
                                                    <th>اليوم التانى </th>
                                                    <th>اليوم الثالث </th>
                                                    <th>اليوم الرابع </th>
                                                    <th>اليوم الخامس </th>
                                                    <th>اليوم السادس </th>
                                                    <th>اليوم السابع </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($week=3)
                                                @foreach($types as $key => $type)
                                                    <tr>
                                                        <td style="font-weight: 600;">{{ $type->name }}</td>
                                                        @for($i=1;$i<=7;$i++)
                                                            <td>
                                                                @foreach(mealsWeek3($clientSubsription->id,$i,$type->id) as $size)
                                                                    @if($type->id == $size->meal->type_id)
                                                                        <li style="list style:none">
                                                                            {{$size->name}}
                                                                        </li>
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                        @endfor
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                            <table  class="table table-striped table-bordered">
                                                <thead>
                                                <caption> <h3> الاسبوع الرابع</h3></caption>

                                                <tr>
                                                    <th></th>
                                                    <th>اليوم الاول </th>
                                                    <th>اليوم التانى </th>
                                                    <th>اليوم الثالث </th>
                                                    <th>اليوم الرابع </th>
                                                    <th>اليوم الخامس </th>
                                                    <th>اليوم السادس </th>
                                                    <th>اليوم السابع </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php($week=4)
                                                @foreach($types as $key => $type)
                                                    <tr>
                                                        <td style="font-weight: 600;">{{ $type->name }}</td>
                                                        @for($i=1;$i<=7;$i++)
                                                            <td>
                                                                @foreach(mealsWeek4($clientSubsription->id,$i,$type->id) as $size)
                                                                    @if($type->id == $size->meal->type_id)
                                                                        <li style="list style:none">

                                                                            {{$size->name}}
                                                                        </li>
                                                                    @endif
                                                                @endforeach
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
{{--                                        <p class="text-right"><b>الخصم:</b> {{$clientSubsription->discount}}%</p>--}}
                                        <p class="text-right"><b>الضريبة:</b>  {{ getsetting('tax') }}%- <b>قيمتها:</b>  {{ (getsetting('tax')*$clientSubsription->subscription->price)/100 }}</p>
                                        <p class="text-right"><b>إجمالى الفاتورة:</b>{{round($clientSubsription->total,3)}}</p>

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
