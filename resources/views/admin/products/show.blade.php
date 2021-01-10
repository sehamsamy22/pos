@extends('admin.layout.master')
@section('title','بيانات الصنف')

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
            <h4 class="page-title"> عرض بيانات الصنف</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات الصنف: {{$product->ar_name}}</h4>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label"> اسم المنتج باللغة العربية</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$product->ar_name}}"
                                    name="phone" class="form-control" placeholder="اسم المنتج " disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label"> اسم المنتج باللغة الانجليزية</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$product->en_name}}"
                                    name="phone" class="form-control" placeholder="رقم الجوال" disabled>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label"> كود الصنف</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$product->barcode}}"
                                    name="phone" class="form-control" placeholder="رقم الجوال" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label">الوحدة</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$product->units->name}}"
                                    name="phone" class="form-control" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label"> السعر</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$product->price}}"
                                    name="phone" class="form-control"  disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label"> السعرات الحرارية</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$product->calories}}"
                                    name="phone" class="form-control" placeholder=" السعرات الحرارية" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label">  وحدة الصنف</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$product->units->name??''}}"
                                       name="phone" class="form-control" placeholder="رقم الجوال" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label">  صوره الصنف</label>
                            <div class="col-md-10">
                                @if(isset($product->image))
                                <img src="{{getimg($product->image)}}" style="width:100px; height:100px">

                                @endif

                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
@endsection
