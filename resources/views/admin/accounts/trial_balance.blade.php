@extends('admin.layout.master')
@section('title','إدارة الدليل المحاسبى')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> ميزان المراجعة </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30"> ميزان المراجعة</h4>
                <section class="filter">
                    <div class="yurSections">
                        <div class="row">

                            <form action="" method="get" accept-charset="utf-8" >
                                @csrf

                              <div class="form-group col-sm-4">
                                  <label for="from"> الفترة من </label>
                                  {!! Form::date("from",request('from'),['class'=>' form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from'])!!}
                              </div>
                              <div class="form-group col-sm-4">
                                  <label for="to"> الفترة إلي </label>
                                  {!! Form::date("to",request('to'),['class'=>' form-control inline-control','placeholder'=>' الفترة إلي ',"id"=>'to'])!!}
                              </div>

                              <div class="form-group col-sm-4">
                                 <label for="">   </label>
                                  <button type="submit" class="btn btn-success btn-block">بحث</button>
                              </div>
                              </form>
                        </div>
                    </div>
                </section>

                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> رقم الحساب </th>
                        <th> اسم الحساب </th>
                        <th>الرصيد الافتتاحى </th>
                       <th> مجموع المدنين </th>
                       <th> مجموع الدائنين </th>
                        <th> الرصيد </th>
                        <th> كشف حساب </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($accounts as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>
                        <td>{!! $row->code!!}</td>
                        <td>{!! $row->name!!}</td>
                        <td>{!! $row->openning_balance($row->id,$request)!!}</td>
                        <td>{!! $row->debtor_balance($row->id,$request)!!}</td>
                        <td>{!! $row->creditor_balance($row->id,$request)!!}</td>
                        <td>   {{ $row->openning_balance($row->id,$request)+$row->debtor_balance($row->id,$request)-$row->creditor_balance($row->id,$request) }} </td>
                        <td><a href="{{route("dashboard.accounts.statement",$row->id)}}"><label class="label label-danger">عرض</label></a></td>

                    </tr>

                @endforeach
                    </tbody>
                </table>
    </div>
    </div>
@endsection

@section('scripts')

<script>
    $(document).ready(function () {
        $('.js-example-basic-single').select2();


    });
</script>



@endsection
