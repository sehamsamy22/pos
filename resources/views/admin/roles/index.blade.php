@extends('admin.layout.master')
@section('title','إدارة الصلاحيات')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.roles.create')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light">
                   إضافة صلاحية جديدة
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>

            <h4 class="page-title">  الصلاحيات</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل  الصلاحيات </h4>


                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم المنصب</th>
                        <th>العمليات</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($roles as $key=>$role)
                        <tr>
                            <td>{{++$key}}</td>
                            <td>{{$role->name}}</td>
                            <td>
                                {{--                                    @if(!$role->hasAllPermissions(\Spatie\Permission\Models\Permission::all()))--}}
                                <a href="{{route('dashboard.roles.edit',$role->id)}}"
                                   class="btn btn-info btn-circle" data-original-title="تعديل">
                                    <i style="padding-top:5px;padding-left: 6px;" class="fa fa-pencil"></i>
                                </a>
                                {{--@endif--}}

                                @if(!$role->hasAllPermissions(\Spatie\Permission\Models\Permission::all()))
                                    @if( !auth()->user()->hasRole($role))
                                        <a href="#" onclick="Delete({{$role->id}})" data-toggle="tooltip"
                                           data-original-title="حذف" class="btn btn-danger btn-circle">
                                            <i style="padding-top: 5px;padding-left: 4px;" class="fa fa-trash-o"></i>
                                        </a>
                                        {!!Form::open( ['route' => ['dashboard.roles.destroy',$role->id] ,'id'=>'delete-form'.$role->id, 'method' => 'Delete']) !!}
                                        {!!Form::close() !!}
                                    @else
                                        <a href="#" disabled="disabled" class="btn btn-danger btn-circle">
                                            <i style="padding-top: 5px;padding-left: 4px;" class="fa fa-trash-o"></i>
                                        </a>
                                    @endif
                                @else
                                    <a href="#" disabled="disabled" class="btn btn-danger btn-circle">
                                        <i style="padding-top: 5px;padding-left: 4px;" class="fa fa-trash-o"></i>
                                    </a>
                                @endif

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
                        text: "هل تريد حذف هذا المستخدم ؟",
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
