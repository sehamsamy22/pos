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
            {!! Form::select("unit",['kilo'=>'كيلو','gram'=>'جرام','liter'=>'لتر'],null,['class'=>'form-control','placeholder'=>' وحدةالصنف','data-parsley-required-message'=>'من فضلك ادخل الوحدة  ','required'=>''])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> السعرات الحرارية بالمنتج</label>
        <div class="form-line">
            {!! Form::number("calories",null,['class'=>'form-control','data-parsley-required-message'=>'من فضلك ادخل السعرات الحرارية  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">   سعر الصنف</label>
        <div class="form-line">
            {!! Form::number("price",null,['class'=>'form-control','data-parsley-required-message'=>'من فضلك ادخل سعر الصنف  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> صورة الصنف </label>
        <div class="form-line">
            {!! Form::file("image",null,['class'=>'form-control','placeholder'=>'  صورة الصنف','data-parsley-required-message'=>'من فضلك ادخل الصوره  ','required'=>''])!!}
        </div>
    </div>
</div>
@if( isset($product))
    <div class="col-sm-6 col-xs-6  pull-left">
        <div class="form-group form-float">
            <label>صوره الصنف  : </label>
            <img src="{{getimg($product->image)}}" style="width:100px; height:100px">
        </div>
    </div>
@endif
<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

