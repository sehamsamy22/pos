  <legend > التصنيفات الرئيسة </legend>
@foreach($categories as $category)
 <a href="#"  class=" btn btn-success category_btn" onclick="category(event,{{$category->id }})" data-id="{{$category->id}}">{{$category->name}}</a>
  @endforeach
