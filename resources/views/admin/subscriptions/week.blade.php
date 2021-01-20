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
                                <h5 class="modal-title" id="exampleModalLabel">اضافة وجبات  {{$type->name}}  </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="col-sm-12 col-xs-12" id="add-meals{{$week}}{{$i}}{{$type->id}}">
                                </div>

                                <div class="col-sm-12 col-xs-12 ">
                                    <div class="form-group form-float">
                                        @foreach($type->meals as $key => $meal)
                                            <div class="col-sm-12 col-xs-12  pull-left">
                                                <div class="form-group form-float">
                                                    <div class="checkbox checkbox-success checkbox-inline">
                                                        <input type="checkbox"
                                                               data-name="{{ $meal->ar_name }}" value="{{ $meal->id }}"
                                                               data-price="{{ $meal->price }}"
                                                               data-type="{{ $meal->typeMeal->name }}" name="meal[{{$week}}{{$i}}{{$type->id}}]">
                                                        <label >  {{ $meal->ar_name }} </label>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
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
                                <h5 class="modal-title" id="exampleModalLabel">عرض وجبات {{$type->name}}  </h5>
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
