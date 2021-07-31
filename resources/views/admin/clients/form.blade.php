@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

{{--  <div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label"> الكود</label>
        <div class="form-line">
            {!! Form::text("code",null,['class'=>'form-control','placeholder'=>'الكود','data-parsley-required-message'=>'من فضلك ادخل الكود  ','required'=>''])!!}
        </div>
    </div>
</div>  --}}

<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label"> اسم  العميل </label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'   اسم  العميل','data-parsley-required-message'=>'من فضلك ادخل اسم العميل  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">الإيميل</label>
        {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'الايميل ','data-parsley-type'=>"email",'data-parsley-type-message'=>'من  فضللك ادخل الايميل  بشكل  صحيح','required'=>''])!!}
        <div class="form-line">
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  الجوال</label>
        <div class="form-line">
            {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'الجوال','data-parsley-type-message'=>'من  فضللك ادخل الجوال','required'=>''])!!}
        </div>
    </div>
</div>

{{--<div class="col-sm-6 col-xs-6 pull-left">--}}
{{--    <div class="form-group form-float">--}}
{{--        <label class="form-label">  العنوان</label>--}}
{{--        <div class="form-line">--}}
{{--            {!! Form::text("address",null,['class'=>'form-control','placeholder'=>'العنوان'])!!}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--<div class="col-sm-6 col-xs-6 pull-left">--}}
{{--    <div class="form-group form-float">--}}
{{--        <label class="form-label">  النوع</label>--}}
{{--        <div class="form-line">--}}
{{--            {!! Form::text("type",['male'=>'ذكر','female'=>],null,['class'=>'form-control','placeholder'=>'النوع'])!!}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">  المنطقة</label>
        <div class="form-line">
            {!! Form::select("area_id",$areas,null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر  المنطقة  ','id'=>'area_id'])!!}

        </div>
    </div>
</div>
<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

