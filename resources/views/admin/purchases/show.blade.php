@extends('admin.layout.master')
@section('title',' عرض فاتورة المشتريات')

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
            <h4 class="page-title"> فاتورة المشتريات</h4>
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
                                        <h4>رقم الفاتورة# <br>
                                            <strong>2016-04-23654789</strong>
                                        </h4>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-12">

{{--                                        <div class="pull-right m-t-30">--}}
{{--                                            <address>--}}
{{--                                                <strong>{{getsetting('address')}}</strong><br>--}}

{{--                                                <abbr title="Phone">P:</abbr> {{getsetting('phone')}}--}}
{{--                                            </address>--}}
{{--                                        </div>--}}
                                        <div class="pull-left m-t-30">
                                            <p><strong>تاريخ الفاتوره: </strong> {{$purchase->date}}</p>
                                            <p class="m-t-10"><strong>اسم المورد: </strong> {{$purchase->supplier->name}}</p>
                                            <p class="m-t-10"><strong>حالة الفاتوره: </strong> <span class="label label-pink">Pending</span></p>
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
                                                <tr><th>#</th>
                                                    <th>اسم الصنف</th>
                                                    <th>الوحدة</th>
                                                    <th>الكمية</th>
                                                    <th>السعر </th>
                                                    <th>الخصم</th>
                                                    <th>الضريبه</th>
                                                    <th>اجمالى</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @php $i = 1; @endphp
                                                @foreach($items as $row)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$row->product->ar_name}}</td>
                                                    <td>@if($row->product->unit=='kilo')
                                                            كيلو
                                                        @elseif($row->product->unit=='gram')
                                                            جرام
                                                        @else
                                                            لتر
                                                        @endif
                                                    </td>
                                                    <td> {{$row->quantity}}</td>
                                                    <td> {{$row->product->price}}</td>

                                                    <td> {{$row->discount}}</td>
                                                    <td> {{$row->tax}}</td>
                                                    <td> {{$row->total_price - $row->discount +$row->tax}}</td>
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
                                        <p class="text-right"><b>إجمالى الفاتورة:</b>{{$purchase->amount}}</p>
                                        <p class="text-right"><b>الخصم:</b> {{$purchase->discount}}%</p>
                                        <p class="text-right"><b>الضريبة:</b>  {{$purchase->tax}}%</p>
                                        <hr>
                                        <h3 class="text-right">{{$purchase->total}}</h3>
                                    </div>
                                </div>
                                <hr>
                                <div class="hidden-print">
                                    <div class="pull-right">
                                        <a href="javascript:window.print()" class="btn btn-inverse waves-effect waves-light"><i class="fa fa-print"></i></a>
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

@endsection
