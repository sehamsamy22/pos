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
        <label class="form-label"> سعر الوجبة</label>
        <div class="form-line">
            {!! Form::number("price",null,['class'=>'form-control ','placeholder'=>' سعر الوجبة','data-parsley-required-message'=>'من فضلك ادخل سعرالوجبة  ','required'=>'','id'=>'demo1'])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> السعرات الحرارية بالوجبة</label>
        <div class="form-line">
            {!! Form::number("calories",null,['class'=>'form-control','data-parsley-required-message'=>'من فضلك ادخل السعرات الحرارية  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> الحالة</label>
        <div class="form-line">
            {!! Form::select("status",['1'=>'متاح','0'=>'لا'],null,['class'=>'form-control js-example-basic-single','required','placeholder'=>'اختر حالة الوجبة ',])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> نوع  الوجبة </label>
        <div class="form-line">
            {!! Form::select("type",['breakfast'=>'الافطار','lunch'=>'الغداء','dinner'=>'العشاء'],null,['class'=>'form-control js-example-basic-single ','required','placeholder'=>'اختر نوع الوجبة ',])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">   التصنيف الرئيسى</label>
        <div class="form-line">
            {!! Form::select("category_id",$categories,null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر التصنيف الرئيسى  ','id'=>'category_id'])!!}

        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left subcategories">
    <div class="form-group form-float">
        <label class="form-label">   التصنيف الفرعى</label>
        <div class="form-line">
            {!! Form::select("sub_category_id",[],null,['class'=>'form-control js-example-basic-single','required','placeholder'=>' اختر التصنيف الرئيسى أولا  '])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">قيمة الخصم</label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">(إن وجد) </span>
        <div class="form-line">
            {!! Form::number("discount",null,['class'=>'form-control','data-parsley-required-message'=>'من فضلك ادخل السعرات الحرارية','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> قيمة الضريبة</label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">(إن وجد)</span>
        <div class="form-line">
            {!! Form::number("tax",null,['class'=>'form-control','data-parsley-required-message'=>'من فضلك ادخل السعرات الحرارية  ','required'=>''])!!}
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
            {!! Form::file("image",null,['class'=>'form-control','placeholder'=>'  صورة الوجبة','data-parsley-required-message'=>'من فضلك ادخل الصوره  ','required'=>''])!!}
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


<div class="component_btn">
    <button class="btn btn-purple waves-effect waves-light m-t-20"  type="button">
        مكونات الوجبة
    </button>
</div>


<div class="m-portlet__body a-smaller-input-wrapper">

    <div class="col-sm-6 col-xs-6  pull-lef">
        <label>اسم الصنف</label>
        <select class="form-control"
                id="product"
                data-parsley-trigger="select"
                data-parsley-required-message="ادخل اسم الصنف">
            <option value="" selected disabled>اختر الصنف</option>
            @foreach ($products  as $product)
                <option data-name="{{$product->ar_name}}" data-price="{{$product->price}}" value="{{$product->id}}">{{$product->ar_name}}</option>
            @endforeach
        </select>

        @if($errors->has('products'))
            <p class="help-block" style="color: #FF0000;">
                {{ $errors->first('products') }}
            </p>
        @endif
    </div>

    <div class="col-sm-6 col-xs-6  pull-lef">
        <label>الكمية</label>
        <input id="qty" type="number" value="{{old('qty')}}"
               data-parsley-trigger="keyup"
               oninput="this.value = Math.abs(this.value)"
               class="form-control m-input" placeholder="ادخل الكمية">
        @if($errors->has('qty'))
            <p class="help-block">
                {{ $errors->first('qty') }}
            </p>
        @endif
    </div>





    <div class="col-md-2">
        <button id="addProduct" class="btn btn-primary waves-effect waves-light m-t-20"  type="button">
            اضافة
        </button>
    </div>


    <div class="table-striped">
        <table id="productsTable" class="table m-0">
            <thead>
            <tr>
                <th> اسم المنتج</th>
                <th> الكمية</th>
                <th>حذف</th>
            </tr>
            </thead>
            <tbody>
            @if (isset($meal))
                @foreach ($meal->products as $product)
                    <tr>
                        <td>{{$product->ar_name}} </td>
                        <td>{{$product->quantity}} </td>

                        <td>
                            <a href="javascript:" id="removeProduct{{$product->id}}" data-id="{{$product->id}}" class="removeProduct btn btn-danger waves-effect waves-light btn-xs m-b-5">حذف</a>

                        </td>

                        <input type="hidden" name="products[]" value="id" />
                    </tr>
                @endforeach


            @endif


            </tbody>
        </table>
    </div>

</div>

<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

