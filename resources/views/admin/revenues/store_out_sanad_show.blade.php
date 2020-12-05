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

                    <div class="col-sm-6 col-xs-6 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">رقم السند </label>
                            <div class="form-line">
                                <input type="text" name="num" class="form-control"   value=" {{ $revenue->id }} " readonly>
                            </div>
                        </div>
                   </div>
                   <div class="col-sm-6 col-xs-6  pull-left">
                    <div class="form-group form-float">
                        <label class="form-label">تاريخ السند</label>
                        <div class="form-line">
                            {{-- {!! Form::date("date",null,['class'=>' form-control inline-control','placeholder'=>' تاريخ القبض','data-parsley-required-message'=>'من فضلك التاريخ','required'=>''])!!} --}}
                            <input type="date" class="form-control" name="date" id="date" value={{ $revenue->date }} readonly>

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




            <table class="table table-striped table-bordered">
            <th> اسم الصنف</th>
            <th>  الكمية </th>


            <tbody>

            @foreach ($products as $product)
            <tr >
                <td>{{$product->product->ar_name}} </td>
                <td >{{ $product->quantity }}</td>
            </tr>
            </tbody>
            @endforeach
        </table>





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
