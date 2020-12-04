@extends('admin.layout.master')
@section('title','إدارةالدليل المحاسبى')
@section('styles')

{{-- <link href="{{asset('admin/assets/css/easyTree.min.css')}}" rel="stylesheet" type="text/css"> --}}
<link href="{{asset('admin/assets/plugins/jstree/style.css')}}" rel="stylesheet" type="text/css" />

.tab-content {
width: 100%;
}
@endsection
@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.accounts.create')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light">
                   إضافة  حساب جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>

            <h4 class="page-title"> الدليل المحاسبى</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل  الدليل المحاسبى</h4>
                <ul class="nav nav-tabs">
                    <li><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1"> شجرة الحسابات</a></li>
                    <li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2"> الحسابات </a></li>
                </ul>
                <div class="tab-content col-md-4">
                    <div role="tabpanel" id="menu1" class="tab-pane active">
                        <div id="dragTree">
                            <ul>
                            {!! MyHelper::tree($accounts_main) !!}
                            </ul>

                        </div>
                    </div>


                    <div role="tabpanel" id="menu2" class="tab-pane">
                    <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>الإسم</th>
                            <th>الكود</th>
                            <th>نوع الحساب</th>
                            <th>  رقم المستوى</th>
                            <th>الرصيد</th>
                            <th style="width: 250px;" >العمليات المتاحة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($accounts as $row)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$row->name}}</td>
                                <td>{{$row->code}}</td>
                                <td>
                                    @if($row->type=='main')
                                    مستوى اول
                                    @elseif($row->type=='following_main')
                                        مستوى تابع
                                    @elseif($row->type=='sub')
                                        مستوى اخيير
                                    @endif
                                </td>
                                <td>{{ all_levels($row->level) }}</td>
                                <td>{{$row->amount}}</td>
                                <td>
                                    <a href="{{route('dashboard.accounts.show',$row->id)}}" class="label label-primary">عرض</a>
                                    <a href="{{route('dashboard.accounts.statement',$row->id)}}" class="label label-success">  كشف  حساب </a>
                                    <a href="{{route('dashboard.accounts.edit',$row->id)}}" class="label label-warning">تعديل</a>
                                    <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف" class="label label-danger"> حذف</a>
                                    {!!Form::open( ['route' => ['dashboard.accounts.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                                    {!!Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>



    </div>
    </div>
@endsection

@section('scripts')

            {{-- @include('admin.layout.dataTable') --}}
{{--

            <script type="text/javascript" src="{{asset('admin/assets/js/easyTree.js')}}"></script>
                <script>
                    (function ($) {
                        function init() {
                            $('.easy-tree').EasyTree();
                        }
                        window.onload = init();
                    })(jQuery)
                </script> --}}


                <script src="{{asset('admin/assets/plugins/jstree/jstree.min.js')}}"></script>
                <script src="{{asset('admin/assets/pages/jquery.tree.js')}}"></script>


            <script>
                function Delete(id) {
                    var item_id=id;
                    console.log(item_id);
                    swal({
                        title: "هل أنت متأكد ",
                        text: "هل تريد حذف هذا الحساب ؟",
                        icon: "warning",
                        buttons: ["الغاء", "موافق"],
                        dangerMode: true,

                    }).then(function(isConfirm){
                        if(isConfirm){
                            document.getElementById('delete-form'+item_id).submit();
                        }
                        else{
                            swal("تم االإلفاء", "حذف  الحساب  تم الغاؤه",'info',{buttons:'موافق'});
                        }
                    });
                }
            </script>


@endsection
