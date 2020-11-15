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

                    <div class="col-sm-4 col-xs-4  pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">رقم الفاتورة</label>
                            <div class="form-line">
                                <input type="text" class="form-control" name="num">
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
                            <label class="form-label"> اسم العميل</label>
                            <div class="form-line">
                                {!! Form::select("client_id",$clients,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر اسم  العميل ','id'=>'supplier_id'])!!}

                            </div>
                        </div>
                    </div>
                   
                       <div class="re" style=" margin-left: 309px;">
                      <a class="reload"><i class="zmdi zmdi-arrow-right" style="font-size: x-large;"></i></a>
                      </div>

                        <div class="categories">
                            
                            <fieldset class="cat">
                                <legend > التصنيفات الرئيسة </legend>
                                @foreach($categories as $category)
                                <a href=""   class=" btn btn-success category_btn" data-id="{{$category->id}}">{{$category->name}}</a>
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
                                        <label class="form-label"> الاجمالى</label>
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
                                        <label class="form-label" style="display: inline"> المبلغ  بعد الخصم</label>
                                            <input type="text" class="form-control" name="total" id="total" readonly>
                                    </div>
                                </div>
                            </fieldset>
                            </div>
                        </div>

                    <div class="col-sm-12 col-xs-12 card text-right" >
                        <button type="button" class="btn btn-purple waves-effect w-md m-b-5">فاتوره جديده</button>
                        <button type="button" class="btn btn-info waves-effect w-md m-b-5"> دفع</button>

                        <button type="submit" class="btn btn-inverse waves-effect w-md m-b-5">حفظ</button>
                            <button type="button" class="btn btn-danger waves-effect w-md m-b-5">طباعه</button>

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
     //**************  category click ***********************
     var  rowNum=0;
     $(".category_btn").on('click', function(e) {
         e.preventDefault();
         var id=$(this).data('id');
         $.ajax({
             url:"/dashboard/getAllSubcategoriesSale/"+id,
             type:"get",
         }).done(function (data) {
             $('.categories').empty();
             $('.categories').html(data.data);
             //**************   subcategory click ***********************

                $(".subcategory_btn").on('click', function(e) {
                 e.preventDefault();
                 var id=$(this).data('id');
                 $.ajax({
                     url:"/dashboard/getAllMeals/"+id,
                     type:"get",
                 }).done(function (data) {

                     $('.categories').empty();
                     $('.categories').html(data.data);
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
								<input type="number" placeholder="الكمية" step="1" min="1" value="1" id="sale" class="form-control" name="quantity[${meal_id}]">
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
                             var quantityXprice = Number(meal_price) * Number(theQuantity);
                             $(this).parents('.single-row-wrapper').find(".meal_price").text(quantityXprice);

                         });
                         $('.counter').html(rowNum);
                         //****************** Calc function************************
                         function calcInfo() {
                             var AmountBeforeDiscount = 0;
                             $(".meal_price").each(function () {
                                 AmountBeforeDiscount += Number($(this).text());
                             });
                             $("#AmountBeforeDiscount").val(AmountBeforeDiscount.toFixed(2));
                             $("#total").val(AmountBeforeDiscount.toFixed(2));

                             $("#discount").change(function() {
                                 var discount=$(this).val();

                                 var discount_val= Number(AmountBeforeDiscount) * (Number(discount) / 100);
                                 $("#total").val(Number(AmountBeforeDiscount)-Number(discount_val));

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
     });

$(".reload").click(function () {

 $.ajax({
             url:"/dashboard/getAllcategoriesSale/",
             type:"get",
         }).done(function (data) {
         $('.cat').empty().append();
        $('.cat').html(data.data);
         });



});
    </script>

@endsection
