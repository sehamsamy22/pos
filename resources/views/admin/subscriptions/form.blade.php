@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> اسم الخطة</label>
        <div class="form-line">
            {!! Form::text("name",null,['class'=>'form-control','placeholder'=>'اسم الخطة','data-parsley-required-message'=>'من فضلك ادخل الكود  ','required'=>''])!!}
        </div>
    </div>
</div>


<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> السعر</label>
        <div class="form-line">
            {!! Form::text("price",null,['class'=>'form-control','placeholder'=>' السعر','data-parsley-required-message'=>'من فضلك ادخل السعر  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">  مده الخطه</label><span class="required--in"> (عدد  الايام)</span>
        <div class="form-line">
            {!! Form::text("duration",null,['class'=>'form-control','placeholder'=>'  مده الخطه','data-parsley-required-message'=>'من فضلك ادخل  مده الخطه  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> عدد الوجبات</label>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
        اخترالوجبات
        </button>
        <div class="form-line">
            {!! Form::text("num_meals",null,['class'=>'form-control','placeholder'=>' عدد الوجبات','data-parsley-required-message'=>'من فضلك ادخل السعر  ','required'=>''])!!}
        </div>
    </div>
</div>
{{--  <!-- $table->enum('type', ['breakfast','mini_breakfast' ,'lunch','mini_lunch','dinner','mini_dinner']); -->  --}}

{{--  <div class="col-sm-12 col-xs-12  pull-left">
<label class="text-muted font-13 m-b-15 m-t-20">الواجبات</label>
     @foreach($types as $key => $type)
    <div class="checkbox checkbox-success checkbox-inline">
        <input type="checkbox" id="inlineCheckbox{{$type->id}}" value="{{ $type->id }}" name="meal[]">
        <label for="inlineCheckbox{{$type->id}}">  {{ $type->name }} </label>
    </div>

    @endforeach
</div>  --}}


<!-- unit table-->
<div class="table-striped"  id="mealsTable-wrap">
    <span>الواجبات </span>
    <table class="table table-striped table-bordered"  style="background-color: #5b69bc59">
    <thead>
        <tr>
            <th> اسم الوجبه</th>
            <th>العمليات</th>
        </tr>
    </thead>

    <tbody class="add-meals">
        @if(isset($subscription))
        @foreach($subscription->meals as $key => $value)
       <tr>
           <td>{{ $value->meal->ar_name }}</td>
            <td>
                <a href="#" onclick="Delete({{$value->id}})" class="label label-danger">حذف</a>

                {!!Form::open( ['route' => ['dashboard.subscriptions-meal.destroy',$value->id] ,'id'=>'delete-form'.$value->id, 'method' => 'Delete']) !!}
                {!!Form::close() !!}</td>
        </tr>
        @endforeach
        @endif
    </tbody>

</table>
</div>


<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label">  نسبةالخصم </label>
        <div class="form-line">
            {!! Form::text("discount",null,['class'=>'form-control','placeholder'=>'نسبةالخصم','data-parsley-required-message'=>'من فضلك ادخل نسبةالخصم  ','required'=>''])!!}
        </div>
    </div>
</div>

<div class="col-sm-12 col-xs-12  pull-right">
    <div class="form-group form-float">
        <label class="form-label"> وصف  الخطه</label>
        <div class="form-line">
            {!! Form::textarea("description",null,['class'=>'form-control','placeholder'=>'  وصف  الخطه','data-parsley-required-message'=>'من فضلك ادخل نوع الاشتراك  ','required'=>''])!!}
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">اضافة وجبات للخطة </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
                <div class="col-sm-12 col-xs-12 ">
                    <div class="form-group form-float">
                    <label class="form-label"> نوع الوجبة</label>
                    <div class="form-line" >
                        {!! Form::select("type_id",$types,null,['class'=>'form-control js-example-basic-single','placeholder'=>' اختر  نوع الوجبة  ','id'=>'type_id'])!!}

                    </div>
                </div>
            </div>

            <div class="meals-inpusts"></div>

       </div>
      <div class="modal-footer">
        {{--  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  --}}
        <button type="button" class="btn btn-primary" onclick="myFun(event)" data-dismiss="modal">أضافة </button>
      </div>
    </div>
  </div>
</div>

<div class="form-group text-right m-b-0">
    <button class="btn btn-primary waves-effect" type="submit">حفظ</button>
</div>

