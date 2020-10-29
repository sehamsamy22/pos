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
        <label class="form-label"> اسم الخطة</label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'اسم الخطة','data-parsley-required-message'=>'من فضلك ادخل الكود  ','required'=>''])!!}
        </div>
    </div>
</div>


<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> السعر</label>
        <div class="form-line">
            {!! Form::text("price",null,['class'=>'form-control','placeholder'=>' السعر','data-parsley-required-message'=>'من فضلك ادخل السعر  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">  مده الخطه</label><span class="required--in"> (عدد  الشهور)</span>
        <div class="form-line">
            {!! Form::number("duration",null,['class'=>'form-control','placeholder'=>'  مده الخطه','data-parsley-required-message'=>'من فضلك ادخل  مده الخطه  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> عدد الوجبات</label>
        <div class="form-line">
            {!! Form::text("num_meals",null,['class'=>'form-control','placeholder'=>' عدد الوجبات','data-parsley-required-message'=>'من فضلك ادخل السعر  ','required'=>''])!!}
        </div>
    </div>
</div>
<!-- $table->enum('type', ['breakfast','mini_breakfast' ,'lunch','mini_lunch','dinner','mini_dinner']); -->

<div class="col-sm-12 col-xs-12  pull-left">
<label class="text-muted font-13 m-b-15 m-t-20">الواجبات</label>
     @foreach($types as $key => $type)
    <div class="checkbox checkbox-success checkbox-inline">
        <input type="checkbox" id="inlineCheckbox{{$type->id}}" value="{{ $type->id }}" name="meal[]">
        <label for="inlineCheckbox{{$type->id}}">  {{ $type->name }} </label>
    </div>

    @endforeach
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">  نسبةالخصم </label>
        <div class="form-line">
            {!! Form::text("discount",null,['class'=>'form-control','placeholder'=>'نسبةالخصم','data-parsley-required-message'=>'من فضلك ادخل نسبةالخصم  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> وصف  الخطه</label>
        <div class="form-line">
            {!! Form::textarea("description",null,['class'=>'form-control','placeholder'=>'  وصف  الخطه','data-parsley-required-message'=>'من فضلك ادخل نوع الاشتراك  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

