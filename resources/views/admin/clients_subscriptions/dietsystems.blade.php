@extends('admin.layout.master')
@section('title','إدارة الاشتراكات')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">



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

        @foreach($dietsystems as $key => $sys)

        <tr>
          <td>{{ $sys->meal->typeMeal->name }}</td>
          @for($i=1;$i<=7;$i++)
              <td>

                    @if($sys->day_No==$i)
                    {{$sys->meal->ar_name}}-{{$sys->meal->calories}}
                    @endif


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
