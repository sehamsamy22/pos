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
        <label class="form-label"> اسم التصنيف</label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'اسم التصنيف','data-parsley-required-message'=>'من فضلك ادخل التصنيف  ','required'=>''])!!}
        </div>
    </div>
</div>



<div class="col-sm-12 col-xs-12  pull-right">
<div class="form-group form-float">
    <label class="form-label"> صورة التصنيف </label>
    <div class="form-line">
        {!! Form::file("image",null,['class'=>'form-control','placeholder'=>'  صورة التصنيف','data-parsley-required-message'=>'من فضلك ادخل الصوره  ','required'=>''])!!}
    </div>
</div>
</div>
@if( isset($category))
    <div class="col-sm-12 col-xs-12  pull-right">
        <div class="form-group form-float">
            <label>صوره التصنيف  : </label>
            <img src="{{getimg($category->image)}}" style="width:100px; height:100px">
        </div>
    </div>
@endif

<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

