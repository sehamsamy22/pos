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

             $('#date_end').val(d.getDate()+ "/" +d.getMonth()+ "/" +d.getFullYear());
            }).fail(function (error) {
                console.log(error);
            });
        });
    </script>
@endsection
