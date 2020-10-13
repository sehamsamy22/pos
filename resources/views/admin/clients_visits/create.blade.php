@extends('admin.layout.master')
@section('title','  اضافة زيارة جديدة جديد')

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
                <a href="{{route('dashboard.clients_visits.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" > رجوع لإدارة الزيارات<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title"> تسجيل  زيارة جديد</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 m-b-30">بيانات  الزياره</h4>

                <div class="row">



                    {!!Form::open( ['route' => 'dashboard.clients_visits.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">   اسم العميل</label>
                            <div class="form-line">
                                {!! Form::select("client_id",$clients,null,['class'=>'form-control js-example-basic-single','placeholder'=>'اختر   اسم العميل '])!!}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">   تاريخ الزياره</label>
                            <div class="form-line">
                                <input type="date" class="form-control" name="date" id="date">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" data-measurements="{{$measurements}}">
                    @foreach($measurements as $measurement)
                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label"> {{$measurement->name}}</label>
                            <div class="form-line">
                                <input type="text" class="form-control"  name="measurement[{{$measurement->id}}]" id="{{$measurement->id}}"  value="">
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect" type="submit"  >حفظ</button>
                    </div>

                    {!!Form::close() !!}





                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')

    @include('admin.layout.form_validation_js')

@endsection
