  <legend > التصنيفات الرئيسة </legend>
@foreach($categories as $category)
 <a  class=" btn btn-success category_btn" data-id="{{$category->id}}">{{$category->name}}</a>
  @endforeach
