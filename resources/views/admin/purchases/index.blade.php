@extends('admin.layout.master')
@section('title','إدارة المشتريات')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.purchases.create')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light">
                   إضافة  قاتورة مشتريات جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>

            <h4 class="page-title">عرض فواتير المشتريات</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل  فواتير المشتريات </h4>

                <form action="{{ route('dashboard.purchases.filter') }}" method="post" accept-charset="utf-8" >
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
                        <th>رقم الفاتوره</th>
                        <th>تاريخ الفاتوره</th>
                        <th> اسم المورد</th>
                        <th>  اجمالى الفاتوره</th>
                        <th> المدفوع</th>
                        <th> المتبقى</th>

                        <th style="width: 250px;" >العمليات المتاحة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($purchases as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->InvoiceNumber}}</td>
                            <td>{{$row->date}}</td>
                            <td>{{$row->supplier->name ?? ''}}</td>
                            <td>{{$row->total}}</td>
                            <td>{{$row->payed}}</td>
                             <td>{{$row->reminder}}</td>

                            <td>
                                <a href="{{route('dashboard.purchases.show',$row->id)}}" class="label label-warning">عرض الفاتوره</a>
                                <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف" class="label label-danger"> حذف</a>
                                {!!Form::open( ['route' => ['dashboard.purchases.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
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
                        text: "هل تريد حذف هذة الفاتورة ؟",
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
            <script>
                @if(!empty(\Illuminate\ Support\ Facades\ Session::has('purchase_id')))
                @php($purchase_id = \Illuminate\ Support\ Facades\ Session::get('purchase_id'))
                window.open(
                    "{{route('dashboard.purchases.show',$purchase_id)}}",
                    "_blank"
                ).print();
                @endif
            </script>


@endsection
