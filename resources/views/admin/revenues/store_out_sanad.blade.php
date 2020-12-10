@extends('admin.layout.master')
@section('title','سند  اخراج من المخزن')

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
                <h4 class="header-title m-t-0 m-b-30">  سند  اخراج من المخزن</h4>
                <div class="row">
                    {!!Form::open( ['route' => 'dashboard.revenues.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}
                    <input type="hidden" value="out" name="type">



                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">رقم السند </label>
                            <div class="form-line">
                                <input type="text" name="num" class="form-control"   value=" 00{{ $revenue->id }} " >
                            </div>
                        </div>
                   </div>
                   <div class="col-sm-6 col-xs-6  pull-left">
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
                        <input type="text" name="" class="form-control"   value="سند اخراج " readonly>
                        </div>
                    </div>
               </div>

                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">  ملاحظات  </label>
                            <div class="form-line">
                                {!! Form::text("notes",null,['class'=>'form-control ',])!!}

                            </div>
                        </div>
                    </div>
               <div class="col-sm-6 col-xs-6 pull-left">
                <div class="form-group form-float">
                    <label class="form-label"> اختر الصنف </label>
                    <div class="form-line">
                        {!! Form::select("product_id[]",$products,null,['class'=>'form-control js-example-basic-single product_id','multiple','id'=>'product_id',])!!}

                    </div>
                </div>
           </div>

           <div class="products"></div>


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
        $(".product_id").on('change', function() {
            var id = $(this).val();


            console.log(id);
            $.ajax({
                url:"/dashboard/productout",
                type:"get",
                data:{'ids':id,}
            }).done(function (data) {
                $('.products').html(data.data);
            }).fail(function (error) {
                console.log(error);
            });
        });

    });


</script>
@endsection
