@extends('admin.layout.master')
@section('title','إنشاء  اشتراك جديد')

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
                <a href="{{route('dashboard.clients_subscriptions.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" > رجوع لإدارة الاشتراكات<span class="m-l-5"><i class="fa fa-reply"></i></span></a>
            </div>
            <h4 class="page-title">إضافة اشتراك لعميل جديد</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">


                <h4 class="header-title m-t-0 m-b-30">بيانات  الاشتراك</h4>

                <div class="row">



                    {!!Form::open( ['route' => 'dashboard.clients_subscriptions.store' ,'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}

                    @include('admin.clients_subscriptions.form')

                    {!!Form::close() !!}

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')

    @include('admin.layout.form_validation_js')
    <script>
        $("#start_date").on('change', function() {
            var start_date = $(this).val();
            var id = $('#subscription_id').val();
            $.ajax({
                url:"/dashboard/getEndDate/"+id,
                type:"get",
                data:{
                    'id':id,
                    'start_date':start_date
                }
            }).done(function (data) {
                var d=new Date(data.data);

             $('#date_end').val(data.datetext);

            }).fail(function (error) {
                console.log(error);
            });
        });
    </script>


<script>
        $("#subscription_id").on('change', function() {
            var id = $(this).val();

            $.ajax({
                url:"/dashboard/getMealTable/"+id,
                type:"get",

            }).done(function (data) {

           $('.table_meals').empty();
           $('.table_meals').html(data.data);
           $('#price').val(data.price);
           var static_tax=$('#tax').val();
           var price = $('#price').val();
          $('#total').val(Number(price)+Number(price) * (Number(static_tax) / 100));
            $('#amount_required').val($('#total').val());
          //  $("div > input[type=radio]").click(function() {
          //   var thisParent = $(this).closest("div");
          //   var prevClicked = thisParent.find(":checked");
          //   var currentObj = $(this);
          //   prevClicked.each(function() {
          //     if (!$(currentObj).is($(this))) {
          //       $(this).prop("checked", false);
          //     }
          //   });
          // });
                $("input:radio[name^='disableRow']").prop("checked", false);

                $("input:radio[name^='disableRow']").on("change", function(){
                    $(this).closest("td").find("input:radio").prop("disabled", this.checked);
                });

        var price2 = $('#price').val();
       $('#amount_required').val($('#total').val());
          var taxx=$("#tax").val();
            var tax_=price2 * ( taxx/ 100 );
            var total= $('#total').val();
          var tax_val=$('#tax_val').val(tax_.toFixed(2) );
         $('#payed').val(total);
                $("#reminder").val('0');

                $("#payed").change(function() {
                   var payed=$(this).val();
                   var reminder= Number($("#amount_required").val()) - Number(payed);
                   $("#reminder").val(reminder.toFixed(2));
               });

               $("#tax").on('change', function() {
                var tax = $(this).val();
               var price = $('#price').val();
            $('#total').val(Number(price)+Number(price) * (Number(tax) / 100));
            $('#amount_required').val($('#total').val());
            $('#payed').val($('#total').val());

                   $("#payed").change(function() {
                      var payed=$(this).val();
                      var reminder= Number($("#amount_required").val()) - Number(payed);
                      $("#reminder").val(reminder.toFixed(2));
                  });
            });
        });

        var start_date = $('#start_date').val();
        var sub_id = $('#subscription_id').val();
        $.ajax({
            url:"/dashboard/getEndDate/"+sub_id,
            type:"get",
            data:{
                'id':sub_id,
                'start_date':start_date
            }
        }).done(function (data) {
            var d=new Date(data.data);

         $('#date_end').val(data.datetext);

        }).fail(function (error) {
            console.log(error);
        });
        });

    </script>
@endsection
