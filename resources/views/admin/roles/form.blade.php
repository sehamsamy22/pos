<div class="form-group ">
    <label class="form-label">اسم المنصب</label>
    <div class="form-line">
        {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'  الاسم  '])!!}
    </div>
</div>


<div class="form-group ">
    <label class="form-label">الصلاحيات</label>
    <div class="form-line"></div>
    <br>
    @foreach($permission as $value)
    <div class="demo-checkbox col-sm-6 col-xs-6">
            {{ Form::checkbox('permission[]', $value->name, false, array('class' => 'filled-in chk-col-teal','id'=> $value->name )) }}
            <label for="{{ $value->name }}" style="font-size: 12px;">{{ $value->ar_name }}</label>
    </div>
    @endforeach
</div>

<button class="btn btn-primary waves-effect" type="submit">حفظ</button>
