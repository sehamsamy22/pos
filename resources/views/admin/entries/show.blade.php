@extends('admin.layout.master')
@section('title',' عرض  بيانات  القيد')

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


            <h4 class="page-title"> بيانات القيد اليومى</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">

                <h4 class="header-title m-t-0 m-b-30">بيانات القيد : {{$entry->code}}</h4>

                <div class="row">
                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1">  بيانات القيد اليومى </a></li>
                        {{--  <li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2">  سجل الاشتركات العميل </a></li>
                        <li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu3"> سجل زيات وقياسات العميل </a></li>  --}}


                    </ul>

                    <div class="tab-content">


                        <div role="tabpanel" id="menu1" class="tab-pane active">

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">الكود </label>
                                    <div class="col-md-10">
                                        <input type="text" required value="{{$entry->code}}"
                                            name="name" class="form-control" placeholder=" كود القيد" disabled>

                                        @if($errors->has('name'))
                                            <p class="help-block">
                                                {{ $errors->first('name') }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> تاريخ القيد</label>
                                    <div class="col-md-10">
                                        <input type="text" required value="{{$entry->date}}"
                                          class="form-control"  disabled>
                                    </div>
                                </div>
                            </div>



                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">  المصدر</label>
                                    <div class="col-md-10">
                                        <input type="text" required value="{{$entry->source}}"
                                            class="form-control"  disabled>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label">  النوع</label>
                                    <div class="col-md-10">
                                        <input type="text" required value={{ $entry->type=='manual'?'يدوى':'الى' }}
                                            name="phone" class="form-control"disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label class="col-md-2 control-label"> تفاصيل القيد</label>
                                    <div class="col-md-10">
                                        <input type="textarea" required value="{{$entry->details}}"
                                             class="form-control"  disabled>
                                    </div>
                                </div>
                            </div>


                                <table class="table datatable-button-init-basic">
                                    <thead class="thead_entry " style="    background: #ccc; ">
                                    <th style="color:#333">  من </th>
                                    <th style="color:#333">  الى </th>
                                    <th style="color:#333">  مدين </th>
                                    <th style="color:#333">  دائن </th>
                                    </thead>
                                       <tbody>

                                                    @foreach($accounts as $row)
                                                        <tr>
                                                            @if($row->affect=='debtor')
                                                                <td>{!! $row->account->name ?? ''!!}</td>
                                                                <td></td>
                                                                <td>{!! $row->amount !!}</td>
                                                                <td></td>
                                                            @else($row->affect=='creditor')
                                                                <td></td>
                                                                <td>{!! $row->account->name??'' !!}</td>
                                                                <td></td>
                                                                <td>{!! $row->amount !!}</td>
                                                            @endif
                                                        </tr>
                                                    @endforeach
                                    </tbody>
                                </table>

                        </div>


                    </div>

                </div><!-- end row -->
            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')


@endsection
