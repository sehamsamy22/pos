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
        <label class="form-label"> الكود</label>
        <div class="form-line">
            {!! Form::text("code",null,['class'=>'form-control','placeholder'=>'الكود','data-parsley-required-message'=>'من فضلك ادخل الكود  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> نوع الاشتراك</label>
        <div class="form-line">
            {!! Form::text("type",null,['class'=>'form-control','placeholder'=>' نوع الاشتراك','data-parsley-required-message'=>'من فضلك ادخل نوع الاشتراك  ','required'=>''])!!}
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
        <label class="form-label"> عدد الايام</label>
        <div class="form-line">
            {!! Form::text("num_days",null,['class'=>'form-control','placeholder'=>' عدد الايام','data-parsley-required-message'=>'من فضلك ادخل السعر  ','required'=>''])!!}
        </div>
    </div>
</div>


<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">  الحصص  المحجوزة </label>
        <div class="form-line">
            {!! Form::text("reserved_days",null,['class'=>'form-control','placeholder'=>'  الحصص  المحجوزة','data-parsley-required-message'=>'من فضلك ادخل السعر  ','required'=>''])!!}
        </div>
    </div>
</div>


<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

