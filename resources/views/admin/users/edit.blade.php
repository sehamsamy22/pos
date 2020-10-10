@extends('admin.layout.master')
@section('title','تعديل المستخدم')

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
                <a href="{{route('dashboard.users.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لإدارة المستخدمين<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">تعديل المستخدم</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات المستخدم: {{$user->name}}</h4>

                <div class="row">

                    {!!Form::model($user , ['route' => ['dashboard.users.update' ,  $user->id] , 'method' => 'PATCH' ,'files'=>true]) !!}
                    @include('admin.users.form')
                    {!!Form::close() !!}


                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')





@endsection
