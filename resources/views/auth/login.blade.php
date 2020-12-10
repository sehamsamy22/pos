@extends('auth.master')


@section('content')


    {{----------------------------------------------------------------}}
    <div class="m-t-40 card-box aligne-center">
        <div class="text-center">
            <img src="{{getimg(getsetting('logo'))}}">
        </div>
        <div class="text-center">
            <h4 class="text-uppercase font-bold m-b-0">تسجيل الدخول</h4>
        </div>
        <div class="panel-body">

            @if(session()->has('loginError'))
                <div class="alert alert-danger alert-dismissable">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong> {{ session()->get('loginError') }}</strong>
                </div>
            @endif

            <form class="form-horizontal m-t-20" action="{{route('login')}}" method="post">
                @csrf
                <div class="form-group ">
                    <div class="col-xs-12">
                        <input type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"  name="email" value="{{ old('email') }}"  placeholder="Email" required autofocus>


                    </div>
                </div>

                <div class="form-group">
                    <div class="col-xs-12">
                        <input name="password"
                               class="form-control"
                               type="password"
                               autocomplete="off"
                               data-parsley-required
                               data-parsley-required-message="هذا الحقل مطلوب"
                               placeholder="كلمة المرور">

                        @if ($errors->has('password'))
                            <span class="help-block error_validation" style=" font-size: 13px;color: #ff5757;">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                {{--<div class="form-group ">--}}
                {{--<div class="col-xs-12">--}}
                {{--<div class="checkbox checkbox-custom">--}}
                {{--<input id="checkbox-signup" type="checkbox">--}}
                {{--<label for="checkbox-signup">--}}
                {{--</label>--}}
                {{--</div>--}}

                {{--</div>--}}
                {{--</div>--}}              {{--تذكرني--}}


                <div class="form-group text-center m-t-30">
                    <div class="col-xs-12">
                        <button class="btn btn-custom btn-bordred btn-block waves-effect waves-light" type="submit">دخول</button>
                    </div>
                </div>

                <div class="form-group m-t-30 m-b-0">
                    <div class="col-sm-12">
                        {{--<a href="{{route('administrator.password.request')}}" class="text-muted"><i class="fa fa-lock m-r-5"></i>نسيت كلمة المرور</a>--}}
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- end card-box-->
    {{--------------------------------      --------------------------------}}



@endsection
