@extends('admin.layout.master')
@section('title','إنشاء  عميل جديد')

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
                <a href="{{route('dashboard.subscriptions.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" > رجوع لإدارة العملاء<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">إضافة عميل جديد</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 m-b-30">بيانات  العميل</h4>

                <div class="row">



                    {!!Form::open( ['route' => 'dashboard.clients.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}


                    @include('admin.clients.form')


                    {!!Form::close() !!}





                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')

    @include('admin.layout.form_validation_js')
    <script>
        var bigDataVisits = [];
        function myFun(event) {
            event.preventDefault();
            var visit_data = {};
            var measurement_val_arr=[];
            visit_data.date= $('#date').val();
            var measurements= <?php echo json_encode($measurements);?>;
              var array= measurements.map(c => c.id);
            for (let index = 0; index < array.length; index++) {
                 console.log(array[index]);

                measurement_val_arr.push($('#'+array[index]).val());
            }
            visit_data.measurement_val= measurement_val_arr;
            console.log(visit_data);
            if (visit_data.date !== '' && visit_data.measurement_val !== '') {
                $("tr.editted-row").remove();
                swal({
                    title: "تم إضافة الزياره  بنجاح",
                    text: "",
                    icon: "success",
                    buttons: ["موافق"],
                    dangerMode: true,
                })

                bigDataVisits.push(visit_data);
                $("#visitTable-wrap").show();
                var appendVisit = bigDataVisits.map(function(visit) {
                    return (`
            <tr class="single-visit">
                <td class="date">${visit.date}</td>
                   @foreach ($measurements as $key=>$measurement)
                <td class="">${visit.measurement_val[{{$key}}] }</td>
                    @endforeach
              <td>
                <a href="#" data-toggle="modal" class="edit-this-row-component" data-target="#exampleModal2" data-original-title="تعديل">
                    <i class="icon-pencil7 text-inverse" style="margin-left: 10px"></i>
                </a>
                <a href="#" data-toggle="tooltip" class="delete-this-row-component" data-original-title="حذف">
                    <i class="icon-trash text-inverse text-danger" style="margin-left: 10px"></i>
                </a>
            </td>
        <input type="hidden" name="visits_date[]" value="${visit.date}" >
          @foreach ($measurements as $key=>$measurement)
        <input type="hidden" name="measurement[{{$measurement->id}}][]" value="${visit.measurement_val[{{$key}}] }" >
            @endforeach
            </tr>
            `);
                });
                $('.add-visits').empty().append(appendVisit);
                //////////////////////////////////////////////////////////////////////


            } else {
                swal({
                    title: "من فضلك قم بملئ كل البيانات المميزة بالعلامة الحمراء",
                    text: "",
                    icon: "warning",
                    buttons: ["موافق"],
                    dangerMode: true,
                })
            } ///if_end
        }
    </script>


@endsection
