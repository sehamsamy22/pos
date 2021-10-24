<fieldset class="cat" >
    <legend > أحجام المنتجات </legend>
    @foreach($sizes as $size)
        <a href=""   class=" btn btn-primary size_btn"
           data-id="{{$size->id}}"
           data-name="{{$size->name}}"
           data-price="{{$size->size_price}}"

        >{{$size->name}}</a>
    @endforeach

    <button type="button" class="btn btn-danger" id="reload" style="display: block">الرجوع للاصناف الرئيسيه
        <span class="m-l-5"><i class="fa fa-reply"></i></span>
    </button>

</fieldset>
