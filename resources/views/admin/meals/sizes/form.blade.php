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


<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

