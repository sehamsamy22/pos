@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> عرض طلبيات الاصناف اليوميه  </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                    <?php
                   use Carbon\Carbon;
                    $now = Carbon::now()->format("Y-m-d");
                    ?>
                <h4 class="header-title m-t-0 m-b-30">    كل  الاصناف المطلوب شرائها اليوم  {{$now}} </h4>


                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم الصنف</th>
                        <th>الكميه المتوفرة</th>
                        <th>الكمية المطلوبه  </th>
                        <th>الحالة </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($storeproducts as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->product->ar_name}}</td>
                            <td>{{$row->quantity}}</td>
                         
                            <td>{{$row->product->orders($row->product->id)}}</td>
                            <td> 
                            @if($row->quantity > $row->product->orders($row->product->id))
                                <label class="label label-success">زياده=</label>
                                {{$row->quantity - $row->product->orders($row->product->id)}}
                             @elseif($row->quantity < $row->product->orders($row->product->id))
                                 <label class="label label-danger">نقص=</label>
                              {{ $row->product->orders($row->product->id)-$row->quantity }}
                              
                            @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>



    </div>
    </div>
@endsection
