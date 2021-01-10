@extends('admin.layout.master')
@section('title','إنشاء  فاتورة مبيعات جديدة')

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


                {{-- <h4 class="header-title m-t-0 m-b-30">بيانات  القياس</h4> --}}

                <div class="row">



                    {!!Form::open( ['route' => 'dashboard.sales.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}

{{--                    <div class="col-sm-4 col-xs-4  pull-left">--}}
{{--                        <div class="form-group form-float">--}}
{{--                            <label class="form-label">رقم الفاتورة</label>--}}
{{--                            <div class="form-line">--}}
{{--                                <input type="text" class="form-control" name="num" value="000{{  $salelast->id  ??'1'}}">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="col-sm-4 col-xs-4  pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">تاريخ الفاتورة</label>
                            <div class="form-line">
                                {{-- {!! Form::date("date",null,['class'=>'form-control inline-control','placeholder'=>' تاريخ الفاتورة','data-parsley-required-message'=>'من فضلك التاريخ','required'=>''])!!} --}}
                                <input type="date" class="form-control" name="date" id="date" value={{ \Carbon\Carbon::now() }}>

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-4 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label"> اسم العميل</label>
                            <div class="form-line">
                                {!! Form::select("client_id",$clients,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم  العميل ','id'=>'supplier_id'])!!}

                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                        <div class="categories">

                            <fieldset class="cat">
                                <legend > التصنيفات الرئيسة </legend>
                                @foreach($categories as $category)
                                <a href="#" onclick="category(event,{{ $category->id }})"   class=" btn btn-success category_btn" data-id="{{$category->id}}">{{$category->name}}</a>
                                 @endforeach
                            </fieldset>

                        </div>
                        <div class="meals">
                            <div class="adds-maels">
                            <fieldset>
                                <legend> عدد الوجبات: <span class="counter">0</span></legend>
                            <table  class="table table-striped table-bordered sales-table" >
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الوجبة </th>
                                <th>الكيمة</th>
                                <th>اجمالى السعر</th>
                                <th> العمليات</th>
                            </tr>
                            </thead>
                                <tbody>
                                <!--Space For Appended Meals-->
                                </tbody>
                            </table>
                            </fieldset>
                            </div>
                            <div class="payments">
                            <fieldset>
                                <legend> الاجمالى: </legend>
                                <div class="AmountBeforeDiscount">
                                    <div class="form-group form-float">
                                        <label class="form-label"> الاجمالى قبل الخصم</label>
                                        <div class="form-line total">
                                            <input type="text" class="form-control" name="amount"  id="AmountBeforeDiscount" readonly>
                                        </div>
                                    </div>


                                </div>
                                <div class="discounts">
                                    <div class="form-group form-float">
                                        <label class="form-label"> نسبةالخصم</label>
                                        <span class="required--in">%</span>
                                        <div class="form-line">
                                            <input type="text" class="form-control" name="discount" id="discount">
                                        </div>
                                    </div>
                                </div>
                                <div class="total">
                                    <div class="form-group form-float">
                                        <label class="form-label" style="display: inline"> الاجمالى بعد الخصم    </label>
                                        <input type="text" class="form-control" name="" id="total_after_discount" readonly>
                                    </div>
                                </div>
                                    <div class="taxs">
                                        <div class="form-group form-float AmountBeforeDiscount">
                                            <label class="form-label"> الضريبة</label>
                                            <span class="required--in">%</span>
                                                <div class="form-line">
                                                <input type="text" class="form-control" name="bill_tax"  value={{ getsetting('tax') }} id="bill_tax" readonly>
                                                </div>
                                        </div>
                                        <div class="form-group form-float discounts">
                                            <label class="form-label" >قيمة الضريبة</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" name="tax" id="tax_val" readonly>
                                            </div>
                                        </div>

                                    </div>
                                <div class="total">
                                    <div class="form-group form-float">
                                        <label class="form-label" style="display: inline">    الاجمالى</label>
                                            <input type="text" class="form-control" name="total" id="total" readonly>
                                    </div>
                                </div>
                            </fieldset>
                            </div>
                        </div>

                    <div class="col-sm-12 col-xs-12 card text-right" >
                        <button type="button" class="btn btn-purple waves-effect w-md m-b-5">فاتوره جديده</button>

                        <button type="button" class="btn btn-inverse waves-effect w-md m-b-5" data-toggle="modal" data-target="#exampleModalCenter">
                            حفظ</button>

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
                                        <input type="text" class="form-control" name="reminder"  id="reminder" disabled >
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                {{-- <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button> --}}
                                <button type="submit" class="btn btn-primary"  onclick="document.getElementById('form').submit();" data-dismiss="modal"> حفظ </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end model -->

                {!!Form::close() !!}

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')
@include('admin.layout.form_validation_js')
    <script src="{{asset('admin/assets/js/jquery.datetimepicker.full.min.js')}}"></script>


    <script>
        $(document).ready(function() {
            // For initializing now date
            $('.inlinedatepicker').datetimepicker({defaultDate :new Date()});
            $('.inlinedatepicker').text(new Date().toLocaleString());
            $('.inlinedatepicker').val(new Date().toLocaleString());
        });
     //**************  category click ***********************

     var  rowNum=0;

  //   $(".category_btn").on('click',category);

     function category (e,id) {
        e.preventDefault();
      //  var id=$(e).data('id');
        console.log(id);
        $.ajax({
            url:"/dashboard/getAllSubcategoriesSale/"+id,
            type:"get",
        }).done(function (data) {
            $('.categories').empty();
            $('.categories').html(data.data);

            $(document).on('click','#reload',function(){
               $.ajax({
                           url:"/dashboard/getAllcategoriesSale/",
                           type:"get",
                       }).done(function (data) {
                       $('.cat').empty().append();
                       $('.cat').html(data.data);

                       });
                        });
            //**************   subcategory click ***********************
  $(document).on('click','.subcategory_btn',function(e){


   e.preventDefault();
                var id=$(this).data('id');
                $.ajax({
                    url:"/dashboard/getAllMeals/"+id,
                    type:"get",
                }).done(function (data) {

                    $('.categories').empty();
                    $('.categories').html(data.data);
                    $(document).on('click','#reload',function(){

                       $.ajax({
                                   url:"/dashboard/getAllcategoriesSale/",
                                   type:"get",
                               }).done(function (data) {
                               $('.cat').empty().append();
                               $('.cat').html(data.data);

                           });
                                });
                    $(".meal_btn").on('click', function(e) {
                        e.preventDefault();
                        var meal_id = $(this).data('id');
                        var meal_name = $(this).data('name');
                        var meal_price = $(this).data('price');
                        rowNum++;
                        $(".sales-table tbody").append(`<tr class="single-row-wrapper" id="row${rowNum}" ">
                           <td class="row-num" width="40">${rowNum}</td>
                           <input type="hidden" name="meal_id[${meal_id}]" value="${meal_id}">
                           <td class="meal-name " width="900">${meal_name}</td>
                           <td class="meal-quantity " width="40">
                               <input type="text" placeholder="الكمية" value="1" id="quantity" class="form-control" name="quantity[${meal_id}]">
                           </td>
                               <input type="hidden" class="form-control" step="any" value="${meal_price}" name="prices[${meal_id}]">
                           </td>
                         <td class="meal_price" width="70">${meal_price}</td>


                           <td class="bill-operations-td" width="160">
                               <button type="button"
                                       class="btn btn-danger"
                                        data-html="true"
                                       data-container="body"
                                       role="button"
                                       data-id="${rowNum}"
                               </button>
                               <a href="#" title="مسح" class="remove-prod-from-list" style="color: white"><span class="ti-close"></span></a>
                           </td>
                       </tr>
                   `);
                        calcInfo();
                        //**************    Calc while changing table body ***********************
                        $(".sales-table tbody").change(calcInfo);
                        //**************    Calc while removing a product ************************
                        $(".remove-prod-from-list").on('click', function (e) {
                            $(this).parents("tr").remove();
                            calcInfo();
                            var trLen = $(".meal_btn  tbody tr").length;
                            if (trLen === 0) {
                                $('table tfoot').addClass('tempDisabled');
                            }
                        });

                        $(".meal-quantity").change(function() {
                            if (($(this).val()) < 0) {
                                $(this).val(0);
                                $(this).text('0');
                            }
                            var theQuantity = $(this).parents("tr.single-row-wrapper").find(".meal-quantity input").val();
                        //     $.ajax({
                        //         url:"/dashboard/checkquantity/"+meal_id,
                        //         type:"get",
                        //         data:{quantity:theQuantity }
                        //     }).done(function (data) {
                        //     if(data.data=='false'){
                        //         swal("   ", " الكميه غير متوفره الان بالمخزن", 'danger', {
                        //             buttons: 'موافق'
                        //         });
                        //     }
                        //
                        // });
                            var quantityXprice = Number(meal_price) * Number(theQuantity);
                            $(this).parents('.single-row-wrapper').find(".meal_price").text(quantityXprice.toFixed(2));

                        });

                        $('.counter').html(rowNum);
                        //****************** Calc function************************
                        function calcInfo() {
                            var AmountBeforeDiscount = 0;
                            $(".meal_price").each(function () {
                                AmountBeforeDiscount += Number($(this).text());
                            });
                            var bill_tax=$('#bill_tax').val();
                            var tax_val= Number(AmountBeforeDiscount) * (Number(bill_tax) / 100);
                            $('#tax_val').val(tax_val.toFixed(2));
                            $("#AmountBeforeDiscount").val(AmountBeforeDiscount.toFixed(2));
                           var amount_tax=AmountBeforeDiscount+tax_val;
                            $("#total").val(amount_tax.toFixed(2));
                            $('#amount_required').val(amount_tax.toFixed(2));
                            $('#payed').val(amount_tax.toFixed(2));
                            $("#reminder").val('0');
                            $("#payed").change(function() {
                                var payed=$(this).val();
                                var reminder= Number($("#amount_required").val()) - Number(payed);
                                $("#reminder").val(reminder.toFixed(2));
                            });
                            $("#discount").change(function() {
                                var discount=$(this).val();
                                var discount_val= Number(AmountBeforeDiscount) * (Number(discount) / 100);
                                var all= Number(AmountBeforeDiscount)-Number(discount_val)

                                $("#total_after_discount").val(all.toFixed(2));

                                var tax_val_new= Number(all) * (Number(bill_tax) / 100);
                                $('#tax_val').val(tax_val_new.toFixed(2));
                                var  total_finaly=all+tax_val_new;
                                $("#total").val(total_finaly.toFixed(2));
                                $('#amount_required').val($('#total').val());
                                var allmount=$('#total').val();

                                $('#payed').val(allmount);
                                $("#reminder").val(0);
                                $("#payed").change(function() {
                                    var payed=$(this).val();
                                    var reminder= Number($("#amount_required").val()) - Number(payed);
                                    $("#reminder").val(reminder.toFixed(2));
                                });
                               });




                        }
                     });

                }).fail(function (error) {
                    console.log(error);
                });
            });


        }).fail(function (error) {
            console.log(error);
        });
    }

    </script>
    <script>
        @if(!empty(\Illuminate\ Support\ Facades\ Session::has('sale_id')))
        @php($sale_id = \Illuminate\ Support\ Facades\ Session::get('sale_id'))
        window.open(
            "{{route('dashboard.sales.show',$sale_id)}}",
            "_blank"
        ).print();
        @endif
    </script>

@endsection
