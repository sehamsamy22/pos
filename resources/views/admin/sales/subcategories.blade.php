<fieldset class="cat" >
    <legend > التصنيفات الفرعيه </legend>
    @foreach($subcategories as $subcategory)
        <a href=""   class=" btn btn-warning subcategory_btn" data-id="{{$subcategory->id}}">{{$subcategory->name}}</a>
    @endforeach
</fieldset>
