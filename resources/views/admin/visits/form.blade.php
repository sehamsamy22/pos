@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@dd($client)
<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">   اسم العميل</label>
        <div class="form-line">
            {!! Form::select("client_id",$clients,Null,['class'=>'form-control','placeholder'=>'اختر   اسم العميل '])!!}
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
                    <li>{{$breakfast->ar_name}}-{{$breakfast->calories}} <input type="radio" id="{{$breakfast->calories}}_{{$i}}" name="meals[{{$breakfast->id}}]"></li>
                @endforeach
            </td>
        @endfor
    </tr>

    <tr>
        <td>الغداء</td>
        @for($i=1;$i<=7;$i++)
            <td>
                @foreach($lunches as $lunch)
                    <li>{{$lunch->ar_name}}-{{$lunch->calories}} <input type="radio" id="{{$lunch->calories}}_{{$i}}" name="meals[{{$lunch->id}}]"></li>
                @endforeach
            </td>
        @endfor
    </tr>
    <tr>
        <td>العشاء</td>
        @for($i=1;$i<=7;$i++)
            <td>
                @foreach($dinners as $dinner)
                    <li>{{$dinner->ar_name}}-{{$dinner->calories}} <input type="radio" id="{{$dinner->calories}}_{{$i}}" name="meals[{{$dinner->id}}]"></li>
                @endforeach
            </td>
        @endfor
    </tr>

    </tbody>
</table>



<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

