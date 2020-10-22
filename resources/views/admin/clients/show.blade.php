@extends('admin.layout.master')
@section('title',' عرض  بيانات  العميل')

@section('styles')
    <style>
        .erro{
            color: red;
        }
    </style>
@endsection

@section('content')
    <!-- Page Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.visits.add_visit',$client->id)}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >  تسجيل زيارة جديدة<span class="m-l-5"><i class="fa fa-add"></i></span></a>
            </div>
            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.clients_subscriptions.add_subscription',$client->id)}}" class="btn btn-success dropdown-toggle waves-effect waves-light"  style="margin-left: 20px;">  تسجيل اشتراك جديد<span class="m-l-5"><i class="fa fa-add"></i></span></a>
            </div>
            <h4 class="page-title">الصفحة الشخصية</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات العميل: {{$client->name}}</h4>

                <div class="row">


{{--                        {{method_field('post')}}--}}
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-md-2 control-label">إسم العميل</label>
                                <div class="col-md-10">
                                    <input type="text" required value="{{$client->name}}"
                                           name="name" class="form-control" placeholder="إسم العميل" disabled>

                                    @if($errors->has('name'))
                                        <p class="help-block">
                                            {{ $errors->first('name') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>


                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-md-2 control-label">رقم الجوال</label>
                                <div class="col-md-10">
                                    <input type="text" required value="{{$client->phone}}"
                                           name="phone" class="form-control" placeholder="رقم الجوال" disabled>
                                </div>
                            </div>
                        </div>





                        <div class="col-lg-6">
                            <div class="form-group">
                                <label class="col-md-2 control-label">البريد الإلكتروني*</label>
                                <div class="col-md-10">
                                    <input type="email" required value="{{$client->email}}"
                                           name="email" class="form-control" placeholder="البريد الإلكتروني" disabled>

                                    @if($errors->has('email'))
                                        <p class="help-block">
                                            {{ $errors->first('email') }}
                                        </p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>اسم الخطة</th>
                            <th>السعر </th>
                            <th>مده الخطة</th>
                            <th>عدد الوجبات </th>
                            <th>بداية الخطة</th>
                            <th>نهاية الخطة</th>


                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                        @foreach($subscriptions as $row)
                            <tr>
                                <td>{{$i++}}</td>
                                <td>{{$row->subscription->name}}</td>
                                <td>{{$row->subscription->price}}</td>
                                <td>{{$row->subscription->duration}}</td>
                                <td>{{$row->subscription->num_meals}}</td>
                                <td>{{$row->start}}</td>
                                <td>{{$row->end}}</td>


                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                @foreach($visits as $visit)
                    <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <caption > <h3>{{$visit->date}}</h3></caption>
                        <thead>
                        <tr>
                            <th>القياس</th>
                            <th>القيمة</th>
                        </tr>
                        </thead>
                        <tbody>
                        @php $i = 1; @endphp
                     @foreach($visit->measurements as $key=>$row)
                            <tr>
                                <td>{{$row->measurement->name}}</td>
                                <td>{{$row->value}}

                                </td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @endforeach




                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')
    <script>
        // Date Picker
        jQuery('#datepicker').datepicker();


        $('.dropify').dropify({
            messages: {
                'default': 'إضغط هنا او اسحب وافلت الصورة',
                'replace': 'إسحب وافلت او إضغط للتعديل',
                'remove': 'حذف',
                'error': 'حدث خطأ ما'
            },
            error: {
                'fileSize': 'حجم الصورة كبير (1M max).',
                'fileExtension': 'نوع الصورة غير مدعوم (png - gif - jpg - jpeg)',
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //        $("#spec").hide();
        //        $("#spec_label").hide();
        //
        //        $("#dept_select_label").hide();
        //        $("#dept_select").hide();


    </script>

    <script>
        $('#role_select').on('change', function () {

            var role_select = $('#role_select').val();


            console.log(role_select);

            if(role_select === 'technical'){
                $("#spec").show();
                $("#spec_label").show();
                $("#dept_select_label").hide();
                $("#dept_select").hide();

            }

            else if(role_select === 'dept_admin'){
                $("#dept_select_label").show();
                $("#dept_select").show();

                $("#spec").hide();
                $("#spec_label").hide();


            }

            else {
                $("#spec").hide();
                $("#spec_label").hide();

                $("#dept_select_label").hide();
                $("#dept_select").hide();
            }

        });

    </script>

@endsection
