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
        <label class="form-label">   اسم العميل</label>
        <div class="form-line">
            {!! Form::select("client_id",$clients,isset($client)?$client->id:null,['class'=>'form-control','placeholder'=>'اختر   اسم العميل '])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  نوع الاشتراك</label>
        <div class="form-line">
            {!! Form::select("subscription_id",$subscriptions,null,['class'=>'form-control','placeholder'=>'اختر نوع الاشتراك' ,'id'=>'subscription_id'])!!}
        </div>
    </div>
</div>

<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  بداية الاشتراك</label>
        <div class="form-line">
            {!! Form::date("start",null,['class'=>'form-control','placeholder'=>'بداية الاشتراك','id'=>'start_date'])!!}
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  نهاية الاشتراك</label>
        <div class="form-line">
            <input type="text" name="end" class="form-control" id="date_end" readonly>
{{--            {!! Form::date("end",null,['class'=>'form-control','placeholder'=>'نهاية الاشتراك'])!!}--}}
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
    <tbody class="table_meals">



    </tbody>
</table>



<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

