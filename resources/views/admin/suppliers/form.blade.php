@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


<div class="col-sm-12 col-xs-12 pull-left">
    <div class="form-group form-float">
        <label class="form-label"> اسم  المورد </label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'   اسم  المورد','data-parsley-required-message'=>'من فضلك ادخل اسم المورد  ','required'=>''])!!}
        </div>
    </div>
</div>


<div class="col-sm-12 col-xs-12 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  الجوال</label>
        <div class="form-line">
            {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'الجوال'])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12 pull-left">
    <div class="form-group form-float">
        <label class="form-label"> العنوان</label>
        <div class="form-line">
            {!! Form::text("address",null,['class'=>'form-control','placeholder'=>'العنوان','data-parsley-required-message'=>'من فضلك ادخل العنوان  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12 pull-left">
    <div class="form-group form-float">
        <label class="form-label"> الرصيد الافتتاحى</label>
        <div class="form-line">
            {!! Form::text("amount",null,['class'=>'form-control','placeholder'=>'الرصيد الافتتاحى','data-parsley-required-message'=>'من فضلك ادخل الرصيد الافتتاحى  ','required'=>''])!!}
        </div>
    </div>
</div>


<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

