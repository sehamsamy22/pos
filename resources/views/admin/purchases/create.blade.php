@extends('admin.layout.master')
@section('title','إنشاء  فاتورة شراء جديد')

@section('styles')
    <style>
        .erro{
            color: red;
        }
        .dynamic-span{
        font-size: x-large;
    }
    </style>
    <link href="{{asset('admin/assets/css/jquery.datetimepicker.min.css')}}" rel="stylesheet" type="text/css">

@endsection

@section('content')
    <!-- Page Title -->


    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 m-b-30">  فاتوره  المشتريات</h4>

                <div class="row">



                    {!!Form::open( ['route' => 'dashboard.purchases.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}

                    <div class="col-sm-4 col-xs-4  pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">رقم الفاتورة</label>
                            <div class="form-line">
                            <input type="text" class="form-control" name="num" value="00{{ $purchaselast->id }}">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xs-4  pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">تاريخ الفاتورة</label>
                            <div class="form-line">
                                {!! Form::text("date",null,['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' تاريخ الفاتورة','data-parsley-required-message'=>'من فضلك التاريخ','required'=>''])!!}
                            </div>
                        </div>
                    </div>


                    <div class="col-sm-4 col-xs-4 pull-left">
                        <div class="form-group form-float">
                            <label class="form-label"> اسم المورد</label>
                            <div class="form-line">
                                {!! Form::select("supplier_id",$suppliers,null,['class'=>'form-control js-example-basic-single','data-parsley-required-message'=>' اختر اسم المورد  ','required','placeholder'=>' اختر اسم المورد ','id'=>'supplier_id'])!!}

                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-4  pull-right">
                        <div class="form-group form-float">
                            <div class="form-line ">
                                <a href="{{route('dashboard.products.create')}}" target="_blank" class="btn btn-primary ">
                                    اضافه صنف جديد
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xs-4  pull-right">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <select class="form-control js-example-basic-single product_id"  name="product_id" placeholder="اختر اسم الصنف" >
                                    <option value="" > بحث باركود الصنف</option>
                                    @foreach ($products as $product)
                                        <option value="{{$product->id}}"
                                                data-name="{{$product->ar_name}}"
                                                data-price="{{$product->price}}"
                                                data-bar-code="{{$product->barcode}}"
                                                data-unit="{{$product->unit}}"
                                            {{--                                                data-link= "{{route('dashboard.products.show',['id'=>$product->id])}}"--}}
                                        >
                                            {{$product->barcode}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4 col-xs-4  pull-right">
                        <div class="form-group form-float">
                            <div class="form-line">
                                <select class="form-control js-example-basic-single product_id"  name="product_id" placeholder="اختر اسم الصنف" >
                                    <option value="" > بحث بإسم الصنف</option>
                                @foreach ($products as $product)
                                        <option value="{{$product->id}}"
                                                data-name="{{$product->ar_name}}"
                                                data-price="{{$product->price}}"
                                                data-bar-code="{{$product->barcode}}"
                                                data-unit="{{$product->unit}}"
{{--                                                data-link= "{{route('dashboard.products.show',['id'=>$product->id])}}"--}}
                                        >
                                            {{$product->ar_name}}
                                        </option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <table  class="table table-striped table-bordered bill-table finalTb" >
                        <thead>
                        <tr>
                            <th  width="40">م</th>
                            <th rowspan="2"  width="70">اسم الصنف</th>
                            <th rowspan="2"  width="70">الوحدة</th>
                            <th rowspan="2"  width="70">الكمية</th>
                            <th rowspan="3"  width="70">سعر الوحدة</th>
                            <th  width="70">الإجمالى</th>
                            <th  width="70">الخصم</th>
                            <th rowspan="2" width="70">قيمة الضريبة</th>
                            <th rowspan="2" width="70">صافي الإجمالي</th>
                            <th rowspan="2"  width="100"> حذف </th>
                        </tr>
                        </thead>
                        <tbody>
                        <!--Space For Appended Products-->
                        </tbody>
                        <tfoot>
                        <tr>

                            <th  id="amountBeforeDariba" colspan="3">
                                <div class="form-group form-float">
                                    <label class="form-label">اجمالى الفاتورة</label>
                                    <div class="form-line">
                                        <span  class="dynamic-span"></span>
                                        <input type="hidden" class="form-control" name="amount" id="amountBeforeDariba1" >
                                    </div>
                                </div>
                            </th>

                        <th  colspan="3">
                            <div class="form-group form-float">
                                <label class="form-label"> نسبةالخصم</label>
                                <span class="required--in">%</span>
                                <div class="form-line">
                                    <input type="text" class="form-control" name="bill_discount" id="bill_discount">
                                </div>
                            </div>
                            <div class="form-group form-float">
                                    <input type="text" class="form-control"  id="discount" disabled>
                            </div>
                        </th>
                            <th  colspan="3">
                                <div class="form-group form-float">
                                    <label class="form-label"> نسبة الضريبة</label>
                                    <span class="required--in">%</span>
                                    <div class="form-line">
                                        <input type="text" class="form-control" name="bill_tax"  value={{ getsetting('tax') }} id="bill_tax" readonly>
                                    </div>
                                </div>
                                <div class="form-group form-float">
                                    <input type="text" class="form-control"  id="tax" disabled>
                            </div>
                            </th>


                            <th id="amountAfterDariba" colspan="3">
                            <div class="form-group form-float">
                                <label class="form-label">  الاجمالى  بعد الخصم والضريبة</label>
                                <div class="form-line total">
                                    <span  class="dynamic-span"></span>

                                    <input type="hidden" class="form-control" name="total" id="amountAfterDariba1">
                                </div>
                            </div>
                        </th>
                        </tr>

                            <tr>
                           <th colspan="12">
                               <div class="bill_footer"  >

                                {{--  <button type="button" class="btn btn-warning btn_bill" data-toggle="modal" data-target="#exampleModalCenter">
                                   الدفع
                                </button>  --}}

                                <button type="button" class="btn_bill"  data-toggle="modal" data-target="#exampleModalCenter">حفظ</button>
                                <buttton type="button" class="btn btn-danger btn_bill" onclick="myFunction()">الغاء</buttton>

                            </div>
                            </th>

                            </tr>


                        </tfoot>
                    </table>

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
                                            <input type="text" class="form-control" name=""  id="total" disabled>
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
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                    <button type="submit" class="btn btn-primary"> حفظ الفاتورة </button>
                                </div>
                            </div>
                        </div>
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
       var rowNum = 0;
       var unit;

       $(".product_id").on('change', function() {
        var id = $(this).val();
        rowNum++;
        var selectedProduct = $(this).find(":selected");
        var ProductId = $(this).val();
        var productName = selectedProduct.data('name');
        var productLink = selectedProduct.data('link');
        var barCode = selectedProduct.data('bar-code');
        var productPrice = selectedProduct.data('price');
        var productUnit= selectedProduct.data('unit');
        var wholePriceAfter=selectedProduct.data('price');
       if(productUnit=='kilo')
       {
           unit='كيلو';
       }else if(productUnit=='gram')
       {
           unit='جرام';
       }else{
           unit='لتر';
       }
        $(".bill-table tbody").append(`<tr class="single-row-wrapper" id="row${rowNum}" ">
							<td class="row-num" width="40">${rowNum}</td>
                            <input type="hidden" name="product_id[${ProductId}]" value="${ProductId}">
							<td class="product-name " width="190">${productName}</td>
							<td class="product-unit " width="70">${unit}</td>
							<td class="product-quantity " width="40">
								<input type="number" placeholder="الكمية" step="1" min="1" value="1" id="sale" class="form-control" name="quantity[${ProductId}]">
							</td>
							<td class="unit-price" width="100">${productPrice}
								<input type="hidden" class="form-control" step="any" value="${productPrice}" name="prices[${ProductId}]">
							</td>
                          <td class="quantityXprice" width="70">${productPrice}</td>

							<td class="whole-product-discount" width="70">
							<input type="number" class="form-control" step="any" min="0" value="0" name="discounts[${ProductId}]">
                              </td>
							<td class="whole-product-tax" width="70">
						    <input type="number" class="form-control" step="any" min="0" value="0" name="taxs[${ProductId}]">
                            </td>


                       <td class="whole-price-after " width="70">${wholePriceAfter}</td>

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
        $(".bill-table tbody").change(calcInfo);
        //**************    Calc while removing a product ************************
        $(".remove-prod-from-list").on('click', function (e) {
            $(this).parents("tr").remove();
            calcInfo();
            var trLen = $(".finalTb  tbody tr").length;
            if (trLen === 0) {
                $('table tfoot').addClass('tempDisabled');
            }
        });
           $(".product-quantity").change(function() {
            if (($(this).val()) < 0) {
                $(this).val(0);
                $(this).text('0');
            }
               var theQuantity = $(this).parents("tr.single-row-wrapper").find(".product-quantity input").val();
               var theUnitPrice = $(this).parents("tr.single-row-wrapper").find(".unit-price input").val();
               var quantityXprice = Number(theUnitPrice) * Number(theQuantity);
               wholePriceAfter = Number(quantityXprice);
               $(this).parents('.single-row-wrapper').find(".unit-price input").val(productPrice);
              $(this).parents('.single-row-wrapper').find(".quantityXprice").text(quantityXprice.toFixed(2));
               $(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
             $(this).parents('.single-row-wrapper').find(".whole-price-before").attr('tempPriBef', wholePriceBefore.toFixed(2));

           });

           $(".whole-product-discount").change(function() {
               var theQuantity = $(this).parents("tr.single-row-wrapper").find(".product-quantity input").val();
               var theUnitPrice = $(this).parents("tr.single-row-wrapper").find(".unit-price input").val();
               var quantityXprice = Number(theUnitPrice) * Number(theQuantity);
               var thediscount = $(this).parents("tr.single-row-wrapper").find(".whole-product-discount input").val();
                wholePriceAfter = Number(quantityXprice) - Number(thediscount);
               $(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
               $(this).parents('.single-row-wrapper').find(".whole-price-before").attr('tempPriBef', wholePriceBefore.toFixed(2));
           })

           $(".whole-product-tax").change(function() {
               var theQuantity = $(this).parents("tr.single-row-wrapper").find(".product-quantity input").val();
               var theUnitPrice = $(this).parents("tr.single-row-wrapper").find(".unit-price input").val();
               var quantityXprice = Number(theUnitPrice) * Number(theQuantity);
               var thediscount = $(this).parents("tr.single-row-wrapper").find(".whole-product-discount input").val();
                wholePriceAfter = Number(quantityXprice) - Number(thediscount);
              $(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));
               var tax = $(this).parents("tr.single-row-wrapper").find(".whole-product-tax input").val();
              wholePriceAfter = Number(wholePriceAfter) + Number(tax);
               $(this).parents('.single-row-wrapper').find(".whole-price-after").text(wholePriceAfter.toFixed(2));

           })


           function calcInfo() {
               var amountBeforeDariba = 0;
               $(".whole-price-after").each(function () {
                   amountBeforeDariba += Number($(this).text());
               });

               var amountAfterDariba = 0;
               $(".whole-price").each(function () {
                   amountAfterDariba += Number($(this).text());
               });
               var bill_tax=$('#bill_tax').val();
               var tax_val= Number(wholePriceAfter) * (Number(bill_tax) / 100);
               $("#tax").val(Number(tax_val));
               $("#amountBeforeDariba span.dynamic-span").html(amountBeforeDariba.toFixed(2));
               $("#amountAfterDariba span.dynamic-span").html(Number(amountBeforeDariba+tax_val).toFixed(2));
               $("#amountAfterDariba").val(amountBeforeDariba+tax_val);
               // $("#amountOfDariba span.dynamic-span").html(amountOfDariba.toFixed(2));
              // $("#total").val(amountAfterDariba.toFixed(2));
               var  totalAfterFixTax=amountBeforeDariba+tax_val ;
               {{--  console.log(amountBeforeDariba+tax_val);  --}}


               $("#bill_discount").change(function() {
                   var bill_discount=$(this).val();
                    var discount_val= Number(totalAfterFixTax)*(Number(bill_discount)/100);
                    console.log(totalAfterFixTax);
                   $("#amountAfterDariba span.dynamic-span").html(Number(totalAfterFixTax)-Number(discount_val));
                   $("#amountAfterDariba1").val(Number(totalAfterFixTax)-Number(discount_val));
                   $("#total").val((Number(totalAfterFixTax)-Number(discount_val)).toFixed(2));
                   $("#discount").val(Number(discount_val));

               });
               $("#total").val(totalAfterFixTax);

               $("#amountAfterDariba1").val(totalAfterFixTax);

               $("#payed").change(function() {
                   var payed=$(this).val();
                   var reminder= Number($("#total").val()) - Number(payed);
                   $("#reminder").val(reminder.toFixed(2));

               });



           }

       });
       function myFunction(){
        window.location.reload();
           }

    </script>

@endsection
