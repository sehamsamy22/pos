@foreach($meals as $key => $meal)
<div class="col-sm-12 col-xs-12  pull-left">
    <div class="form-group form-float">
        <div class="checkbox checkbox-success checkbox-inline">
            <input type="checkbox" id="inlineCheckbox{{$meal->id}}"
            data-name="{{ $meal->ar_name }}" value="{{ $meal->id }}"
            data-price="{{ $meal->price }}"
            data-type="{{ $meal->typeMeal->name }}"
            name="meal[]">
            <label for="inlineCheckbox{{$meal->id}}">  {{ $meal->ar_name }} </label>
        </div>
    </div>
</div>
@endforeach
