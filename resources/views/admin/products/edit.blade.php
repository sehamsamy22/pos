@extends('admin.layout.master')
@section('title','تعديل  الصنف')

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
                <a href="{{route('dashboard.products.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لإدارة الاصناف والمواد الخام<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">تعديل  الصنف</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات الصنف: {{$product->ar_name}}</h4>

                <div class="row">

                    {!!Form::model($product, ['route' => ['dashboard.products.update' ,  $product->id] , 'method' => 'PATCH' ,'files'=>true]) !!}
                    @include('admin.products.form')
                    {!!Form::close() !!}

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')





@endsection
