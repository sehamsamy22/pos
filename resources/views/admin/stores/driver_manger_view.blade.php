@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> شاشة  مسئول السائقين  </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">

                            <form action="" method="post" accept-charset="utf-8" >
                              @csrf
                            <div class="form-group col-sm-4">
                                <label for="from"> الفترة من </label>
                                {!! Form::date("from",request('from'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة من ',"id"=>'from'])!!}
                            </div>
                            <div class="form-group col-sm-4">
                                <label for="to"> الفترة إلي </label>
                                {!! Form::date("to",request('to'),['class'=>'inlinedatepicker form-control inline-control','placeholder'=>' الفترة إلي ',"id"=>'to'])!!}
                            </div>

                            <div class="form-group col-sm-4">
                               <label for="">   </label>
                                <button type="submit" class="btn btn-success btn-block">بحث</button>
                            </div>
                            </form>
                            <div class="clearfix"></div>

                            <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم العميل</th>
                                    <th> المنطقة</th>
                                    <th> الجوال</th>
                                       <th> التاريخ</th>
                                    <th> العمليات </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @foreach($clients as $row)
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->name}}</td>
                                        <td>{{$row->area->name}}</td>
                                        <td>{{$row->phone}}</td>
                                       <td></td>
                                        <td>
                                        <label  class="operation_btn{{$row->id}}"></label>
                                       <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal{{$row->id}}" id="submit_btn{{$row->id}}"> اسناد للسائق</button>
                                        <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">اسناد لسائق</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                   <form id="form-{{$row->id}}">
                                                     @csrf
                                                <div class="modal-body">
                                                   <div class="col-sm-12 col-xs-12  pull-right">
                                                        <div class="form-group form-float">
                                                            <label class="form-label">اسم السائق</label>
                                                            <div class="form-line">
                                                                {{-- {!! Form::select("user_id",$users,null,['class'=>'form-control js-example-basic-single','id'=>'{{$row->id}}','placeholder'=>' اختر اسم السائق  '])!!} --}}

                                                                 <select name="user_id" id="user_id-{{$row->id}}" class="form-control" >
                                                                   @foreach($users as $user)
                                                                    <option value="{{$user->id}}">{{$user->name}}</option>
                                                                  @endforeach
                                                                    </select>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                                                    <button type="submit" class="btn btn-primary" onclick="myfun({{$row->id}})" data-dismiss="modal">اسناد</button>

                                                </div>
                                                   </form>
                                                </div>
                                            </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </form>
                                @endforeach
                                </tbody>
                            </table>

    </div>
    </div>
@endsection

@section('scripts')

    {{-- @include('admin.layout.form_validation_js') --}}

    <script>
             function myfun(id) {
                var user_id= $('#user_id-'+id).val();
                console.log(user_id);
                   $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
                $.ajax({
                    type: "POST",
                    url:"/dashboard/assign_driver/"+id,
                    data: {'user_id':user_id},
                    success: function(data)
                    {
                     if(data.status='true'){
                            swal("  تم الاسناد", " تم اسناد توصيل الوجبة للعميل ", 'success', {
                                    buttons: 'موافق'
                            });
                            $('#submit_btn'+id).remove();


                            $(".operation_btn"+id).text(data.data);

                        }
                    }
                });
            }
    </script>

@endsection
