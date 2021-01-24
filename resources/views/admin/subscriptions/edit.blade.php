@extends('admin.layout.master')
@section('title','تعديل  الاشتراك')

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
                <a href="{{route('dashboard.subscriptions.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لإدارة الاشتراكات<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">تعديل  الاشتراك</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات الاشتراك: {{$subscription->code}}</h4>

                <div class="row">

                    {!!Form::model($subscription, ['route' => ['dashboard.subscriptions.update' ,  $subscription->id] , 'method' => 'PATCH' ,'files'=>true]) !!}

                    @include('admin.subscriptions.form')
                    {!!Form::close() !!}

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')

    <script>

        $(document).on('change', 'select[name="type_id"]', function () {
            var id = $(this).val();
            var idd = this.id;
            console.log(idd);
            console.log("df"+id);
            $.ajax({
                url:"/dashboard/getMealInputs/"+id,
                type:"get",
                data:{num:idd}

            }).done(function (data) {

                $('.meals-inpusts').empty();
                $('.meals-inpusts').html(data.data);

            });
        });
    </script>
    <script>
        var bigData = [];
        function myFun(event,id) {
            event.preventDefault();

            var values = $("input[name='meal[" + id + "]']:checked")

                .map(function(){
                    var data = {};
                    data.meal_id = $(this).val();
                    data.meal_name = $(this).data('name');
                    data.meal_type= $(this).data('type');
                    // data.meal_price= $(this).data('price');
                    return data;
                }).get();
            swal({
                title: "تم إضافة الوجبة نجاح",
                text: "",
                timer: 1000,
                icon: "success",
                buttons: ["موافق"],
                dangerMode: true,
            })
            $('.meals-inpusts').empty();
            bigData.push(values);
            $("#mealsTable-wrap").show();
            var appendMeals=[];
            var appendMealShow=[];
            appendMeals[id] = values.map(function(meal) {
                return (`

            <li>
           ${meal.meal_type}: ${meal.meal_name}
            </li>

           <input type="hidden" name="meals[${id}][]" value="${meal.meal_id}" >


        `);
            });
            appendMealShow[id] = values.map(function(meal) {
                return (`


            <li>
           ${meal.meal_type}: ${meal.meal_name}
            <button class="btn btn-danger deleteRecord  delete-this-row" id="${meal.meal_id} ">حذف</button>
            </li>

        `);
            });
            $('#add-meals'+id).append(appendMeals[id]);
            $('#show-meals'+id).append(appendMealShow[id]);
            $('.delete-this-row').click(function(e) {
                var $this = $(this);
                var row_index = $(this).parents('li').index();
                e.preventDefault();
                swal({
                    title: "هل أنت متأكد ",
                    text: "هل تريد حذف هذة  الوجبة ؟",
                    icon: "warning",
                    buttons: ["الغاء", "موافق"],
                    dangerMode: true,
                }).then(function(isConfirm) {
                    if (isConfirm===true) {
                        $this.parents('li').remove();
                        bigData.splice(row_index, 1);
                    } else {
                        swal("تم االإلفاء", "حذف   الوجبة  تم الغاؤه", 'info', {
                            buttons: 'موافق'
                        });
                    }
                });
            });
        }

    </script>

    <script>
        $(".deleteRecord").click(function(e){
            e.preventDefault();
            var id = $(this).data("id");
            $.ajax(
                {
                    url: "/dashboard/deleteMeal/"+id,
                    type: 'GET',
                }).done(function (data) {
                swal("  تم المسح", " تم مسح الوجبة", 'success', {
                    buttons: 'موافق'
                });
                $("#"+id).remove();
            });

        });
    </script>
@endsection
