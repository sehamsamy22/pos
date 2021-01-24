@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> شاشة مسئول المخزن </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                          <h4 class="header-title m-t-0 m-b-30">    كل  الاصناف المطلوب شرائها للتحضير غدا  </h4>


                            <form action="" method="post" accept-charset="utf-8" >
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
                        <th>اسم الصنف</th>
                        <th>كود الصنف</th>
                        <th> متوسط التكلفة</th>
                        <th>الكميه المتوفرة</th>
                        <th>الكمية المطلوبه  </th>
                        <th>الحالة </th>
                        <th>عرض بيانات الصنف </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @php($value = session('key') )
                    @foreach($storeproducts as $row)
                        @if($row->product->orders($row->product->id ,$request ?? Null)!=0)
                            @if($value ==0)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->product->ar_name}}</td>
                            <td>{{$row->product->barcode}}</td>
                            <td>{{round($row->product->avg_cost() ,3)}}</td>
                            <td>{{$row->quantity}}</td>
{{--                            @dd($row->product->orders($row->product->id,$request))--}}
                                @if($request)
                                <td>{{$row->product->orders($row->product->id,$request)}}</td>
                                <td>
                                @if($row->quantity > $row->product->orders($row->product->id,$request))
                                    <label class="label label-success">زياده=</label>
                                    {{$row->quantity - $row->product->orders($row->product->id,$request)}}
                                 @elseif($row->quantity < $row->product->orders($row->product->id,$request))
                                     <label class="label label-danger">نقص=</label>
                                  {{ $row->product->orders($row->product->id,$request)-$row->quantity }}

                                @endif
                                </td>
                                <td>
                                    <a href="{{route('dashboard.products.show',$row->product->id)}}" class="label label-primary">عرض</a>

                                </td>
                                @else
                                <td></td>
                                <td></td>

                                @endif



                        </tr>
                        @endif
                            @endif
                    @endforeach
                    </tbody>
                </table>




    </div>
    </div>
@endsection
        @section('scripts')
        <script>
            var name=<?php echo $value;?>;

        </script>
@endsection
