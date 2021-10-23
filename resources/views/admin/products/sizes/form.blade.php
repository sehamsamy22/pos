@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
{{--@dd($product->id)--}}
<input type="hidden" name="product_id" value="{{$product->id}}">
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> اسم الحجم</label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>' اسم الحجم ','data-parsley-required-message'=>'من فضلك ادخل  اسم الحجم  ','required'=>''])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> سعر البيع</label>
        <div class="form-line">
            {!! Form::text("size_price",null,['class'=>'form-control','placeholder'=>'سعر البيع ','data-parsley-required-message'=>'من فضلك ادخل سعرالحجم  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> سعر الشراء</label>
        <div class="form-line">
            {!! Form::text("purchase_price",null,['class'=>'form-control','placeholder'=>'سعر الشراء ','data-parsley-required-message'=>'من فضلك ادخل سعرالحجم  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label">  الباركود</label>
        <div class="form-line">
            <?php  $rand=rand(1000000,10000000); ?>
            {!! Form::text("barcode",isset($size)?$size->barcode:$rand,['class'=>'form-control',])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6  pull-left">
    <div class="form-group form-float">
        <label class="form-label"> الكمية </label>
        <div class="form-line">
            {!! Form::text("quantity",null,['class'=>'form-control','placeholder'=>'الكمية ','data-parsley-required-message'=>'من فضلك ادخل سعرالحجم  ','required'=>''])!!}
        </div>
    </div>
</div>
<div class="clearfix"></div>
<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

