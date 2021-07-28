<fieldset class="cat" >
    <legend >  المنتجات  </legend>
    @foreach($products as $product)
        <a href=""   class=" btn btn-primary meal_btn"
           data-id="{{$product->id}}"
           data-name="{{$product->ar_name}}"
           data-price="{{$product->price}}"

        >{{$product->ar_name}}</a>
    @endforeach

    <button type="button" class="btn btn-danger" id="reload" style="display: block">الرجوع للاصناف الرئيسيه
        <span class="m-l-5"><i class="fa fa-reply"></i></span>
    </button>

</fieldset>
