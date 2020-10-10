@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label"> الكود</label>
        <div class="form-line">
            {!! Form::text("code",null,['class'=>'form-control','placeholder'=>'الكود','data-parsley-required-message'=>'من فضلك ادخل الكود  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label"> اسم  العميل </label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'   اسم  العميل','data-parsley-required-message'=>'من فضلك ادخل اسم العميل  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">الإيميل</label>
        {!! Form::email("email",null,['class'=>'form-control','placeholder'=>'الايميل ','data-parsley-type'=>"email",'data-parsley-type-message'=>'من  فضللك ادخل الايميل  بشكل  صحيح','required'=>''])!!}
        <div class="form-line">
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  الجوال</label>
        <div class="form-line">
            {!! Form::text("phone",null,['class'=>'form-control','placeholder'=>'الجوال'])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  نوع الاشتراك</label>
        <div class="form-line">
            {!! Form::select("subscription_id",$subscriptions,null,['class'=>'form-control','placeholder'=>'اختر نوع الاشتراك'])!!}
        </div>
    </div>
</div>


<div class="clearfix"></div>
<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  بداية الاشتراك</label>
        <div class="form-line">
            {!! Form::date("start",null,['class'=>'form-control','placeholder'=>'بداية الاشتراك'])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  نهاية الاشتراك</label>
        <div class="form-line">
            {!! Form::date("end",null,['class'=>'form-control','placeholder'=>'نهاية الاشتراك'])!!}
        </div>
    </div>
</div>

<table id="basic" class="table table-striped table-bordered" >
    <thead>
    <tr>
        <th></th>
        <th>السبت </th>
        <th>الاحد </th>
        <th>الاتنين </th>
        <th>الثلاثاء </th>
        <th>الاربعاء </th>
        <th>الخميس </th>
        <th>الجمعه </th>



    </tr>
    </thead>
    <tbody>


        <tr>
            <td>الافطار</td>
            @for($i=1;$i<=7;$i++)
            <td>
                @foreach($breakfasts as $breakfast)
                <li>{{$breakfast->ar_name}}-{{$breakfast->calories}} <input type="radio" id="{{$breakfast->calories}}_{{$i}}" name="breakfast[{{$i}}]"></li>
                @endforeach
            </td>
            @endfor
        </tr>

        <tr>
            <td>الغداء</td>
            @for($i=1;$i<=7;$i++)
                <td>
                    @foreach($lunches as $lunch)
                        <li>{{$lunch->ar_name}}-{{$lunch->calories}} <input type="radio" id="{{$lunch->calories}}_{{$i}}" name="lunch[{{$i}}]"></li>
                    @endforeach
                </td>
            @endfor
        </tr>
        <tr>
            <td>العشاء</td>
            @for($i=1;$i<=7;$i++)
                <td>
                    @foreach($dinners as $dinner)
                        <li>{{$dinner->ar_name}}-{{$dinner->calories}} <input type="radio" id="{{$dinner->calories}}_{{$i}}" name="dinners[{{$i}}]"></li>
                    @endforeach
                </td>
            @endfor
        </tr>

    </tbody>
</table>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    الزيارات  والقياسات
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <label>   </label>
                    <label>  تاريخ الزياره </label>
                <span class="required--in">*</span>
                <input type="date" class="form-control" id="date">
                <input type="hidden" data-measurements="{{$measurements}}">
                @foreach($measurements as $measurement)
                <label> {{$measurement->name}}</label>
                <span class="required--in">*</span>
                <input type="text" class="form-control"  id="{{$measurement->id}}"  value="">
                @endforeach
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                <button type="button" class="btn btn-primary" onclick="myFun(event)">حفظ   </button>
            </div>
        </div>
    </div>
</div>
<div class="table-striped" id="visitTable-wrap" style="display:none">

        <table id="visitsTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
        <tr>
            <th>  تاريخ الزياره</th>
            @foreach($measurements as $measurement)
            <th>{{$measurement->name}}</th>
            @endforeach
        </tr>
        </thead>
            <tbody class="add-visits">
            @if(isset($visits))

                @endif
            </tbody>
    </table>
</div>
<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

