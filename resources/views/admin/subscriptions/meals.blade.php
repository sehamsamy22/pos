@foreach($meals as $key => $meal)
<div class="col-sm-3 col-xs-3  pull-left">
    <div class="form-group form-float">
        <div class="checkbox checkbox-success checkbox-inline">
            <input type="checkbox" id="inlineCheckbox{{$meal->id}}" data-name="{{ $meal->ar_name }}" value="{{ $meal->id }}" name="meal[]">
            <label for="inlineCheckbox{{$meal->id}}">  {{ $meal->ar_name }} </label>
        </div>
    </div>
</div>
@endforeach
