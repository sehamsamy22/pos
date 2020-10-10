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
        <label class="form-label"> اسم الصنف باللغة العربية</label>
        <div class="form-line">
            {!! Form::text("ar_name",null,['class'=>'form-control','placeholder'=>'اسم الصنف','data-parsley-required-message'=>'من فضلك ادخل الصنف  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> اسم الصنف باللغة الانجليزية</label>
        <div class="form-line">
            {!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>'اسم الصنف','data-parsley-required-message'=>'من فضلك ادخل الصنف  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> الوحدة</label>
        <div class="form-line">
            {!! Form::text("unit",null,['class'=>'form-control','placeholder'=>' وحدةالصنف','data-parsley-required-message'=>'من فضلك ادخل الوحدة  ','required'=>''])!!}
        </div>
    </div>
</div>



<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

