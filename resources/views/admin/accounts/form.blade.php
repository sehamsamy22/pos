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
        <label class="form-label"> اسم الحساب</label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'اسم الحساب','data-parsley-required-message'=>'من فضلك ادخل الحساب  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="form-group col-sm-6 col-xs-12 pull-left">
    <label> نوع  الحساب  </label>
    {!! Form::select("type",['main'=>' مستوى اول','following_main'=>'  مستوى تابع','sub'=>'مستوى اخير',],Null,['class'=>'form-control','id'=>'type'])!!}
</div>


<div class="form-group col-sm-6 col-xs-12 pull-left accounts">
    <label>  اختر الحساب الرئيسى </label>
    {!! Form::select("account_id",$accounts,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الحساب ','disablePlaceholder' => true])!!}
</div>
@if(isset($account))
    @if($account->type=='following_main'||$account->type=='sub')
    <div class="form-group col-sm-6 col-xs-12 pull-left ">
        <label>  اختر الحساب الرئيسى </label>
        {!! Form::select("account_id",$accounts,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم الحساب ','disablePlaceholder' => true])!!}
    </div>
    @endif

@endif



<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

@section('scripts')

<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();
        $('.accounts').hide();

    });
</script>

<script>

    $('#type').change(function() {
         var type = $('#type').val();

         if (type=='main'){
             $('.accounts').hide();


         }else if(type=='sub') {
             $('.accounts').show();

        // $('.openning_balance').show();
         }else if(type =='following_main') {
             $('.accounts').show();

         }
    });
</script>
@endsection
