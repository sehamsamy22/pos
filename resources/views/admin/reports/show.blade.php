@extends('admin.layout.master')
@section('title','تقرير الايردات')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">



            <h4 class="page-title"> عرض تفاصيل التقرير</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">
                <h4 class="header-title m-t-0 m-b-30">   التفاصيل </h4>
                  <div class="clearfix"></div>
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1"> السندات </a></li>
                   {{--<li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2">  المشتريات </a></li>--}}
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" id="menu1" class="tab-pane active">
                        <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>

                            <th> #</th>
                            <th>القيمة </th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp

                            <tr>
                                <td>اجمالى المبيعات</td>
                                <td>{{$data['sales']}}</td>
                            </tr>
                        <tr>
                            <td>اجمالى المشتريات</td>
                            <td>{{$data['purchases']}}</td>
                        </tr>
                        <tr>
                            <td>اجمالى  الاشتركات  </td>
                            <td>{{$data['subscription']}}</td>
                        </tr>
                        <tr>
                            <td>اجمالى سندات صرف</td>
                            <td>{{$data['receipt']}}</td>
                        </tr>
                        <tr>
                            <td>اجمالى سندات البيع والاشتراكات</td>
                            <td>{{$data['incomes']}}</td>
                        </tr>
                        <tr>
                            <td>اجمالى خصومات المبيعات</td>
                            <td>{{$data['sales_discount_val']}}</td>
                        </tr>
                        <tr>
                            <td>اجمالى  خصومات المشتريات</td>
                            <td>{{$data['purchases_discount_val']}}</td>
                        </tr>
{{--                        <tr>--}}
{{--                            <td>اجمالى مدفوعات  الكاش  </td>--}}
{{--                            <td>{{$data['profit']}}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>اجمالى المدفوعات بالفيزا  </td>--}}
{{--                            <td>{{$data['profit']}}</td>--}}
{{--                        </tr>--}}
{{--                        <tr>--}}
{{--                            <td>اجمالى المدفوعات بالماستر  </td>--}}
{{--                            <td>{{$data['profit']}}</td>--}}
{{--                        </tr>--}}
                        </tbody>

                    </table>
                    </div>

                    </div>


    </div>
    </div>
@endsection

@section('scripts')

            @include('admin.layout.dataTable')

            <script>
                function Delete(id) {
                    var item_id=id;
                    console.log(item_id);
                    swal({
                        title: "هل أنت متأكد ",
                        text: "هل تريد حذف هذا المستخدم ؟",
                        icon: "warning",
                        buttons: ["الغاء", "موافق"],
                        dangerMode: true,

                    }).then(function(isConfirm){
                        if(isConfirm){
                            document.getElementById('delete-form'+item_id).submit();
                        }
                        else{
                            swal("تم االإلفاء", "حذف  المستخدم  تم الغاؤه",'info',{buttons:'موافق'});
                        }
                    });
                }
            </script>


@endsection
