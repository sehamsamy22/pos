@extends('admin.layout.master')
@section('title','تعديل  الوحدة')

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
                <a href="{{route('dashboard.units.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لإدارة المستخدمين<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">تعديل  الوحدة</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات الوحدة: {{$unit->name}}</h4>

                <div class="row">

                    {!!Form::model($unit , ['route' => ['dashboard.units.update' ,  $unit->id] , 'method' => 'PATCH' ,'files'=>true]) !!}
                    @include('admin.units.form')
                    {!!Form::close() !!}

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')





@endsection
