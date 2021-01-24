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
                        <th>النوع </th>
                        <th>العملية   </th>
                        <th>تاريخ العملية  </th>

                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1;
                        $purchases=0;
                        $sales=0;
                        $sanad=0;
 @endphp
                    @foreach($logs as $row)
                        @if( isset($row->purchase->id ))
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->product->ar_name}}</td>
                            <td>
                                @if($row->operation=='purchases')
                               مشتريات
                                @elseif($row->operation=='sales')
                                   مبيعات
                                @else
                                    سند اخراج
                                @endif
                            </td>

                            <td>
                                @if($row->operation=='purchases')
                                    @php($purchases+=$purchases+$row->quantity)
                                +{{$row->quantity}}

                                @elseif($row->operation=='sales')
                                    @php($sales+=$sales+$row->quantity)

                                    -{{$row->quantity}}
                                @else
                                    @php($sanad+=$sanad+$row->quantity)

                                    -{{$row->quantity}}
                                @endif
                            </td>
                            <td>
                                @if($row->operation=='purchases')

                              <a href="{{route('dashboard.purchases.show',$row->bill_id)}}">
                                    تم الشراء  بفاتوره مشتريات رقم {{ $row->purchase->InvoiceNumber??'' }}
                            </a>
                            @elseif($row->operation=='sales')
                            <a href="{{route('dashboard.sales.show',$row->bill_id)}}">
                                تم البيع  بفاتوره مبيعات رقم {{ $row->sale->InvoiceNumber??'' }}
                             </a>
                             @else
                             <a href="{{route('dashboard.revenues.store_out_sanad_show',$row->id)}}">
                             تم اخراج الكمية من المخزن بسند اخراج
                             </a>
                             @endif
                            </td>
                            <td>{{$row->created_at}}</td>

                        </tr>
                        @endif
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <td colspan="3">
                            <label class="label label-danger"> اجمالى كميات المشتريات </label>
                        </td>
                        <td>+{{$purchases}}</td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td colspan="3">
                            <label class="label label-danger"> اجمالى كميات المبيعات </label>
                        </td>
                        <td>+{{$sales}}</td>
                        <td></td>
                        <td></td>

                    </tr>
                    <tr>
                        <td colspan="3">
                            <label class="label label-danger"> اجمالى كميات الاخراج من المخزن </label>
                        </td>
                        <td>+{{$sanad}}</td>
                        <td></td>

                        <td></td>
                    </tr>
                    </tfoot>
                </table>



    </div>
    </div>
@endsection
