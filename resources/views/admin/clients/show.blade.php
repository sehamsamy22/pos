@extends('admin.layout.master')
@section('title',' عرض  بيانات  العميل')

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

            <h4 class="page-title">الصفحة الشخصية</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات العميل: {{$client->name}}</h4>

                <div class="row">

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1">  بيانات العميل </a></li>

                    </ul>

                    <div class="tab-content">


                        <div role="tabpanel" id="menu1" class="tab-pane active">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">إسم العميل</label>
                                    <div class="col-md-10">
                                        <input type="text" required value="{{$client->name}}"
                                            name="name" class="form-control" placeholder="إسم العميل" disabled>

                                        @if($errors->has('name'))
                                            <p class="help-block">
                                                {{ $errors->first('name') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">رقم الجوال</label>
                                    <div class="col-md-10">
                                        <input type="text" required value="{{$client->phone}}"
                                            name="phone" class="form-control" placeholder="رقم الجوال" disabled>
                                    </div>
                                </div>
                            </div>





                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">البريد الإلكتروني*</label>
                                    <div class="col-md-10">
                                        <input type="email" required value="{{$client->email}}"
                                            name="email" class="form-control" placeholder="البريد الإلكتروني" disabled>
                                        @if($errors->has('email'))
                                            <p class="help-block">
                                                {{ $errors->first('email') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')


@endsection
