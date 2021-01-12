@extends('admin.layout.master')
@section('title','إدارة الاشتراكات')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.clients_subscriptions.create')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light">
                   إضافة  اشتراك جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>

            <h4 class="page-title">عرض الاشتراكات</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل  اشتراكات  العملاء بالنظام </h4>


                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>اسم  العميل</th>

                        <th>  اسم الخطه</th>
                        <th>   بداية الاشتراك</th>
                        <th>   نهاية الاشتراك</th>
                        <th>  الضريبه </th>
                        <th>  الاجمالى </th>
                        <th>  المدفوع </th>
                        <th>  المتبقى </th>
                        <th style="width: 250px;" >العمليات المتاحة</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($clients_subscriptions as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->client->name}}</td>
                            <td>{{$row->subscription->name}}</td>
                            <td>{{$row->start}}</td>
                            <td>{{$row->end}}</td>
                            <td>{{$row->tax}}</td>
                            <td>{{$row->total}}</td>
                            <td>{{$row->payed}}</td>
                            <td>{{$row->reminder}}</td>
                            <td>
                            @if($row->reminder > 0)
                                 <a href="{{route('dashboard.clients_subscriptions.payment',$row->id)}}" class="btn btn-primary"> دفع</a>
                            @else
                            <label class="btn btn-success"> تم سداد المبلغ بالكامل</label>
                            @endif
                            <a href="{{route('dashboard.clients_subscriptions.show',$row->id)}}" class="btn btn-pink"> عرض الاشتراك</a>
                                @if($row->active==1)
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-{{$row->id}}">
                                   ايقاف
                                </button>
                                @else
{{--                                    <a href="#" class="btn btn-danger"> متوقف</a>--}}
                                    <a href="{{route('dashboard.subscriptions.active',$row->id)}}" class="btn btn-success"> تفعيل الاشتراك </a>
                                    @endif
                                <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف" class="btn btn-danger"> حذف</a>
                                {!!Form::open( ['route' => ['dashboard.clients_subscriptions.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                                {!!Form::close() !!}
                            </td>
                        </tr>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal-{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">أيقاف إشتراك مؤقت  </h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    {!!Form::model($row, ['route' => ['dashboard.subscriptions.dis_active' ,$row->id] , 'method' => 'POST' ,'files'=>true]) !!}
                                  <?php
                                    $now=\Carbon\Carbon::today();
                                    ?>
                                    <div class="modal-body">
                                        <div class="form-group form-float">
                                            <label class="form-label">  مده التوقف </label>
                                            <div class="form-line">
                                        <input type="text" class="form-control" name="period"  data-end="{{$row->end}}" data-now={{$now}} id="period">
                                            </div>
                                        </div>

                                        <div class="form-group form-float">
                                            <label class="form-label">  تاريخ اعاده الاستكمال </label>
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="restart" id="restart" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group form-float">
                                            <label class="form-label"> تاريخ نهايه الاشتراك  </label>
                                            <div class="form-line">
                                                <input type="date" class="form-control" name="end"  id="end" readonly>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary"> حفظ التعديلات</button>
                                    </div>
                                    {!!Form::close() !!}
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>

    </div>
    </div>
@endsection

@section('scripts')

{{--            @include('admin.layout.dataTable')--}}

            <script>
                function Delete(id) {
                    var item_id=id;
                    console.log(item_id);
                    swal({
                        title: "هل أنت متأكد ",
                        text: "هل تريد حذف هذا اشتراك العميل ؟",
                        icon: "warning",
                        buttons: ["الغاء", "موافق"],
                        dangerMode: true,

                    }).then(function(isConfirm){
                        if(isConfirm){
                            document.getElementById('delete-form'+item_id).submit();
                        }
                        else{
                            swal("تم االإلفاء", "حذف  الاشتراك  تم الغاؤه",'info',{buttons:'موافق'});
                        }
                    });
                }
            </script>
            <script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>

            <script>
                // $(document).ready(function () {
                //     $('#restart').datepicker();
                //     // $('#').datepicker();
                // });

                $("#period").on('change', function() {
                    var period = $(this).val();
                    var now=$(this).data('now');
                   var end=$(this).data('end');
                    document.getElementById('restart').value = dayjs().add(period, 'days').format('YYYY-MM-DD');
                    document.getElementById('end').value = dayjs(end).add(period, 'days').format('YYYY-MM-DD');
                    // var date = new Date(now);
                    // var newdate = new Date(date);
                    //
                    // newdate.setDate(newdate.getDate() + period);
                    //
                    // var dd = newdate.getDate();
                    // var mm = newdate.getMonth() + 1;
                    // var y = newdate.getFullYear();
                    // console.log(newdate);
                    // console.log(now);
                    // var someFormattedDate = y + '-' + mm + '-' + dd;
                    // console.log(period);
                    // console.log(someFormattedDate);
                    // document.getElementById('restart').value = someFormattedDate;

                });
            </script>



@endsection
