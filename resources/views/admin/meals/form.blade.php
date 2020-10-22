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
            {!! Form::number("discount",null,['class'=>'form-control','data-parsley-required-message'=>'من فضلك ادخل السعرات الحرارية','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> نسبة الضريبة</label><span style="color: #ff0000; margin-right: 15px;" class="sm-span">(إن وجد)</span>
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
<div class="clearfix"></div>


<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    إضافه صنف
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">مكونات الوجبة </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label> اسم المكون</label>
                <span class="required--in">*</span>
{{--                {!! Form::select("product_id",$products,null,['class'=>'form-control js-example-basic-single','id'=>'component_name'])!!}--}}
                <select class="form-control js-example-basic-single"
                        id="component_name"
                        data-parsley-trigger="select"
                        name="product_id[]"
                        data-parsley-required-message="ادخل اسم الصنف">
                    <option value="" selected disabled>اختر الصنف</option>
                    @foreach ($products  as $product)
                        <option  data-price="{{$product->price}}" id="component_name" data-unit="{{$product->unit}}" value="{{$product->id}}">{{$product->ar_name}}</option>
                    @endforeach
                </select>
                <label>الوحدة</label>
                <input type="text" class="form-control" id="unit" disabled>

                <label> الكمية</label>
                <span class="required--in">*</span>
                <input type="text" class="form-control" id="component_quantity">
{{--                <label> الوحدة </label>--}}
{{--                <span class="required--in">*</span>--}}
{{--                {!! Form::select("unit",['kilo'=>'كيلو','gram'=>'جرام','liter'=>'لتر'],null,['class'=>'form-control js-example-basic-single','id'=>'main_unit'])!!}--}}

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="myFun2(event)">اضافة </button>
            </div>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<!-- component table-->
<div class="table-striped" id="componentTable-wrap">
    <table class="table table-striped table-bordered" >
        <thead>
        <tr>
            <th> اسم الصنف</th>
            <th>الكمية</th>
            <th>الوحدة </th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody class="add-components">
        @if (isset($meal))
            @foreach($meal->products as $product)
                    <tr  id="single-product{{$product->id}}" >
                        <td class="component-name">{{$product->product->ar_name}}</td>
                        <td class="component-qty"> {{$product->quantity}}</td>
                        <td class="component-unit">
                            @if($product->product->unit=='kilo')
                                كيلو
                            @elseif($product->product->unit=='gram')
                            جرام
                            @else
                                لتر
                            @endif
                        </td>
                        <td>

                            <a href="#"  onclick="Delete({{$product->id}})" data-toggle="tooltip" data-id="{{$product->id}}" id='delete-form'{{$product->id}}, class="delete-this-row-component" id="" data-original-title="حذف">
                                <i class="fa fa-trash-o" style="margin-left: 10px"></i>
{{--                                {!!Form::open( ['route' => ['dashboard.meals-products.destroy',$product->id] ,'id'=>'delete-form'.$product->id, 'method' => 'Delete']) !!}--}}
{{--                                {!!Form::close() !!}--}}
                            </a>
                        </td>
                    </tr>


            @endforeach
        @endif


        </tbody>
        <tfoot>
        <tr style="background-color: #aec9dc;">
            <td colspan="2"></td>
            <td><span style="    font-size: large;">السعر التقريبى</span>  </td>
            <td class="Approx_price">
                @if(isset($meal)){{$meal->approx_price}} @endif
            <input type="hidden" name="approx_price" id="total" @if(isset($meal)) value="{{$meal->approx_price}}" @endif>
            </td>
        </tr>
        </tfoot>
    </table>
</div>
<!-- end table-->

<div class="form-group  col-sm-12">
    <button class="btn btn-primary waves-effect col-sm-12" type="submit">حفظ</button>
</div>

