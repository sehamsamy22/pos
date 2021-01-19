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
                <td >
                    <div class="{{$i}}" style="display: inline-block;">
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal{{$week}}{{$i}}{{$type->id}}">
                            <span class="m-l-5"><i class="fa fa-plus"></i></span>
                        </button>

                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#info{{$week}}{{$i}}{{$type->id}}">
                            <span class="m-l-5"><i class="fa fa-info"></i></span>
                        </button>

                    </div>
                </td>
                <!-- Modal -->
                <div class="modal fade" id="exampleModal{{$week}}{{$i}}{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">اضافة وجبات للخطة </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xs-12" id="add-meals{{$week}}{{$i}}{{$type->id}}">
                                </div>

                                <div class="col-sm-12 col-xs-12 ">
                                    <div class="form-group form-float">
                                        <label class="form-label"> نوع الوجبة</label>
                                        <div class="form-line" >
                                            {!! Form::select("type_id",$typesArray,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر  نوع الوجبة  ','id'=>$week.$i.$type->id ])!!}

                                        </div>
                                    </div>
                                </div>

                                <div class="meals-inpusts"></div>

                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" onclick="myFun(event,{{$week}}{{$i}}{{$type->id}})" data-dismiss="modal">أضافة </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="info{{$week}}{{$i}}{{$type->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">عرض وجبات الخطة </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xs-12" id="show-meals{{$week}}{{$i}}{{$type->id}}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </tr>
    @endforeach
    </tbody>
</table>
