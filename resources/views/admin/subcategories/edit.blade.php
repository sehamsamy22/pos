@extends('admin.layout.master')
@section('title','تعديل التصنيف الفرعى')

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
                <a href="{{route('dashboard.subcategories.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لإدارة التصنيفات الفرعية<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">تعديل التصنيف الفرعى</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات التصنيف: {{$subcategory->name}}</h4>

                <div class="row">

                    {!!Form::model($subcategory , ['route' => ['dashboard.subcategories.update', $subcategory->id] , 'method' => 'PATCH' ,'files'=>true]) !!}
                    @include('admin.subcategories.form')
                    {!!Form::close() !!}

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')





@endsection
