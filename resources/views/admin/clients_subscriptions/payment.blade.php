@extends('admin.layout.master')
@section('title','سند دفع اشتراك')

@section('styles')
    <style>
        .erro{
            color: red;
        }
    </style>
@endsection

@section('content')
    <!-- Page Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <h4 class="header-title m-t-0 m-b-30">  سند دفع اشتراك</h4>
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

                   <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">   المدفوع من الاشتراك </label>
                            <div class="form-line">
                            <input type="text" name="" class="form-control" value={{$clients_subscription->payed}}  id="payed" readonly>
                            </div>
                        </div>
                   </div>
                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">    اجمالى الاشتراك  </label>
                            <div class="form-line">
                            <input type="text" name="" class="form-control" value={{$clients_subscription->total}}  id="total" readonly>
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

    @include('admin.layout.form_validation_js')
<script>
   $("#amount").on('change', function() {
            var amount = $(this).val();
            var total = $('#total').val();
            var payed = $('#payed').val();
            var x=Number(total)-[Number(payed) +Number(amount)];
            $('#reminder').val(x.toFixed(2));
        });

</script>
@endsection
