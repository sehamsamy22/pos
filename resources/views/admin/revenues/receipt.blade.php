@extends('admin.layout.master')
@section('title','سند صرف')

@section('styles')
    <style>
        .erro{
            color: red;
        }
    </style>
    <link href="{{asset('admin/assets/css/jquery.datetimepicker.min.css')}}" rel="stylesheet" type="text/css">

@endsection

@section('content')
    <!-- Page Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">  سند صرف</h4>
                <div class="row">
                    {!!Form::open( ['route' => 'dashboard.revenues.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}
                    <input type="hidden" value="receipt" name="type">

                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">  رقم السند</label>
                            <div class="form-line">
                                <input type="text" name="num" class="form-control"   value=" 00{{ $revenue->id }} " >

                            </div>
                        </div>
                    </div>


                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label"> اسم المورد</label>
                            <div class="form-line">
                                {!! Form::select("supplier_id",$suppliers,null,['class'=>'form-control js-example-basic-single','data-parsley-required-message'=>' اختر اسم المورد  ','required','placeholder'=>' اختر اسم المورد ','id'=>'supplier_id'])!!}

                            </div>
                        </div>
                    </div>

                   <div class="col-sm-6 col-xs-6  pull-right">
                    <div class="form-group form-float">
                        <label class="form-label">تاريخ السند</label>
                        <div class="form-line">
                            {{-- {!! Form::date("date",null,['class'=>' form-control inline-control','placeholder'=>' تاريخ القبض','data-parsley-required-message'=>'من فضلك التاريخ','required'=>''])!!} --}}

                            <input type="date" class="form-control" name="date" id="date" value={{ \Carbon\Carbon::now() }}>
                        </div>
                    </div>
                </div>



                <div class="col-sm-6 col-xs-6 pull-left">
                    <div class="form-group form-float">
                        <label class="form-label"> النوع </label>
                        <div class="form-line">
                        <input type="text" name="" class="form-control"   value="سند صرف " readonly>
                        </div>
                    </div>
               </div>

                   <div class="col-sm-6 col-xs-6 pull-right">
                        <div class="form-group form-float">
                            <label class="form-label"> المبلغ </label>
                            <div class="form-line">
                            <input type="text" name="amount" class="form-control" id="amount" >
                            </div>
                        </div>
                   </div>


                   <div class="col-sm-6 col-xs-6 pull-left">
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
                   <div class="form-group pull-right m-b-0">
                        <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
                    </div>

                    {!!Form::close() !!}
                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')
<script src="{{asset('admin/assets/js/jquery.datetimepicker.full.min.js')}}"></script>

    @include('admin.layout.form_validation_js')
<script>
    $(document).ready(function() {

        // For initializing now date
        $('.inlinedatepicker').datetimepicker({defaultDate :new Date()});
        $('.inlinedatepicker').text(new Date().toLocaleString());
        $('.inlinedatepicker').val(new Date().toLocaleString());
    });


</script>
@endsection
