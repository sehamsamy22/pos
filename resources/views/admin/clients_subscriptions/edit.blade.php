@extends('admin.layout.master')
@section('title','تعديل  الاشتراك')

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
                <a href="{{route('dashboard.subscriptions.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لإدارة الاشتراكات<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">تعديل  الاشتراك</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات الاشتراك: </h4>

                <div class="row">

                    {!!Form::model($clientSubsription, ['route' => ['dashboard.clients_subscriptions.update' ,$clientSubsription->id],'method' => 'PATCH' ,'files'=>true]) !!}

                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">   اسم العميل</label>
                            <div class="form-line">
                              <input type="text" value="{{$clientSubsription->client->name}}" class="form-control" name="client_id" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">  نوع الاشتراك</label>
                            <div class="form-line">
                                {{--            {!! Form::select("subscription_id",$subscriptions,null,['class'=>'form-control ','placeholder'=>'اختر نوع الاشتراك' ,'id'=>'subscription_id'])!!}--}}
                               <input type="text" value="{{$clientSubsription->subscription->name}}" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6 pull-right">
                        <div class="form-group form-float">
                            <label class="form-label">  نهاية الاشتراك</label>
                            <div class="form-line">
                                <input type="text" name="end" class="form-control" id="date_end" value="{{$clientSubsription->end}}" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">  بداية الاشتراك</label>
                            <div class="form-line">
                                <input type="date" class="form-control" name="start" id="start_date" value={{$clientSubsription->start}}>
                            </div>
                        </div>
                    </div>



                    <table id="basic" class="table table-striped table-bordered" >
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
                        <tbody class="table_meals">
                        @foreach($types as $key => $type)

                            <tr>
                                <td>{{ $type->name }}</td>
                                @for($i=1;$i<=7;$i++)
                                    <td  >

                                        <div class="{{$i}}" style="display: inline-block;">

                                            @foreach($type->meals_sub($clientSubsription->subscription_id) as  $key=>$meal)
                                                @foreach($dietsystems as $dietsystem)
                                                    @if ($dietsystem->meal_id==$meal->id  && $dietsystem->day_No==$i)

                                                        {{$meal->ar_name}}


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
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-danger waves-effect" type="submit">حفظ</button>
                    </div>
                    {!!Form::close() !!}

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')
    <script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>
<script>
    $("#start_date").on('change', function() {
    var duration=<?php echo $clientSubsription->subscription->duration; ?>;
    var selectedoption = $(this).find(":selected");
    var start_date = $('#start_date').val();
    var sub_id = $('#subscription_id').val();
    // var duration=selectedoption.data('num');
    document.getElementById('date_end').value =dayjs(start_date).add(duration, 'days').format('MM/DD/YYYY');
    console.log(dayjs(start_date).add(duration,'days').format('YYYY-MM-DD'));
    });
    </script>


@endsection
