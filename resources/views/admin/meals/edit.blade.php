@extends('admin.layout.master')
@section('title','تعديل الوجبة')

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
            <h4 class="page-title">تعديل الوجبة</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات الوجبة: {{$meal->ar_name}}</h4>

                <div class="row">

                    {!!Form::model($meal, ['route' => ['dashboard.meals.update' , $meal->id] , 'method' => 'PATCH' ,'files'=>true]) !!}
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
        $('#check-all').change(function () {
            $("input:checkbox").prop("checked", $(this).prop("checked"))
        })
    </script>
    <script>
        $('body').delegate('#addProduct','click', function(){


            var product_name   = $('#product').find("option:selected").attr('data-name');
            var product_id = $('#product').find("option:selected").val();
            var deleteId = "removeProduct"+product_id;
            var trId = "tr"+product_id;

            var qty = $('#qty').val();
            var price = $('#price').val();

            if(product_name == null || qty <= 0 || qty == "" ){
                $('#addProduct').attr('disabled')==true;
            }else {
                $('#addProduct').attr('disabled')==false;
                $('#productsTable > tbody:last-child').append(
                    '<tr id="'+trId+'">' +
                    '<td>' + product_name + '</td>'+
                    '<td>' + qty + '</td>'+
                    '<td>' +
                    '<a href="javascript:;" id="' +deleteId +'" data-id="'+product_id+'"  class="removeProduct btn btn-danger waves-effect waves-light btn-xs m-b-5">'+'حذف'+'</a>' + '</td>'+
                    '<input type="hidden" name="products[]" value="' + product_id + '" />' +
                    '<input type="hidden" name="qtys[]" value="' + qty + '" />' +
                    '</tr>');

                $('#product').prop('selectedIndex',0);
                $('#qty').val('');
            }

        });


        $('body').on('click', '.removeProduct', function () {
            var id = $(this).attr('data-id');
            var tr = $(this).closest($('#removeProduct' + id).parent().parent());

            tr.find('td').fadeOut(500, function () {
                tr.remove();
            });
        });

        $('#product').change(function () {
            var id = $(this).val();
            $.ajax({
                type: 'POST',
                url: '{{ route('dashboard.meals.getAjaxProductQty') }}',
                data: {id: id},
                dataType: 'json',
                success: function (data) {
                    $('#qty').attr("data-parsley-max",data.data);
                    $('#qty').attr("data-parsley-max-message","الكمية غير متاحة "+data.data);
                }
            });
        });



    </script>



@endsection
