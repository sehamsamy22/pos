<fieldset class="cat" >
    <legend >  المنتجات او  الوجبات </legend>
    @foreach($meals as $meal)
        <a href=""   class=" btn btn-primary meal_btn"
           data-id="{{$meal->id}}"
           data-name="{{$meal->ar_name}}"
           data-price="{{$meal->price}}"

        >{{$meal->ar_name}}</a>
    @endforeach
</fieldset>
