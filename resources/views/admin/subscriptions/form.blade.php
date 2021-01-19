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
        <label class="form-label">  مده الخطه</label><span class="required--in"> (عدد  الايام)</span>
        <div class="form-line">
            {!! Form::text("duration",null,['class'=>'form-control','placeholder'=>'  مده الخطه','data-parsley-required-message'=>'من فضلك ادخل  مده الخطه  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> عدد الوجبات</label>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
        اخترالوجبات
        </button>
        <div class="form-line">
            {!! Form::text("num_meals",null,['class'=>'form-control','placeholder'=>' عدد الوجبات','data-parsley-required-message'=>'من فضلك ادخل السعر  ','required'=>''])!!}
        </div>
    </div>
</div>


<!-- unit table-->


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
        <label class="form-label"> وصف الخطه </label>
        <div class="form-line">
            {!! Form::textarea("description",null,['class'=>'form-control','placeholder'=>'  وصف  الخطه',])!!}
        </div>
    </div>
</div>
    <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1">الأسبوع الاول</a></li>
        <li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2">الأسبوع الثانى</a></li>
        <li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu3"> الأسبوع الثالث</a></li>
        <li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu4"> الأسبوع الرابع</a></li>

    </ul>
        <div class="tab-content">
            <div role="tabpanel" id="menu1" class="tab-pane active">
                @include('admin.subscriptions.week_one')
            </div>
            <div role="tabpanel" id="menu2" class="tab-pane">
                @include('admin.subscriptions.week_two')
            </div>
            <div role="tabpanel" id="menu3" class="tab-pane">
                @include('admin.subscriptions.week_three')
            </div>
            <div role="tabpanel" id="menu4" class="tab-pane">
                @include('admin.subscriptions.week_four')
            </div>
        </div>


<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

