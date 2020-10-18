@extends('admin.layout.master')
@section('title','إنشاء  وجبة جديد')

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
                <a href="{{route('dashboard.meals.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لإدارة المنتجات والوجبات<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">إضافة وجبة جديد</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 m-b-30">بيانات  الوجبة</h4>

                <div class="row">



                    {!!Form::open( ['route' => 'dashboard.meals.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}


                    @include('admin.meals.form')


                    {!!Form::close() !!}





                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')

    @include('admin.layout.form_validation_js')
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
        $("#componentTable-wrap").show();

        function myFun2(event) {
            event.preventDefault();
            var component_data = {};
            component_data.component_name = $('#component_name option:selected').text();
            component_data.component_name_val = $('#component_name').val();
            component_data.component_quantity = $('#component_quantity').val();
            component_data.component_unit = $('#component_name option:selected').data('unit');
            component_data.component_price = $('#component_name option:selected').data('price');
            component_data.Approx_price = Number(component_data.component_quantity *component_data.component_price);

            if (component_data.component_name !== '' && component_data.component_quantity !== '' ) {
                $("tr.editted-row").remove();
                swal({
                    title: "تم إضافة  المكون بنجاح",
                    text: "",
                    icon: "success",
                    buttons: ["موافق"],
                    dangerMode: true,
                })

                bigDataComponent.push(component_data);
                $("#componentTable-wrap").show();
                var  unit;
                var TotalValue=0;
                var appendComponent = bigDataComponent.map(function(component) {
                    TotalValue += parseFloat(component.Approx_price) ;
                    if(component.component_unit=='kilo'){
                    unit ='كيلو';
                    }else if(component.component_unit=='gram'){
                         unit='جرام';
                    }else{
                        unit='لتر';
                    }
                    return (`
            <tr class="single-product">
                <td class="component-name">${component.component_name}</td>
                <td class="component-qty">${component.component_quantity}</td>
                <td class="component-unit">${unit}</td>
              <td>

                <a href="#" data-toggle="tooltip" class="delete-this-row-component" data-original-title="حذف">
                    <i class="fa fa-trash-o" style="margin-left: 10px"></i>
                </a>
            </td>
        <input type="hidden" name="component_names[]" value="${component.component_name_val}" >
        <input type="hidden" name="qtys[]" value="${component.component_quantity}" >

            </tr>
            `);

                });
                $('.add-components').empty().append(appendComponent);

                $(".Approx_price").html(TotalValue);
                $("#total").val(TotalValue);
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
                    $this.parents('tr').addClass('editted-row');
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
        $("#component_name").on('change', function() {
            var id = $(this).val();
            $.ajax({
                url:"/dashboard/getProduct/"+id,
                type:"get",
            }).done(function (data) {

               var unit_val;
               if(data.data=='kilo'){
                   unit_val='كيلو'  ;
               }else if(data.data=='gram'){
                   unit_val='جرام'  ;
               }else{
                   unit_val='لتر'  ;
               }
                $('#unit').val(unit_val);
            }).fail(function (error) {
                console.log(error);
            });
        });
    </script>
@endsection
