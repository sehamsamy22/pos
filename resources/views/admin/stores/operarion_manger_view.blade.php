@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('styles')
    <style>
        @media print {
        .row{
            display: none;
        }
            .meals{
                display:block ;

            }

        }
    </style>

@endsection
@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">
            <h4 class="page-title"> شاشة  مسئول التشغيل  </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <form action="" method="get" accept-charset="utf-8" >
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
                <div class="clearfix"></div>
                            <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الوجبة</th>
                                    <th>الكميه تم تجهزيها</th>
                                    <th>العمليات </th>

                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @foreach($readymeals as $row)
                                  <form id="form-{{$row->id}}" >
                                   @csrf
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->meal->ar_name}}</td>
                                        <td><input type='number' class="form-control" name='quantity' value={{$row->quantity}}  readonly></td>
{{--                                        <td><input type='number' class="form-control" name='received_quantity' value={{$row->received_quantity}} id='received_quantity{{$row->id}}' readonly></td>--}}
{{--                                        <td><input type='number' class="form-control" name='distributed_quantity' value={{$row->distributed_quantity}}  id='distributed_quantity{{$row->id}}' readonly></td>--}}
                                        <td class="operation_btn{{$row->id}}">
                                            @if($row->received=='0')
                                               <button type="submit" class="btn btn-danger submit_btn_received"  data-id="{{$row->id}}" id="submit_btn_received{{$row->id}}">استلام</button>
                                            @else
                                               <button type="button" class="btn btn-success"> تم الاستلام</button>
                                           @endif
                                                @if($row->distributed=='0')
                                                <button type="submit" class="btn btn-primary  submit_btn_distributed"  data-id="{{$row->id}}" id="submit_btn_distributed{{$row->id}}" >   توزيع فى الاكياس</button>
                                                @else
                                                    <button type="button" class="btn btn-success"> تم التوزيع</button>
                                                @endif
                                                <button type="button" class="btn btn-purple print" id="{{$row->id}}" style="margin-right:0px;" > طباعة</button>
                                        </td>
                                    </tr>
                                    </form>
                                  <div>

                                  </div>
                                @endforeach
                                </tbody>
                            </table>


    </div>
    </div>
    </div>
        <div class="meals" style=""></div>
@endsection

@section('scripts')
    <script>
            $(".submit_btn_received").click(function(e) {
                e.preventDefault();
                var id = $(this).data("id");
                var csrf = "{{ csrf_token() }}";
                $.ajax({
                    type: "POST",
                    data: {"_token":csrf},
                    url:"/dashboard/receive_meals/"+id,
                    success: function(data)
                    {
                        if(data.status='true'){
                            swal("  تم الاستلام", " تم استلام الوجبات من المطبخ", 'success', {
                                    buttons: 'موافق'
                            });
                            $('#submit_btn_received'+id).remove();
                            var x = document.createElement("INPUT");
                            x.setAttribute("type", "button");
                            x.setAttribute("value", "تم الاستلام");
                            x.setAttribute("class", "btn btn-success");
                            document.getElementsByClassName("operation_btn"+id)[0].appendChild(x);
                            $('#received_quantity'+id).val(data.received_quantity);

                        }else if(data.status='false'){
                          swal("   ", " الكميه غير متوفره الان بالمخزن", 'danger', {
                                    buttons: 'موافق'
                                });
                        }
                    }
                });
            });

            $('.submit_btn_distributed').click(function(e) {

                e.preventDefault();
                var id = $(this).data("id");
                console.log(id);
                var csrf = "{{ csrf_token() }}";
                $.ajax({
                    type: "POST",
                    data: {"_token":csrf},
                    url:"/dashboard/distributed_meals/"+id,
                    success: function(data)
                    {
                        if(data.status='true'){
                            swal("  تم التوزيع", "تم توزيع الوجبات  فى الاكياس ", 'success', {
                                    buttons: 'موافق'
                            });
                            $('#submit_btn_distributed'+id).remove();
                            var xx = document.createElement("INPUT");
                                    xx.setAttribute("type", "button");
                                    xx.setAttribute("value", "تم التوزيع");
                                    xx.setAttribute("class", "btn btn-success");
                               document.getElementsByClassName("operation_btn"+id)[0].appendChild(xx);
                            $('#distributed_quantity'+id).val(data.distributed_quantity);

                        }
                    }
                });
            });

    </script>
            <script>
                $(".print").click(function(e) {
                    var id = $(this).attr("id");
                    var from=$('#from').val();
                    var to=$('#to').val();
                    $.ajax({
                        type: "get",
                        data: {"from":from,'to':to},
                        url:"/dashboard/meal_print/"+id,
                        success: function(data)
                        {
                            $('.products').empty();
                         $('.products').append(data.data);
                            $('.products').hide();
                        }
                    });
                })
            </script>

@endsection
