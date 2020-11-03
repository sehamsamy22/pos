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
    function Delete(id) {
        var item_id=id;
        console.log(item_id);
        swal({
            title: "هل أنت متأكد ",
            text: "هل تريد حذف هذة الوجبة ؟",
            icon: "warning",
            buttons: ["الغاء", "موافق"],
            dangerMode: true,

        }).then(function(isConfirm){
            if(isConfirm){
                document.getElementById('delete-form'+item_id).submit();
            }
            else{
                swal("تم االإلفاء", "حذف  الوجبة  تم الغاؤه",'info',{buttons:'موافق'});
            }
        });
    }
</script>



@endsection
