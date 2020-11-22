<fieldset class="cat" >
    <legend > التصنيفات الفرعيه

    </legend>
    @foreach($subcategories as $subcategory)
        <a href=""   class=" btn btn-warning subcategory_btn" data-id="{{$subcategory->id}}">{{$subcategory->name}}</a>
    @endforeach
    <button type="button" class="btn btn-danger" id="reload" style="display: block">الرجوع للاصناف الرئيسيه<span class="m-l-5"><i class="fa fa-reply"></i></span></button>

</fieldset>

