@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> عرض  جميع  عمليات البيع والشراء تمت على الصنف {{ $product->ar_name }} </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل  الاصناف</h4>

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
                        <th>اسم الصنف</th>
                        <th>الكميه </th>

                        <th>العملية   </th>
                        <th>تاريخ العملية  </th>

                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($logs as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->product->ar_name}}</td>

                            <td>
                                @if($row->operation=='purchases')
                                +{{$row->quantity}}
                                @else
                                    -{{$row->quantity}}
                                @endif
                            </td>
                            <td>
                                @if($row->operation=='purchases')
                              <a href="{{route('dashboard.purchases.show',$row->bill_id)}}">
                                    تم الشراء  بفاتوره مشتريات رقم {{ $row->purchase->num }}
                            </a>
                            @elseif($row->operation=='sales')
                            <a href="{{route('dashboard.sales.show',$row->bill_id)}}">
                                تم البيع  بفاتوره مبيعات رقم {{ $row->sale->num }}
                             </a>
                             @else
                             <a href="{{route('dashboard.revenues.store_out_sanad_show',$row->id)}}">
                             تم اخراج الكمية من المخزن بسند اخراج
                             </a>
                             @endif
                            </td>
                            <td>{{$row->created_at}}</td>

                        </tr>
                    @endforeach
                    </tbody>
                </table>



    </div>
    </div>
@endsection
