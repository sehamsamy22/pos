@extends('admin.layout.master')
@section('title',$settings_page)

@section('styles')
    <link href="{{asset('admin/assets/plugins/switchery/switchery.min.css')}}" rel="stylesheet" />
@endsection
@section('content')
    <form action="{{route('dashboard.settings.store')}}" data-parsley-validate="" novalidate="" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}

            <!-- Page-Title -->
                <div class="row">
                    <div class="col-lg-8 col-lg-offset-2">
                        <div class="btn-group pull-right m-t-15">
                            <a href="{{route('dashboard.index')}}" class="btn btn-custom  waves-effect waves-light"
                            >رجوع<span class="m-l-5"><i
                                        class="fa fa-reply"></i></span>
                            </a>

                        </div>
                        <h4 class="page-title">التحكم ب {{$settings_page}}</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-sm-12">

                    <div class="card-box">


                        {!!Form::open( ['route' => 'dashboard.settings.store' , 'method' => 'Post','files'=>true]) !!}

                        <div class="card">

                            <div class="header">

                                <h5 class="panel-title">التحكم ب {{$settings_page}}</h5>


                            </div>

                            <div class="body">

                                @foreach($settings as $setting)

                                    @if($setting->type == 'text')

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="form-line">
                                                <label> {{$setting->title}}  </label>
                                                {!! Form::text($setting->name.'[]',$setting->value,['class'=>'form-control'])!!}
                                            </div>
                                        </div>


                                        <div class="clearfix"></div>

                                        <br>

                                    @elseif($setting->type=='textarea')

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="form-line">
                                                <label> {{$setting->title}}  </label>

                                                {!! Form::textarea($setting->name.'[]',$setting->value,['class'=>'form-control editor'])!!}
                                            </div>

                                        </div>

                                        ​


                                        <div class="clearfix"></div>

                                        <br>
                                    @elseif($setting->type == 'value')

                                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                            <div class="form-line">
                                                <label> {{$setting->title}}</label>
                                                {!! Form::text($setting->name.'[]',$setting->value,['class'=>'form-control'])!!}
                                            </div>
                                        </div>


                                        <div class="clearfix"></div>

                                        <br>

                                    @elseif($setting->type == 'url')
                                        <div class="col-sm-12 col-xs-12">
                                            <div class="form-group">
                                                <label for="userName">{{$setting->title}}</label>
                                                <input type="text" name="{{$setting->name}}[]" value="{{$setting->value}}" class="form-control"
                                                       {{--oninput="this.value = Math.abs(this.value)"--}}
                                                       required/>
                                                <p class="help-block"></p>
                                            </div>
                                        </div>



                                        @elseif($setting->type == 'image')
                                            <div class="col-sm-12 col-xs-12">
                                                <div class="form-group">
                                                    <label for="userName">{{$setting->title}}</label>
                                                    {{--                                                    <label for="userName">{{$setting->title}}</label>--}}
                                                    <input type="file" name="{{$setting->name}}[]" value="{{$setting->value}}" class="form-control"
                                                           {{--oninput="this.value = Math.abs(this.value)"--}}
                                                           />
                                                </div>
                                            </div>


                                            <div class="col-sm-12 col-xs-12  pull-right">
                                                <div class="form-group form-float">
                                                    <label>صوره  الشعار : </label>
                                                    <img src="{{getimg($setting->value)}}" style="width:100px; height:100px">
                                                </div>
                                            </div>
                                            @elseif($setting->type == 'select')

                                            <div class="form-group col-xs-6  {{$setting->name}} ">
                                                <label> {{$setting->title}} </label>
                                                <div class="form-group col-md-6 pull-right">
                                                    {!! Form::select($setting->name.'[]',chart_accounts(),$setting->value,['class'=>'form-control'])!!}
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
      </div>

@endsection


@section('scripts')


                            {!! Html::script('/admin/ckeditor/ckeditor.js') !!}

                            <script>

                                $(document).ready(function () {

                                    CKEDITOR.replaceClass = 'editor';

                                });

                            </script>



@endsection
