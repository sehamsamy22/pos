@extends('admin.layout.master')
@section('title','إدارة المنتجات والوجبات')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.products.create')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light">
                   إضافة  منتج جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>

            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.products.importViewMeal')}}" class="btn btn-success">
                    رفع الوجبات من ملف
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>
            <h4 class="page-title">عرض المنتجات والوجبات</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل  المنتجات  </h4>


                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>الإسم </th>
                        <th>الباركود </th>
                        <th>الاحجام </th>
                        <th>  الصورة</th>
                        <th style="width: 250px;" >العمليات المتاحة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($products as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->ar_name}}</td>
                            <td>{{$row->barcode}}</td>
                            <td>
                                <a class="btn btn-danger" href="{{route('dashboard.sizes.show',$row->id)}}">{{$row->sizes->count()}}</a>
                            </td>
                            <td><img src="{!! getimg($row->image)!!}" style="width:100px; height:100px"> </td>
                            <td>
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
                        text: "هل تريد حذف هذا الصنف ؟",
                        icon: "warning",
                        buttons: ["الغاء", "موافق"],
                        dangerMode: true,

                    }).then(function(isConfirm){
                        if(isConfirm){
                            document.getElementById('delete-form'+item_id).submit();
                        }
                        else{
                            swal("تم االإلفاء", "حذف  المستخدم  تم الغاؤه",'info',{buttons:'موافق'});
                        }
                    });
                }
            </script>


@endsection
