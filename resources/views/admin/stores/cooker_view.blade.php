@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> شاشة مسئول المطبخ </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <form action="" method="post" accept-charset="utf-8">
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
                        <label for=""> </label>
                        <button type="submit" class="btn btn-success btn-block">بحث</button>
                    </div>
                </form>
                <div class="clearfix"></div>


                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1"> استلام
                            الكميات </a></li>
                    <li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2"> تجهيز الوجبات </a></li>
                </ul>

                <div class="tab-content">

                    <div role="tabpanel" id="menu1" class="tab-pane active">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>

                                <th>#</th>
                                <th>اسم الصنف</th>
                                <th>الكميه المتوفرة</th>
                                <th>الكمية المطلوبه</th>
                                <th>الكمية المستلمة</th>
                                <th>استلام</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp

                            @foreach($storeproducts as $row)
                                <form id="form-{{$row->id}}">
                                    @csrf
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->product->ar_name}}</td>
                                        <td><input name="" type="number" class="form-control"
                                                   value={{$row->quantity}} readonly></td>
                                        <td><input type='number' class="form-control"
                                                   value={{$row->product->orders($row->product->id,$request??Null)}}  readonly>
                                        </td>
                                        <td>

                                            <input type='number' class="form-control" id="receivedquantity{{$row->id}}"
                                                   value="{{$row->product->recevied($row->product->id,$request??Null)}}"
                                                   readonly></td>
                                        <td class="received_btn{{$row->id}}">
                                            <input type='number' class="form-control" name="received_quantity"
                                                   id="received_quantity{{$row->id}}">
                                            <button type="submit" class="btn btn-danger received_submit "
                                                    id="{{ $row->id }}">استلام
                                            </button>
                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div role="tabpanel" id="menu2" class="tab-pane">
                        <table class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>اسم الوجبة</th>
                                <th>الكميه المطلوبة</th>
                                <th>الكميه تم تجيهزها</th>
                                <th>الحالة</th>
                            </tr>
                            </thead>
                            <tbody>
                            @php $i = 1; @endphp
                            {{--         @dd($meals)                           --}}
                            @foreach($meals as $row)
                                <form id="formready-{{$row->id}}">
                                    @csrf

                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->ar_name}}</td>
                                        <td><input type='number' class="form-control" name='quantity'
                                                   value={{$row->orders($row->id ,$request ?? Null) }}  readonly></td>
                                        <td><input type='number' class="form-control" id="readyquantity{{$row->id}}"
                                                   value="{{$row->readymeals($row->id ,$request ?? Null) }}" readonly>
                                        </td>

                                        <td class="ready_btn{{$row->id}}">
                                            <input type='number' class="form-control" id="ready_quantity{{$row->id}}">
                                            <button type="submit" class="btn btn-warning ready_submit"
                                                    id="{{$row->id}}">تجهيزوتحضير
                                            </button>

                                        </td>
                                    </tr>
                                </form>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @endsection

        @section('scripts')

            {{-- @include('admin.layout.form_validation_js') --}}

            <script>


                $(".received_submit").click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr("id");
                    var qty = $('#received_quantity' + id).val();

                    console.log(qty);
                    var csrf = "{{ csrf_token() }}";
                    $.ajax({
                        type: "POST",
                        url: "/dashboard/receive_products/" + id,
                        data: {"_token": csrf, "received_quantity": qty},
                        success: function (data) {
                            if (data.status = 'true') {
                                swal("  تم الاستلام", " تم استلام الاصناف من المخزن", 'success', {
                                    buttons: 'موافق'
                                });
                                $('#receivedquantity' + id).val(data.recevied);

                            } else if (data.status = 'false') {
                                swal("   ", " الكميه غير متوفره الان بالمخزن", 'danger', {
                                    buttons: 'موافق'
                                });
                            }
                        }
                    });


                });


                $('.ready_submit').click(function (e) {
                    e.preventDefault();
                    var id = $(this).attr("id");
                    var from = $('#from').val();
                    var to = $('#to').val();

                    console.log(id);
                    var qy = $("#ready_quantity" + id).val();
                    console.log(qy);
                    var csrf = "{{ csrf_token() }}";
                    $.ajax({
                        type: "post",
                        url: "/dashboard/ready_meals/" + id,
                        data: {"_token": csrf, "quantity": qy, 'from': from, "to": to},
                        success: function (data) {
                            if (data.status = 'true') {
                                swal("  تم التجهيز", " تم تجهيز الوجبات", 'success', {
                                    buttons: 'موافق'
                                });
// $('#submit_btn_ready'+ id).remove();
// var xx = document.createElement("INPUT");
//         xx.setAttribute("type", "button");
//         xx.setAttribute("value", "تم التجهيز");
//         xx.setAttribute("class", "btn btn-success");
//    document.getElementsByClassName("ready_btn"+id)[0].appendChild(xx);
//
                                $('#readyquantity' + id).val(data.readymeal);

                            }
                        }
                    });


                });

            </script>

@endsection
