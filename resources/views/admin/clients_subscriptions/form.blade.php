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
{{--            @dd($subscriptions)--}}
{{--            {!! Form::select("subscription_id",$subscriptions,null,['class'=>'form-control ','placeholder'=>'اختر نوع الاشتراك' ,'id'=>'subscription_id'])!!}--}}
            <select name="subscription_id" class="form-control  js-example-basic-single" id="subscription_id">

                        <option disabled selected>إختار نوع الاشتراك</option>
                        @foreach($subscriptions as $subscription)
                            <option value="{{$subscription->id}}" data-num="{{ $subscription->duration }}"
                            @if(isset($clientSubsription)) {{$clientSubsription->subscription_id == $subscription->id ? 'selected' :'' }} @endif  >{{$subscription->name }}</option>
                        @endforeach
                    </select>
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6 pull-right">
    <div class="form-group form-float">
        <label class="form-label">  نهاية الاشتراك</label>
        <div class="form-line">
            <input type="text" name="end" class="form-control" id="date_end" readonly>
        </div>
    </div>
</div>
<div class="col-sm-6 col-xs-6 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  بداية الاشتراك</label>
        <div class="form-line">
            <input type="date" class="form-control" name="start" id="start_date" value={{ \Carbon\Carbon::now()}}>
        </div>
    </div>
</div>
<div class="clearfix"></div>
<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1">الأسبوع الاول</a></li>
    <li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2">الأسبوع الثانى</a></li>
    <li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu3"> الأسبوع الثالث</a></li>
    <li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu4"> الأسبوع الرابع</a></li>

</ul>
<div class="tab-content">
    <div role="tabpanel" id="menu1" class="tab-pane active">
        <input type="hidden" >
        <table  class="table table-striped table-bordered">
            <thead>
            <tr>
                <th></th>
                <th>اليوم الاول </th>
                <th>اليوم التانى </th>
                <th>اليوم الثالث </th>
                <th>اليوم الرابع </th>
                <th>اليوم الخامس </th>
                <th>اليوم السادس </th>
                <th>اليوم السابع </th>
            </tr>
            </thead>
            <tbody>
            @foreach($types as $key => $type)
                <tr>
                    <td style="font-weight: 600;">{{ $type->name }}</td>
                    @for($i=1;$i<=7;$i++)
                        <td>

                        </td>
                    @endfor
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div role="tabpanel" id="menu2" class="tab-pane">

    </div>
    <div role="tabpanel" id="menu3" class="tab-pane">

    </div>
    <div role="tabpanel" id="menu4" class="tab-pane">

    </div>
</div>

<div class="col-sm-4 col-xs-4 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  سعر الخطة</label>
        <div class="form-line">
            {!! Form::text("price",null,['class'=>'form-control','placeholder'=>'السعر','id'=>'price'])!!}
        </div>
    </div>
</div>
<div class="col-sm-2 col-xs-2 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  الضريبه</label>
        <div class="form-line">
            {{-- {!! Form::text("tax",getsetting('tax'),null,['class'=>'form-control','id'=>'tax','readonly'])!!} --}}
        <input type="text" name="tax" value={{getsetting('tax')}}  class="form-control" id="tax" >
        </div>
    </div>
</div>
<div class="col-sm-2 col-xs-2 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  قيمة الضريبه</label>
        <div class="form-line">
            {{-- {!! Form::text("tax",getsetting('tax'),null,['class'=>'form-control','id'=>'tax','readonly'])!!} --}}
        <input type="text" name=""  class="form-control" id="tax_val" readonly >
        </div>
    </div>
</div>

<div class="col-sm-4 col-xs-4 pull-left">
    <div class="form-group form-float">
        <label class="form-label">  الاجمالى</label>
        <div class="form-line">
            {!! Form::text("total",null,['class'=>'form-control','placeholder'=>'الاجمالى','id'=>'total'])!!}
        </div>
    </div>
</div>


        <div class="form-group text-right m-b-0">
            <button class="btn btn-primary waves-effect" type="button" data-toggle="modal" data-target="#exampleModalCenter">حفظ</button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">الدفع </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group form-float">
                            <label class="form-label">   المطلوب دفعة</label>
                            <div class="form-line total">
                                <span  class="dynamic-span"></span>
                                <input type="text" class="form-control" name=""  id="amount_required" disabled>
                            </div>
                        </div>

                        <div class="form-group form-float">
                            <label class="form-label">    طريقة الدفع</label>
                            <div class="form-line ">
                                <span  class="dynamic-span"></span>
                                <select name="payment_type" class="form-control" id="payment_type" >
                                    <option value="cash">كاش</option>
                                    <option value="master">ماستر</option>
                                    <option value="veza">فيزا</option>
                                    <option value="mada">مدى</option>
                                  </select>

                            </div>
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label">    المبلغ المدفوع</label>
                            <div class="form-line total">
                                <span  class="dynamic-span"></span>
                                <input type="text" class="form-control" name="payed"  id="payed">
                            </div>
                        </div>
                        <div class="form-group form-float">
                            <label class="form-label">المتبقى</label>
                            <div class="form-line total">
                                <span  class="dynamic-span"></span>
                                <input type="text" class="form-control" name=""  id="reminder" disabled >
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button> --}}
                        <button type="submit" class="btn btn-primary"  data-dismiss="modal"  onclick="document.getElementById('form').submit();"> حفظ </button>
                    </div>
                </div>
            </div>
        </div>
