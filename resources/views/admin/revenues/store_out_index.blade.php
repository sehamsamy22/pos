@extends('admin.layout.master')
@section('title','إدارة المدفوعات والايردات')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

                     <div class="btn-group pull-right m-t-15">
                        <a href="{{route('dashboard.revenues.store_out')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light">
                        إضافة  سند اخراج جديد
                            <span class="m-l-5"><i class="fa fa-plus"></i></span>
                        </a>
                    </div>

                    <h4 class="page-title"> سندات الاخراج من المخازن</h4>
                </div>





            </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل سندات الاخراج</h4>
                <form action="{{ route('dashboard.revenues.store_out_filter') }}" method="post" accept-charset="utf-8" >
                    @csrf
                  <div class="form-group col-sm-4">
                      <label for="from"> الفترة من </label>
                      {!! Form::date("from",request('from'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from'])!!}
                  </div>
                  <div class="form-group col-sm-4">
                      <label for="to"> الفترة إلي </label>
                      {!! Form::date("to",request('to'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة إلي ',"id"=>'to'])!!}
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

                        <th>نوع السند</th>
                        {{-- <th> المبلغ</th> --}}
                        <th> تاريخ الدفع</th>
                        <th style="width: 250px;" >العمليات المتاحة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($revenues as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                              اخراج من المخزن
                            </td>
                            {{-- <td>{{$row->amount}}</td> --}}
                            <td>{{$row->date}}</td>
                            <td>
                                <a href="{{route('dashboard.revenues.store_out_sanad_show',$row->id)}}" class="label label-warning">التفاصيل</a>
                                {{-- <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف" class="label label-danger"> حذف</a> --}}
                                {!!Form::open( ['route' => ['dashboard.revenues.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                                {!!Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                        <th colspan="3">اجمالى المبالع</th>
                        <th>{{ $sum }}</th>
                        <th colspan="2"> </th>
                    </tfoot>
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
