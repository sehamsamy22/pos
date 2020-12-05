@extends('admin.layout.master')
@section('title','إدارة الاشتراكات')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.dietsystems.edit',$clientSubsription->id)}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >
                    تعديل النظام الغذائى
                </a>
            </div>

            <h4 class="page-title">عرض النظام  الغذائى</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30"> عرض النظام الغذائ على  مدار الاسبوع</h4>


<table id="basic" class="table table-striped table-bordered" >
    <thead>
    <tr>
        <th></th>
        <th>السبت </th>
        <th>الاحد </th>
        <th>الاتنين </th>
        <th>الثلاثاء </th>
        <th>الاربعاء </th>
        <th>الخميس </th>
        <th>الجمعه </th>



    </tr>
    </thead>
    <tbody class="table_meals">

        @foreach($types as $key => $type)

        <tr>
          <td>{{ $type->name }}</td>
          @for($i=1;$i<=7;$i++)
              <td  >

                  <div class="{{$i}}" style="display: inline-block;">

                  @foreach($type->meals_sub($clientSubsription->subscription_id) as  $key=>$meal)
                  @foreach($dietsystems as $dietsystem)
                  @if ($dietsystem->meal_id==$meal->id  && $dietsystem->day_No==$i)

                    {{$meal->ar_name}}-{{$meal->calories}}


                  @endif

                    @endforeach
                  @endforeach
              </div>
              </td>
          @endfor
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


@endsection
