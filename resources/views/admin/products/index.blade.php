@extends('admin.layout.master')
@section('title','إدارة الأصناف والمواد الخام')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.products.create')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light">
                   إضافة  صنف جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>

            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.products.importViewProduct')}}" class="btn btn-success">
                    رفع الاصناف من ملف
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>
            <h4 class="page-title">عرض الأصناف والمواد الخام</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل  الأصناف والموادالخام المكونه للوجبات </h4>
                <form action="" method="get" accept-charset="utf-8" >


                    <div class="col-sm-4 col-xs-4  pull-left">
                        <div class="form-group form-float">
                            <label class="form-label">   التصنيف الرئيسى</label>
                            <div class="form-line">
                                {!! Form::select("category_id",$categories,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر التصنيف الرئيسى  ','id'=>'category_id'])!!}

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-4 col-xs-4  pull-left subcategories">
                        <div class="form-group form-float">
                            <label class="form-label">   التصنيف الفرعى</label>
                            <div class="form-line">
                                {!! Form::select("sub_category_id",[],null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر التصنيف الرئيسى أولا  '])!!}
                            </div>
                        </div>
                    </div>

                    <div class="form-group col-sm-4">
                        <label for="">   </label>
                        <button type="submit" class="btn btn-success btn-block">بحث</button>
                    </div>
                </form>
                <div class="clearfix"></div>

                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>رقم الصنف</th>
                        <th>الإسم باللغة العربية</th>
                        <th>الإسم باللغة الانجليزية</th>
                        <th>  الباركود</th>
                        <th>  التصنيف الفرعى</th>
                        <th>  الوحدة</th>

                        <th style="width: 250px;" >العمليات المتاحة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($products as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->id}}</td>
                            <td>{{$row->ar_name}}</td>
                            <td>{{$row->en_name}}</td>
                            <td>{{$row->barcode ??''}}</td>
                            <td>{{$row->subcategory->name ??''}}</td>
                            <td>{{$row->units->name ??''}}</td>
                            <td>
                                <a href="{{route('dashboard.products.show',$row->id)}}" class="label label-primary">عرض</a>

                                <a href="{{route('dashboard.products.edit',$row->id)}}" class="label label-warning">تعديل</a>
                                <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف" class="label label-danger"> حذف</a>
                                {!!Form::open( ['route' => ['dashboard.products.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                                {!!Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>



    </div>
    </div>
@endsection

@section('scripts')

            @include('admin.layout.dataTable')

            <script>
                function Delete(id) {
                    var item_id=id;
                    console.log(item_id);
                    swal({
                        title: "هل أنت متأكد ",
                        text: "هل تريد حذف هذا المنتج ؟",
                        icon: "warning",
                        buttons: ["الغاء", "موافق"],
                        dangerMode: true,

                    }).then(function(isConfirm){
                        if(isConfirm){
                            document.getElementById('delete-form'+item_id).submit();
                        }
                        else{
                            swal("تم االإلفاء", "حذف  المنتج  تم الغاؤه",'info',{buttons:'موافق'});
                        }
                    });
                }
            </script>

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
