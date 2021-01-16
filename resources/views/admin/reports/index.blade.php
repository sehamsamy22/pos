@extends('admin.layout.master')
@section('title','تقرير الايردات')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">



            <h4 class="page-title"> تقرير إيردات النظام</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">    إجمالى المبيعات والاشتركات </h4>
                <form action="" method="get" accept-charset="utf-8" >
                    @csrf
                  <div class="form-group col-sm-4">
                      <label for="from">  التاريخ </label>
                      {!! Form::date("date",request('date'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from'])!!}
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
                        <th>  اجمالى الايردات</th>
                        <th>   اجمالى المصروفات</th>
                        <th>   اجمالى الربح </th>
                        <th style="width: 250px;" >العمليات المتاحة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp

                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$data['incomes']}}</td>
                            <td> {{$data['purchases']}}</td>
                            <td> {{$data['profit']}}</td>
                            <td>
                                <a href="{{route('dashboard.reports.show',request('date')??Carbon\Carbon::today())}}" class="label label-warning"> تفاصيل </a>
                            </td>
                        </tr>
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
