@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> جرد المنتجات </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30"> جرد المنتجات</h4>
                <form action="{{route('dashboard.inventories.store')}}" method="post" accept-charset="utf-8">
                    @csrf
                    <div class="col-sm-6 col-xs-6  pull-left">
                        <div class="form-group form-float">
                            <label class="form-label"> تاريخ الجرد</label>
                            <div class="form-line">
                                <input type="date" name="date" class="form-control">
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xs-6  pull-left">
                        <div class="form-group form-float">
                            <label class="form-label"> رقم سند الجرد</label>
                            <div class="form-line">
                                <input type="text" name="bond_num" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xs-6  pull-left">
                        <div class="form-group form-float">
                            <label class="form-label"> تفاصيل الجرد</label>
                            <div class="form-line">
                                <textarea name="description" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>


                    <div class="clearfix"></div>
                    <table  class="table table-striped table-bordered" cellspacing="0"
                           width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم المنتج</th>
                            <th>الكميه </th>
                            <th>الكمية الفعلية</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($storeMeals as $row)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$row->meal->ar_name}}</td>
                                <td>{{$row->quantity}}</td>
                                <td>
                                    <input type="text" name="real_quantity[{{$row->meal_id}}]">
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-primary waves-effect" type="submit">جرد</button>
                    </div>
                </form>

            </div>
        </div>
        @endsection
        @section('scripts')

            @include('admin.layout.form_validation_js')
            <script>
                $("#category_id").on('change', function () {
                    var id = $(this).val();
                    $.ajax({
                        url: "/dashboard/getAllSubcategories/" + id,
                        type: "get",
                    }).done(function (data) {
                        $('.subcategories').empty();
                        $('.subcategories').html(data.data);
                    }).fail(function (error) {
                        console.log(error);
                    });
                });
            </script>
@endsection
