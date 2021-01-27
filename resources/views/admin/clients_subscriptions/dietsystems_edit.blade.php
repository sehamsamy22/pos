@extends('admin.layout.master')
@section('title','إدارة الاشتراكات')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">

            {{-- <div class="btn-group pull-right m-t-15">
                <a href="{{route('dashboard.dietsystems.edit',$clientSubsription->id)}}" class="btn btn-custom dropdown-toggle waves-effect waves-light" >
                    تعديل النظام الغذائى
                </a>
            </div> --}}

            <h4 class="page-title">تعديل النظام  الغذائى</h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                <h4 class="header-title m-t-0 m-b-30"> عرض النظام الغذائ على  مدار الاسبوع</h4>

                {!!Form::open( ['route' =>['dashboard.dietsystems.update',$clientSubsription->id],'class'=>'form phone_validate', 'method' => 'Post','files' => true,'id'=>'form']) !!}
                <ul class="nav nav-tabs">
                    <li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1">الأسبوع الاول</a></li>
                    <li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2">الأسبوع الثانى</a></li>
                    <li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu3"> الأسبوع الثالث</a></li>
                    <li><a data-toggle="tab" role="tab" aria-controls="menu3" href="#menu4"> الأسبوع الرابع</a></li>

                </ul>
                <div class="tab-content">
                    <div role="tabpanel" id="menu1" class="tab-pane active">

                        <table  class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th></th>
                                <th>اليوم الاول </th>
                                <th>اليوم التانى </th>
                                <th>اليوم الثالث </th>
                                <th>اليوم الرابع </th>
                                <th>اليوم الخامس </th>
                                <th>اليوم السادس </th>
                                <th>اليوم السابع </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($week=1)
                            @foreach($types as $key => $type)
                                <tr>
                                    <td style="font-weight: 600;">{{ $type->name }}</td>
                                    @for($i=1;$i<=7;$i++)
                                        <td>
                                            @foreach(meals($clientSubsription->subscription_id,$week,$i,$type->id) as $meal)
                                                @if($type->id == $meal->type_id)
                                                    <li style="list style:none">
                                                        <input type="radio" id="{{$meal->id}}_{{$i}}" class="{{$i}}" name="meals[{{$week}}{{$i}}{{$type->id}}][]"   value="{{$meal->id}}"
                                                       @if($meal->existInSystem($clientSubsription->id,$week,$i,$type->id)!=Null)
                                                           checked
                                                         @endif>

                                                        {{$meal->ar_name}}
{{--                                                        @dd($meal->existInSystem($clientSubsription->id,$week,$i,$type->id))--}}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div role="tabpanel" id="menu2" class="tab-pane">
                        <table  class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th></th>
                                <th>اليوم الاول </th>
                                <th>اليوم التانى </th>
                                <th>اليوم الثالث </th>
                                <th>اليوم الرابع </th>
                                <th>اليوم الخامس </th>
                                <th>اليوم السادس </th>
                                <th>اليوم السابع </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($week=2)
                            @foreach($types as $key => $type)
                                <tr>
                                    <td style="font-weight: 600;">{{ $type->name }}</td>
                                    @for($i=1;$i<=7;$i++)
                                        <td>
                                            @foreach(meals($clientSubsription->subscription_id,$week,$i,$type->id) as $meal)
                                                @if($type->id == $meal->type_id)
                                                    <li style="list style:none">
                                                        <input type="radio" id="{{$meal->id}}_{{$i}}" class="{{$i}}" name="meals[{{$week}}{{$i}}{{$type->id}}][]"   value="{{$meal->id}}"
                                                               @if($meal->existInSystem($clientSubsription->id,$week,$i,$type->id)!=Null)
                                                               checked
                                                            @endif>

                                                        {{$meal->ar_name}}
                                                        {{--                                                        @dd($meal->existInSystem($clientSubsription->id,$week,$i,$type->id))--}}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div role="tabpanel" id="menu3" class="tab-pane">
                        <table  class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th></th>
                                <th>اليوم الاول </th>
                                <th>اليوم التانى </th>
                                <th>اليوم الثالث </th>
                                <th>اليوم الرابع </th>
                                <th>اليوم الخامس </th>
                                <th>اليوم السادس </th>
                                <th>اليوم السابع </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($week=3)
                            @foreach($types as $key => $type)
                                <tr>
                                    <td style="font-weight: 600;">{{ $type->name }}</td>
                                    @for($i=1;$i<=7;$i++)
                                        <td>
                                            @foreach(meals($clientSubsription->subscription_id,$week,$i,$type->id) as $meal)
                                                @if($type->id == $meal->type_id)
                                                    <li style="list style:none">
                                                        <input type="radio" id="{{$meal->id}}_{{$i}}" class="{{$i}}" name="meals[{{$week}}{{$i}}{{$type->id}}][]"   value="{{$meal->id}}"
                                                               @if($meal->existInSystem($clientSubsription->id,$week,$i,$type->id)!=Null)
                                                               checked
                                                            @endif>

                                                        {{$meal->ar_name}}
                                                        {{--                                                        @dd($meal->existInSystem($clientSubsription->id,$week,$i,$type->id))--}}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                    <div role="tabpanel" id="menu4" class="tab-pane">
                        <table  class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th></th>
                                <th>اليوم الاول </th>
                                <th>اليوم التانى </th>
                                <th>اليوم الثالث </th>
                                <th>اليوم الرابع </th>
                                <th>اليوم الخامس </th>
                                <th>اليوم السادس </th>
                                <th>اليوم السابع </th>
                            </tr>
                            </thead>
                            <tbody>
                            @php($week=4)
                            @foreach($types as $key => $type)
                                <tr>
                                    <td style="font-weight: 600;">{{ $type->name }}</td>
                                    @for($i=1;$i<=7;$i++)
                                        <td>
                                            @foreach(meals($clientSubsription->subscription_id,$week,$i,$type->id) as $meal)
                                                @if($type->id == $meal->type_id)
                                                    <li style="list style:none">
                                                        <input type="radio" id="{{$meal->id}}_{{$i}}" class="{{$i}}" name="meals[{{$week}}{{$i}}{{$type->id}}][]"   value="{{$meal->id}}"
                                                               @if($meal->existInSystem($clientSubsription->id,$week,$i,$type->id)!=Null)
                                                               checked
                                                            @endif>

                                                        {{$meal->ar_name}}
                                                        {{--                                                        @dd($meal->existInSystem($clientSubsription->id,$week,$i,$type->id))--}}
                                                    </li>
                                                @endif
                                            @endforeach
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>

                    <div class="form-group text-right m-b-0">
                        <button class="btn btn-danger waves-effect" type="submit">حفظ</button>
                    </div>
                {!!Form::close() !!}
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
