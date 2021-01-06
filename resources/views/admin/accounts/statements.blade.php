@extends('admin.layout.master')
@section('title','إدارة الدليل المحاسبى')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> كشف حساب</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كشف حساب</h4>
                <section class="filter">
                    <div class="yurSections">
                        <div class="row">

                            <form action="" method="get" accept-charset="utf-8" >


                                <div class="form-group col-sm-3">
                                    <label for="from">  اختر الحساب </label>
                                    {!! Form::select("account_id",$accounts,Null,['class'=>'js-example-basic-single form-control inline-control','placeholder'=>' اختر الحساب '])!!}
                                </div>
                              <div class="form-group col-sm-3">
                                  <label for="from"> الفترة من </label>
                                  {!! Form::date("from",request('from'),['class'=>' form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from'])!!}
                              </div>
                              <div class="form-group col-sm-3">
                                  <label for="to"> الفترة إلي </label>
                                  {!! Form::date("to",request('to'),['class'=>' form-control inline-control','placeholder'=>' الفترة إلي ',"id"=>'to'])!!}
                              </div>

                              <div class="form-group col-sm-3">
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
                        <th> الكود </th>
                        <th> المصدر </th>
                        <th>النوع </th>
                       <th> التاريخ </th>
                       <th> الوصف </th>
                        <th> مدين </th>
                        <th> دائن </th>
                        <th> الرصيد </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($AccountEntries as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>

                            {!! $row->entry->code!!}
                        </td>
                        <td>
                            {!! $row->entry->source!!}
                        </td>
                        <td>
                            @if($row->entry->type=='manual')
                                يدوى
                            @else
                                الى
                            @endif
                        </td>
                        <td>{!! $row->entry->date!!}</td>
                        <td>{!! $row->entry->details!!}</td>
                        <td>
                            {{ $row->affect=='debtor'?$row->amount:'0' }}
                        </td>
                        <td>
                          {{   $row->affect=='creditor'?$row->amount:'0' }}
                        </td>
                        <td>
                            {{ $row->affect=='debtor'? $row->amount: 0-$row->amount}}

                        </td>


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
