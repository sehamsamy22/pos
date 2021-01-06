@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> عرض  جميع  الاصناف المتوفره فى المخزن بكمياتها الحالية </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل  الاصناف</h4>
                <form action="" method="get" accept-charset="utf-8" >


                <div class="col-sm-4 col-xs-4  pull-left">
                    <div class="form-group form-float">
                        <label class="form-label">   التصنيف الرئيسى</label>
                        <div class="form-line">
                            {!! Form::select("category_id",$categories,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر التصنيف الرئيسى  ','id'=>'category_id'])!!}

                        </div>
                    </div>
                </div>

                <div class="col-sm-4 col-xs-4  pull-left subcategories">
                    <div class="form-group form-float">
                        <label class="form-label">   التصنيف الفرعى</label>
                        <div class="form-line">
                            {!! Form::select("sub_category_id",[],null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر التصنيف الرئيسى أولا  '])!!}
                        </div>
                    </div>
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
                        <th>الكميه المتوفرة</th>
                        <th>  متوسط التكلفة</th>
                        <th> التصنيف الفرعى</th>
                        <th>تاريخ اضافته  </th>
                        <th>تاريخ اخر عمليه تمت  </th>
                        <th>عرض العمليات  </th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($storeproducts as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->product->ar_name}}</td>

                            <td>{{$row->quantity}}</td>
                            <td>{{$row->product->avg_cost() }}</td>

                            <td>{{$row->product->subcategory->name ??''}}</td>
                            <td>{{$row->created_at}}</td>
                            <td>{{$row->updated_at}}</td>
                            <td>
                                <a href="{{route('dashboard.stores.show',$row->product->id)}}" class="label label-warning">عرض العمليات</a>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>


    </div>
    </div>
@endsection
@section('scripts')

    @include('admin.layout.form_validation_js')
    <script>
        $("#category_id").on('change', function() {
            var id = $(this).val();
            $.ajax({
                url:"/dashboard/getAllSubcategories/"+id,
                type:"get",
            }).done(function (data) {
                $('.subcategories').empty();
                $('.subcategories').html(data.data);
            }).fail(function (error) {
                console.log(error);
            });
        });
    </script>
@endsection
