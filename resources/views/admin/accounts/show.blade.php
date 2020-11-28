@extends('admin.layout.master')
@section('title','بيانات  الحساب')

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
                {{--<a href="{{route('users.index')}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >رجوع لمستخدمي النظام<span class="m-l-5"><i class="fa fa-reply"></i></span></a>--}}
            </div>
            <h4 class="page-title"> عرض بيانات الحساب</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات الحساب: {{$account->name}}</h4>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label"> اسم  الحساب </label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$account->name}}"
                                    name="phone" class="form-control" placeholder="اسم المنتج " disabled>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label">    الكود</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$account->
                                code}}"
                                    name="phone" class="form-control" placeholder="رقم الجوال" disabled>
                            </div>
                        </div>
                    </div>


                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label"> كود الحساب</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$account->code}}"
                                    name="phone" class="form-control" placeholder="رقم الجوال" disabled>
                            </div>
                        </div>
                    </div>

                    {{--  {{$account->descendants->sum('amount')}}  --}}
                    @if($account->type=='sub' )
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label"> الرصيد</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{$account->amount}}"
                                    name="phone" class="form-control" placeholder="رقم الجوال" disabled>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label"> الرصيد</label>
                            <div class="col-md-10">

                                <input type="text" required value="{{$account->descendants->sum('amount')}}"
                                    name="phone" class="form-control" placeholder="رقم الجوال" disabled>
                            </div>
                        </div>
                    </div>
                    @endif

                    <div class="col-lg-12">
                        <div class="form-group">
                            <label class="col-md-2 control-label">  رقم المستوى</label>
                            <div class="col-md-10">
                                <input type="text" required value="{{all_levels($account->level)}}"
                                    name="phone" class="form-control" placeholder="" disabled>
                            </div>
                        </div>
                    </div>

                    <div class="clearfix"></div>

                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th>#</th>

                            <th> كود القيد</th>
                            <th>التاريخ</th>
                            <th> اسم الحساب </th>
                            <th>المبلغ</th>
                            <th>التاثير</th>
                        </tr>
                        </thead>
                        <tbody>
                            @php $i = 1; @endphp
                            @foreach($acounts_all as $row)
                                <tr>
                                    <td>{!!$loop->iteration!!}</td>

                                    <td>{{ $row->entry->code }}</td>
                                    <td>
                                        {{ $row->created_at }}
                                    </td>
                                    <td>{{ $row->account->name ?? '' }}</td>

                                    <td>
                                        {{ $row->amount  }}
                                    </td>
                                    <td>
                               @if($row->affect=='debtor')
                                        مدين <i class="fa fa-arrow-up" style="margin-left: 10px"></i>
                                     @else
                                        دائن<i class="fa fa-arrow-down" style="margin-left: 10px"></i>
                                   @endif
                                    </td>

                                    <td>
                                        {{--  {!! $log_openning_balance->account_amount_after!!}  --}}
                                    </td>

                                </tr>
                                @endforeach
                           </tbody>
                        </table>




                </div>
            </div>

        </div>
    </div>
@endsection
