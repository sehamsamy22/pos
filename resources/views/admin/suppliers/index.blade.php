@extends('admin.layout.master')
@section('title','إدارة   الموردين')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.suppliers.create')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light">
                   إضافة  مورد جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>
            <h4 class="page-title">عرض الموردين</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل جميع  الموردين المتاحة بالنظام </h4>
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>

                        <th>  الاسم </th>
                        <th>  الجوال </th>
                        <th>  العنوان </th>
                        <th>  الرصيد الافتتاحى </th>

                        <th style="width: 250px;" >العمليات المتاحة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($suppliers as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->name}}</td>
                            <td>{{$row->phone}}</td>
                            <td>{{$row->address}}</td>
                            <td>{{$row->amount}}</td>
                            <td>
                                <a href="{{route('dashboard.suppliers.edit',$row->id)}}" class="label label-warning">تعديل</a>
                                <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف" class="label label-danger"> حذف</a>
                                {!!Form::open( ['route' => ['dashboard.suppliers.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                        text: "هل تريد حذف هذا المورد ؟",
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
