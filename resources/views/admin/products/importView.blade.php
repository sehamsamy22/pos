@extends('admin.layout.master')
@section('title','إنشاء  صنف جديد')

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
                <a href="{{route('dashboard.products.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" > رجوع لإدارة الأصناف والمواد الخام<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">إضافة صنف جديد</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 m-b-30">بيانات  الصنف</h4>

                <div class="row">



                    {!!Form::open( ['route' => 'dashboard.products.importProduct' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}

                    <div class="form-group col-xs-12 pull-left">
                        <input type="file" name="file" class="form-control">
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
@endsection
