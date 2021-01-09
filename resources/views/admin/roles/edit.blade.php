@extends('admin.layout.master')
@section('title','تعديل  الصلاحية')

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
                <a href="{{route('dashboard.roles.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لإدارة الصلاحيات<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">تعديل  الصلاحية</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات الصلاحية: {{$role->name}}</h4>

                <div class="row">
                    {!!Form::model($role , ['route' => ['dashboard.roles.update' ,  $role->id] , 'method' => 'PATCH' ,'files'=>true]) !!}
                    <div class="form-group ">
                        <label class="form-label">اسم المنصب</label>
                        <div class="form-line">
                            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  الاسم  '])!!}
                        </div>
                    </div>

                    <div class="form-group ">
                        <label class="form-label">الصلاحيات</label>
                        @foreach($permission as $value)
                        <div class="demo-checkbox col-sm-6 col-xs-6">

                                {{ Form::checkbox('permission[]', $value->name, in_array($value->id, $rolePermissions) ? true : false, array('class' => 'filled-in chk-col-teal','id'=> $value->name )) }}
                                <label for="{{ $value->name }}">{{ $value->ar_name }}</label>

                        </div>
                        @endforeach
                    </div>

                    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>


                    {!!Form::close() !!}
                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')

@endsection
