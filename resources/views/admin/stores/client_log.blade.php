@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title"> عرض  جميع  عمليات التوصيل للعميلاء  </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل  العمليات</h4>

                <form action="" method="get" accept-charset="utf-8" >
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
                        <th>اسم العميل</th>
                        <th>اسم السائق</th>

                        <th>تاريخ العملية  </th>

                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($logs as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->client->name ??''}}</td>

                            <td>{{$row->user->name}}</td>


                            <td>{{$row->date}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>



    </div>
    </div>
@endsection
