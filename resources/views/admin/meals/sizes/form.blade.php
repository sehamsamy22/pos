@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<input type="hidden" name="meal_id" value="{{$meal->id}}">
<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> اسم الحجم</label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>' اسم الحجم ','data-parsley-required-message'=>'من فضلك ادخل  اسم الحجم  ','required'=>''])!!}
        </div>
    </div>
</div>
<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> سعر الحجم</label>
        <div class="form-line">
            {!! Form::text("size_price",null,['class'=>'form-control','placeholder'=>'سعر الحجم ','data-parsley-required-message'=>'من فضلك ادخل سعرالحجم  ','required'=>''])!!}
        </div>
    </div>
</div>

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
                        <option  data-price="{{$product->price}}" id="component_name" data-unit="{{$product->units->name ??''}}"  data-avgcost="{{$product->avg_cost}}" value="{{$product->id}}">{{$product->ar_name}}</option>
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
            <th>متوسط التكلفة </th>
            <th>العمليات</th>
        </tr>
        </thead>
        <tbody class="add-components">

        @if (isset($size))
            @foreach($size->products as $product)
                <tr  id="single-product{{$product->id}}" >
                    <input type="hidden" name="old_product[]" value={{ $product->product->id }}>
                    <input type="hidden" name="old_product_quantity[]" value={{ $product->quantity }}>



                    <td class="component-name">{{$product->product->ar_name}}</td>
                    <td class="component-qty"> {{$product->quantity}}</td>
                    <td class="component-unit">

                        {{$product->product->units->name ??''}}
                    </td>
                    <td class="component-avgcost"> {{$product->avg_cost ??'0'}}</td>

                    <td>

                        <a href="#"  onclick="Delete({{$product->id}})" data-toggle="tooltip" data-id="{{$product->id}}" id='delete-form'{{$product->id}}, class="delete-this-row-component" id="" data-original-title="حذف">
                            <i class="fa fa-trash-o" style="margin-left: 10px"></i>

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
                @if(isset($size)){{round($size->size_price,3)}} @endif
                <input type="hidden" name="approx_price" id="total" @if(isset($size)) value="{{round($size->size_price,3)}}" @endif>
            </td>

            <td> </td>

        </tr>
        </tfoot>
    </table>
</div>
<!-- end table-->
<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

