<div class="form-group form-float">
    <div class="form-line">
        <select class="form-control js-example-basic-single size_id" name="size_id" id="size_id" >
            <option   selected disabled> اختر حجم المنتج</option>
            @foreach($sizes as $size)
                <option value="{{$size->id}}"
                        data-id="{{$size->id}}"
                        data-name="{{$size->name}}"
                        data-price="{{$size->size_price}}">
                    {{$size->name}}
                </option>
            @endforeach
        </select>
    </div>
</div>
