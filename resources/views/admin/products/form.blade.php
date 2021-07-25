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
        <label class="form-label"> اسم الوجبة باللغة العربية</label>
        <div class="form-line">
            {!! Form::text("ar_name",null,['class'=>'form-control','placeholder'=>'اسم الوجبة','data-parsley-required-message'=>'من فضلك ادخل المنتج  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> اسم الوجبة باللغة الانجليزية</label>
        <div class="form-line">
            {!! Form::text("en_name",null,['class'=>'form-control','placeholder'=>'اسم الوجبة','data-parsley-required-message'=>'من فضلك ادخل الصنف  ','required'=>''])!!}
        </div>
    </div>
</div>



<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> السعرات الحرارية بالوجبة</label>
        <div class="form-line">
            {!! Form::text("calories",null,['class'=>'form-control',])!!}
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


@if(isset($meal))
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
@if(isset($meal))
<div class="col-sm-6 col-xs-6  pull-left subcategories">
    <div class="form-group form-float">
        <label class="form-label">   التصنيف الفرعى</label>
        <div class="form-line">
            <select name="sub_category_id" class="form-control js-example-basic-single" >
                <option value="{{$meal->sub_category_id}}">{{$meal->subcategory->name}}</option>
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
            {!! Form::text("barcode",null,['class'=>'form-control',])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">  تفاصيل الوجبة</label>
        <div class="form-line">
            {!! Form::textarea("description",null,['class'=>'form-control','placeholder'=>'تفاصيل الوجبة'])!!}
        </div>
    </div>
</div>

<div class="col-sm-3 col-xs-3  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> صورة الوجبة </label>
        <div class="form-line">
            {!! Form::file("image",null,['class'=>'form-control','placeholder'=>'  صورة الوجبة',])!!}
        </div>
    </div>
</div>
@if( isset($meal))
    <div class="col-sm-3 col-xs-3 pull-left">
        <div class="form-group form-float">
            <label>صوره الوجبة  : </label>
            <img src="{{getimg($meal->image)}}" style="width:100px; height:100px">
        </div>
    </div>
@endif
<div class="clearfix"></div>
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">  اسم الحجم </label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control ','placeholder'=>'  اسم الحجم','data-parsley-required-message'=>'من فضلك ادخل اسم الحجم  ','required'=>''])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> سعر الحجم</label>
        <div class="form-line">
            {!! Form::text("size_price",null,['class'=>'form-control ','placeholder'=>' سعر الحجم','data-parsley-required-message'=>'من فضلك ادخل سعرالوجبة  ','required'=>'','id'=>'demo1'])!!}
        </div>
    </div>
</div>


{{--<!-- Modal -->--}}
{{--<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">--}}
{{--    <div class="modal-dialog" role="document">--}}
{{--        <div class="modal-content">--}}
{{--            <div class="modal-header">--}}
{{--                <h5 class="modal-title" id="">مكونات الوجبة </h5>--}}
{{--                <button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
{{--                    <span aria-hidden="true">&times;</span>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--            <div class="modal-body">--}}
{{--                <label> اسم المكون</label>--}}
{{--                <span class="required--in">*</span>--}}
{{--                {!! Form::select("product_id",$products,null,['class'=>'form-control js-example-basic-single','id'=>'component_name'])!!}--}}

{{--                <select class="form-control js-example-basic-single"--}}
{{--                        id="component_name"--}}
{{--                        data-parsley-trigger="select"--}}
{{--                        name="product_id[]"--}}
{{--                        data-parsley-required-message="ادخل اسم الصنف">--}}
{{--                    <option value="" selected disabled>اختر الصنف</option>--}}
{{--                    @foreach ($products  as $product)--}}
{{--                        <option  data-price="{{$product->price}}" id="component_name" data-unit="{{$product->units->name ??''}}"  data-avgcost="{{$product->avg_cost}}" value="{{$product->id}}">{{$product->ar_name}}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}
{{--                <label>الوحدة</label>--}}
{{--                <input type="text" class="form-control" id="unit" disabled>--}}

{{--                <label> الكمية</label>--}}
{{--                <span class="required--in">*</span>--}}
{{--                <input type="text" class="form-control" id="component_quantity">--}}
{{--                <label> الوحدة </label>--}}
{{--                <span class="required--in">*</span>--}}
{{--                {!! Form::select("unit",['kilo'=>'كيلو','gram'=>'جرام','liter'=>'لتر'],null,['class'=>'form-control js-example-basic-single','id'=>'main_unit'])!!}--}}

{{--            </div>--}}

{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}

<div class="form-group  col-sm-12">
    <button class="btn btn-primary waves-effect col-sm-12" type="submit">حفظ</button>
</div>

