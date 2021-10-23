@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> اسم المنتج باللغة العربية</label>
        <div class="form-line">
            {!! Form::text("ar_name",null,['class'=>'form-control','placeholder'=>'اسم المنتج','data-parsley-required-message'=>'من فضلك ادخل المنتج  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> اسم المنتج باللغة الانجليزية</label>
        <div class="form-line">
            {!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>'اسم المنتج','data-parsley-required-message'=>'من فضلك ادخل الصنف  ','required'=>''])!!}
        </div>
    </div>
</div>




{{--  <div class="col-sm-6 col-xs-6  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> الحالة</label>
        <div class="form-line">
            {!! Form::select("status",['1'=>'متاح','0'=>'لا'],null,['class'=>'form-control js-example-basic-single','required','placeholder'=>'اختر حالة الوجبة ',])!!}
        </div>
    </div>
</div>  --}}
{{--<div class="col-sm-6 col-xs-6  pull-left">--}}
{{--    <div class="form-group form-float">--}}
{{--        <label class="form-label">    نوع الوجبة</label>--}}
{{--        <div class="form-line">--}}
{{--            {!! Form::select("type_id",$types,null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر  نوع الوجبة  ','id'=>'type_id'])!!}--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="clearfix"></div>
{{--<div class="col-sm-12 col-xs-12  pull-right">--}}
{{--    <div class="form-group form-float">--}}
{{--        <label class="form-label"> الوحدة</label>--}}
{{--        <div class="form-line">--}}
{{--            {!! Form::select("unit_id",$units,null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر  الوحدة  ','id'=>'unit_id'])!!}--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}


@if(isset($product))
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">   التصنيف الرئيسى</label>
        <div class="form-line">
            {!! Form::select("category_id",$categories,$categoryId,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر التصنيف الرئيسى  ','id'=>'category_id'])!!}

        </div>
    </div>
</div>
@else

    <div class="col-sm-6 col-xs-6  pull-left">
        <div class="form-group form-float">
            <label class="form-label">   التصنيف الرئيسى</label>
            <div class="form-line">
                {!! Form::select("category_id",$categories,null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر التصنيف الرئيسى  ','id'=>'category_id'])!!}

            </div>
        </div>
    </div>
 @endif
@if(isset($product))
<div class="col-sm-6 col-xs-6  pull-left subcategories">
    <div class="form-group form-float">
        <label class="form-label">   التصنيف الفرعى</label>
        <div class="form-line">
            <select name="sub_category_id" class="form-control js-example-basic-single" >
                <option value="{{$product->sub_category_id}}">{{$product->subcategory->name}}</option>
            </select>
        </div>
    </div>
</div>
@else
    <div class="col-sm-6 col-xs-6  pull-left subcategories">
        <div class="form-group form-float">
            <label class="form-label">   التصنيف الفرعى</label>
            <div class="form-line">
                {!! Form::select("sub_category_id",[],null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر التصنيف الرئيسى أولا  '])!!}
            </div>
        </div>
    </div>
@endif
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">قيمة الخصم</label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">(إن وجد) </span>
        <div class="form-line">
            {!! Form::text("discount",null,['class'=>'form-control'])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> نسبة الضريبة</label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">(إن وجد)</span>
        <div class="form-line">
            {!! Form::text("tax",null,['class'=>'form-control'])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">  الباركود</label>
        <div class="form-line">
            <?php  $rand=rand(1000,10000); ?>
            {!! Form::text("barcode",isset($product)?$product->barcode:$rand,['class'=>'form-control',])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">  تفاصيل المنتج</label>
        <div class="form-line">
            {!! Form::textarea("description",null,['class'=>'form-control','placeholder'=>'تفاصيل المنتج'])!!}
        </div>
    </div>
</div>

<div class="col-sm-3 col-xs-3  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> صورة المنتج </label>
        <div class="form-line">
            {!! Form::file("image",null,['class'=>'form-control','placeholder'=>'  صورة المنتج',])!!}
        </div>
    </div>
</div>
@if( isset($product))
    <div class="col-sm-3 col-xs-3 pull-left">
        <div class="form-group form-float">
            <label>صوره المنتج  : </label>
            <img src="{{getimg($product->image)}}" style="width:100px; height:100px">
        </div>
    </div>
@endif


<div class="form-group  col-sm-12">
    <button class="btn btn-primary waves-effect col-sm-12" type="submit">حفظ</button>
</div>

