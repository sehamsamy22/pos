@extends('admin.layout.master')
@section('title',$settings_page)

@section('styles')
    <link href="{{asset('admin/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <form action="{{route('admin.settings.store')}}" data-parsley-validate="" novalidate="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <!-- Page-Title -->
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{route('admin.layout.main')}}" class="btn btn-custom  waves-effect waves-light"
                            >رجوع<span class="m-l-5"><i
                                        class="fa fa-reply"></i></span>
                            </a>

                        </div>
                        <h4 class="page-title">التحكم ب {{$settings_page}}</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">


                        {!!Form::open( ['route' => 'admin.settings.store' , 'method' => 'Post','files'=>true]) !!}

                        <div class="card">

                            <div class="header">

                                <h5 class="panel-title">التحكم ب {{$settings_page}}</h5>


                            </div>

                            <div class="body">

                                @foreach($settings as $setting)

                                    @if($setting->type == 'text')

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="form-line">
                                                <label> {{$setting->title}} بالعربي </label>
                                                {!! Form::text($setting->name.'[]',$setting->ar_value,['class'=>'form-control'])!!}
                                            </div>
                                        </div>
                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="form-line">
                                                <label> {{$setting->title}} بالانجليزي </label>

                                                {!! Form::text($setting->name.'[]',$setting->en_value,['class'=>'form-control'])!!}

                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <br>

                                    @elseif($setting->type=='textarea')

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="form-line">
                                                <label> {{$setting->title}} بالعربي </label>

                                                {!! Form::textarea($setting->name.'[]',$setting->ar_value,['class'=>'form-control editor'])!!}
                                            </div>

                                        </div>

                                        ​

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="form-line">
                                                <label> {{$setting->title}} بالانجليزي </label>

                                                {!! Form::textarea($setting->name.'[]',$setting->en_value,['class'=>'form-control editor'])!!}
                                            </div>
                                        </div>

                                        <div class="clearfix"></div>

                                        <br>
                                    @elseif($setting->type == 'value')

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="form-line">
                                                <label> {{$setting->title}}</label>
                                                {!! Form::text($setting->name.'[]',$setting->ar_value,['class'=>'form-control'])!!}
                                            </div>
                                        </div>


                                        <div class="clearfix"></div>

                                        <br>

                                    @elseif($setting->type == 'url')
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="userName">{{$setting->title}}</label>
                                                <input type="text" name="{{$setting->name}}[]" value="{{$setting->ar_value}}" class="form-control"
                                                       {{--oninput="this.value = Math.abs(this.value)"--}}
                                                       required/>
                                                <p class="help-block"></p>
                                            </div>
                                        </div>

                                    @endif

                                @endforeach



                                <div class="text-right">

                                    <button type="submit" class="btn btn-success">حفظ <i

                                                class="icon-arrow-left13 position-right"></i></button>

                                </div>

                                {!!Form::close() !!}

                                ​



                            </div><!-- end col -->
                </div>
                <!-- end row -->


@endsection


@section('scripts')


                            {!! Html::script('/admin/ckeditor/ckeditor.js') !!}

                            <script>

                                $(document).ready(function () {

                                    CKEDITOR.replaceClass = 'editor';

                                });

                            </script>



@endsection
