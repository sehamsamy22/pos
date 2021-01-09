@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> اسم المستخدم</label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  اسم المستخدم'])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">الإيميل</label>
        {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'الايميل ','data-parsley-type'=>"email",'data-parsley-type-message'=>'من  فضللك ادخل الايميل  بشكل  صحيح','required'=>''])!!}
        <div class="form-line">
        </div>
    </div>
</div>


<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">الباسورد</label>
        {!! Form::input('password','password',null,['class'=>'form-control']) !!}

        <div class="form-line">
        </div>
    </div>
</div>

{{--@if( isset($user))--}}
{{--<div class="col-sm-12 col-xs-12  pull-right">--}}
{{--    <div class="form-group form-float">--}}
{{--        <label class="form-label">الباسورد</label>--}}
{{--        {!! Form::input('password','old_password',null,['class'=>'form-control']) !!}--}}

{{--        <div class="form-line">--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endif--}}


<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">  الجوال</label>
        <div class="form-line">
            {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'الجوال'])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">  الكود</label>
        <div class="form-line">
            {!! Form::text("code",null,['class'=>'form-control','placeholder'=>' الكود','data-parsley-required-message'=>'من فضلك  ادخل الكود','required'=>''])!!}
        </div>
    </div>
</div>
<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">  العنوان</label>
        <div class="form-line">
            {!! Form::text("address",null,['class'=>'form-control','placeholder'=>'العنوان ','data-parsley-required-message'=>'من فضلك  العنوان','required'=>''])!!}
        </div>
    </div>
</div>

{{--<div class="col-sm-12 col-xs-12  pull-right">--}}
{{--    <div class="form-group form-float">--}}
{{--        <label class="form-label">  الصلاحية</label>--}}
{{--        <div class="form-line">--}}
{{--            {!! Form::select("role",['admin'=>'','storekeeper'=>'مسئول المخزن','cooker'=>'طباخ','operations_manager'=>'مسئول تشغيل',--}}
{{--            'driver_manager'=>'مسئول السائقين','driver'=>'سائق',],null,['class'=>'form-control','placeholder'=>'الصلاحية ','data-parsley-required-message'=>'من فضلك  الصلاحية','required'=>'','id'=>'role'])!!}--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">  المنطقة</label>
        <div class="form-line">
            {!! Form::select("area_id",$areas,null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر  المنطقة  ','id'=>'area_id'])!!}

        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">  الصلاحية</label>
        <div class="form-line">
            {!! Form::select("role_id",$roles,null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر الصلاحية  ','id'=>'role_id'])!!}

        </div>
    </div>
</div>


<div class="col-sm-12 col-xs-12  pull-right">
<div class="form-group form-float">
    <label class="form-label"> صورة المستخدم</label>
    <div class="form-line">
        {!! Form::file("image",null,['class'=>'form-control','placeholder'=>'  صورة المستخدم'])!!}
    </div>
</div>
</div>

@if( isset($user))
    <div class="col-sm-12 col-xs-12  pull-right">
        <div class="form-group form-float">
            <label>صوره المستخدم  : </label>
            <img src="{{getimg($user->image)}}" style="width:100px; height:100px">
        </div>
    </div>
@endif
<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

