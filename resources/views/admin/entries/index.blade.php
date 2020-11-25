@extends('admin.layout.master')
@section('title','إدارة الدليل المحاسبى')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.entries.create')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light">
                   إضافة قيد جديد
                    <span class="m-l-5"><i class="fa fa-plus"></i></span>
                </a>
            </div>

            <h4 class="page-title"> القيود</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30">كل  القيود </h4>
                <section class="filter">
                    <div class="yurSections">
                        <div class="row">
                            <div class="col-xs-12">
                                {!!Form::open( ['route' => 'dashboard.entries.filter' ,'class'=>'form phone_validate', 'method' => 'get','files' => true]) !!}
                                <div class="form-group col-sm-3 ">
                                    <label> الكود  </label>
                                    {!! Form::text("code",null,['class'=>'form-control'])!!}
                                </div>
                                <div class="form-group col-sm-3">
                                    <label>مصدر  العمليه  </label>
                                    {{-- {!! Form::select("source",['قيد يدوى'=>'قيد يدوى','مشتريات'=>'مشتريات','مبيعات'=>'مبيعات ','مرتجعات'=>'مرتجعات'],null,['class'=>'form-control','placeholder'=>'اختر مصدر العمل'])!!} --}}
                              <select class="form-control" name="source">
                                  <option></option>
                                  <option value="قيد يدوى">قيد يدوى</option>
                                  <option value="مبيعات">مبيعات</option>
                                  <option value="مشتريات">مشتريات</option>
                              </select>
                                </div>
                                <div class="form-group col-sm-3 col-xs-12 ">
                                    <label> نوع  العمليه  </label>
                                    {!! Form::select("type",['manual'=>'يدوى','automatic'=>'الى'],null,['class'=>'form-control'])!!}
                                </div>

                                <div class="form-group col-sm-3">
                                    <label> تاريخ العملية </label>
                                    {!! Form::date("date",null,['class'=>'form-control'])!!}
                                </div>
                                <div class="form-group col-sm-3 pull-right">
                                    <label>  </label>
                                    <input type="submit" value="بحث" class="btn btn-success">
                                </div>
                                {!!Form::close() !!}
                            </div>
                        </div>
                    </div>
                </section>

                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th> # </th>
                        <th> الكود </th>
                        <th> المصدر </th>
                        <th>النوع </th>
                        <th> التاريخ </th>
                        <th> الوصف </th>
                        <th> الحالة </th>
                        <th class="text-center">العمليات</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($entries as $row)
                    <tr>
                        <td>{!!$loop->iteration!!}</td>

                        <td>
                            {{-- <a href="{{route('dashboard.entries.show',['id'=>$row->id])}}" class="link">
                            {!! $row->code!!}
                            </a> --}}
                            {!! $row->code!!}
                        </td>
                        <td>
                            {!! $row->source!!}
                        </td>
                        <td>
                            @if($row->type=='manual')
                                يدوى
                            @else
                                الى
                            @endif
                        </td>
                        <td>{!! $row->date!!}</td>

                        <td>{!! $row->details !!}</td>

                        <td>
                            {{-- @if($row->status=='new') --}}
                                جديد
                            {{-- @else
                                مرحلة
                            @endif --}}
                        </td>
                        <td class="text-center">
                            <a href="{{route('dashboard.entries.show',$row->id)}}" data-toggle="tooltip" data-original-title="تعديل"class="label label-warning">عرض التفاصيل </a>

                            <a href="#" onclick="Delete({{$row->id}})" data-toggle="tooltip" data-original-title="حذف"class="label label-danger">حذف </a>

                            {!!Form::open( ['route' => ['dashboard.entries.destroy',$row->id] ,'id'=>'delete-form'.$row->id, 'method' => 'Delete']) !!}
                            {!!Form::close() !!}

                        </td>
                    </tr>

                @endforeach
                    </tbody>
                </table>
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