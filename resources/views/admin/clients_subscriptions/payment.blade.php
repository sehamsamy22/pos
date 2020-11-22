@extends('admin.layout.master')
@section('title','سند دفع اشتراك')

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
                <h4 class="header-title m-t-0 m-b-30">  سند قبض اشتراك</h4>
                <div class="row">
                    {!!Form::open( ['route' => 'dashboard.revenues.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}
                    <input type="hidden" value="subscription" name="type">
                    <input type="hidden" value="{{$clients_subscription->id}}" name='client_subscription_id'>
                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label"> اسم  العميل </label>
                            <div class="form-line">
                            <input type="text" name="client_id" class="form-control" value={{$clients_subscription->client->name}} readonly>
                            </div>
                        </div>
                   </div>


                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label"> اسم  الخطة </label>
                            <div class="form-line">
                            <input type="text" name="subscription_id" class="form-control" value={{$clients_subscription->subscription->name}} readonly>
                            </div>
                        </div>
                   </div>

                   <div class="col-sm-6 col-xs-6  pull-left">
                    <div class="form-group form-float">
                        <label class="form-label">تاريخ القبض</label>
                        <div class="form-line">
                            {!! Form::text("date",null,['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' تاريخ القبض','data-parsley-required-message'=>'من فضلك التاريخ','required'=>''])!!}
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-xs-6 pull-left">
                    <div class="form-group form-float">
                        <label class="form-label"> النوع </label>
                        <div class="form-line">
                        <input type="text" name="" class="form-control"   value="سندقبض">
                        </div>
                    </div>
               </div>
                   <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">   المدفوع من الاشتراك </label>
                            <div class="form-line">
                            <input type="text"  class="form-control" value={{ $clients_subscription->payed ??'0'}}  id="payed" readonly>
                            </div>
                        </div>
                   </div>

                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">    اجمالى الاشتراك  </label>
                            <div class="form-line">
                            <input type="text"  class="form-control" value={{$clients_subscription->total}}  id="total" readonly>
                            </div>
                        </div>
                   </div>
                   <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label"> المبلغ </label>
                            <div class="form-line">
                            <input type="text" name="amount" class="form-control" id="amount" >
                            </div>
                        </div>
                   </div>
                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">     المتبقى </label>
                            <div class="form-line">
                            <input type="text" name="" class="form-control"   id="reminder" readonly>
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
                   <div class="form-group text-right m-b-0">
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
   $("#amount").on('change', function() {
            var amount = $(this).val();
            var total = $('#total').val();
            var payed = $('#payed').val();
            var x=Number(total)-[Number(payed) +Number(amount)];
            $('#reminder').val(x.toFixed(2));
        });

</script>
@endsection
