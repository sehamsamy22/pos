@extends('admin.layout.master')
@section('title','إنشاء قيد يدوى جديد')

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
                <a href="{{route('dashboard.entries.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لإدارة   القيود<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">إضافة  قيد يدوى جديد</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 m-b-30">بيانات  القيد اليدوى</h4>

                <div class="row">
                    {!!Form::open( ['route' => 'dashboard.entries.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'entries-forma',]) !!}


                    @include('admin.entries.form')


                    {!!Form::close() !!}





                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')

    @include('admin.layout.form_validation_js')

@endsection
