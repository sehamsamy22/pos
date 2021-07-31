@extends('admin.layout.master')
@section('title','تعديل المنتج')

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
            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.products.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لإدارة المنتجات <span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">تعديل المنتج</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات المنتج: {{$product->ar_name}}</h4>

                <div class="row">

                    {!!Form::model($product, ['route' => ['dashboard.products.update' , $product->id] , 'method' => 'PATCH' ,'files'=>true]) !!}
                    @include('admin.products.form')
                    {!!Form::close() !!}

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')
{{--    @include('admin.layout.form_validation_js')--}}
    <script>
        $("#category_id").on('change', function() {
            var id = $(this).val();
            $.ajax({
                url:"/dashboard/getAllSubcategories/"+id,
                type:"get",
            }).done(function (data) {
                $('.subcategories').empty();
                $('.subcategories').html(data.data);
            }).fail(function (error) {
                console.log(error);
            });
        });
    </script>
    <script>
        var bigDataComponent = [];
        function myFun2(event) {
            event.preventDefault();
            var component_data = {};
            component_data.component_name = $('#component_name option:selected').text();
            component_data.component_name_val = $('#component_name').val();
            component_data.component_quantity = $('#component_quantity').val();
            component_data.component_unit = $('#component_name option:selected').data('unit');
            component_data.component_price = $('#component_name option:selected').data('price');
            component_data.component_avgcost= $('#component_name option:selected').data('avgcost');
            component_data.Approx_price=Number(component_data.component_quantity *component_data.component_avgcost);
            if (component_data.component_name !== '' && component_data.component_quantity !== '' ) {
                // $("tr.editted-row").remove();
                swal({
                    title: "تم إضافة  المكون بنجاح",
                    text: "",
                    icon: "success",
                    buttons: ["موافق"],
                    dangerMode: true,
                })
               console.log(component_data.Approx_price);
                bigDataComponent.push(component_data);
                $("#componentTable-wrap").show();
                var  unit;
                console.log($("#total").val());
                var TotalValue=$("#total").val();
                console.log(TotalValue);
                var appendComponent = bigDataComponent.map(function(component) {
                    TotalValue = Number(TotalValue)+component.Approx_price ;
                    return (`
            <tr class="single-product">
                <td class="component-name">${component.component_name}</td>
                <td class="component-qty">${component.component_quantity}</td>
                <td class="component-unit">${component.component_unit}</td>
                 <td class="component-avgcost">${component.component_avgcost}</td>
              <td>
                <a href="#" data-toggle="tooltip" class="delete-this-row-component" data-original-title="حذف">
                    <i class="fa fa-trash-o" style="margin-left: 10px"></i>
                </a>
            </td>
        <input type="hidden" name="component_names[]" value="${component.component_name_val}" >
        <input type="hidden" name="qtys[]" value="${component.component_quantity}" >
        <input type="hidden" name="avg_cost[]" value="${component.component_avgcost}">
            </tr>
            `);

                });
                // $('.single-product').remove();
                $('.add-components').append(appendComponent);
                $(".Approx_price").html(TotalValue);
                 $("#total").val(TotalValue.toFixed(2));
                // console.log(TotalValue);
                /////////////////////////////////////////////////////
                $('.delete-this-row-component').click(function(e) {
                    var $this = $(this);
                    var row_index_component = $(this).parents('tr').index();
                    e.preventDefault();
                    swal({
                        title: "هل أنت متأكد ",
                        text: "هل تريد حذف هذا  المكون؟",
                        icon: "warning",
                        buttons: ["الغاء", "موافق"],
                        dangerMode: true,
                    }).then(function(isConfirm) {
                        if (isConfirm) {
                            $this.parents('tr').remove();
                            bigDataComponent.splice(row_index_component, 1);
                        } else {
                            swal("تم االإلفاء", "حذف  المكون تم الغاؤه", 'info', {
                                buttons: 'موافق'
                            });
                        }
                    });
                });
                $('.edit-this-row-component').click(function(e) {
                    var $this = $(this);
                    e.preventDefault();
                    // alert($('#main_unit option:selected').text());
                    // $this.parents('tr').addClass('editted-row');
                    $('#exampleModal #component_name').val($('.component_name option:selected').text());
                    $('#exampleModal #component_quantity').val($this.parents('tr').find('.component-qty').html());
                    $('#exampleModal #main_unit').val($('#main_unit option:selected').text());
                    var row_index_edit_component = $(this).parents('tr').index();
                    bigDataComponent.splice(row_index_edit_component, 1);
                });
                document.getElementById("component_name").val = " ";
                document.getElementById("component_quantity").val = " ";



            } else {
                swal({
                    title: "من فضلك قم بملئ كل البيانات المميزة بالعلامة الحمراء",
                    text: "",
                    icon: "warning",
                    buttons: ["موافق"],
                    dangerMode: true,
                })
            } ///if_end
        }

    </script>
    <script>
        function Delete(id) {
            // var id=id;
            // var id = $(this).data('id');
            $.ajax({
                type: 'get',
                url: '{{ route('dashboard.products-products.destroy') }}',
                data: {id: id},
                dataType: 'json',
                success: function (data) {

                    document.getElementById("single-product"+id).remove();

                    swal("تم الحذف", "تم  حذف المكون", 'danger', {
                        buttons: 'موافق',
                        dangerMode: true,

                    });


                       }
            });
        };
    </script>
    <script>
        $("#component_name").on('change', function() {
            var id = $(this).val();
            $.ajax({
                url:"/dashboard/getProduct/"+id,
                type:"get",
            }).done(function (data) {

                // var unit_val;
                // if(data.data=='kilo'){
                //     unit_val='كيلو'  ;
                // }else if(data.data=='gram'){
                //     unit_val='جرام'  ;
                // }else{
                //     unit_val='لتر'  ;
                // }
                console.log(data);
                $('#unit').val(data.data);
            }).fail(function (error) {
                console.log(error);
            });
        });
    </script>

@endsection
