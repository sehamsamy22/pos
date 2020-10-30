
   @foreach($types as $key => $type)

  <tr>
    <td>{{ $type->name }}</td>
    @for($i=1;$i<=7;$i++)
        <td>
        
            <div class="{{$i}}" style="display: inline">
            @foreach($type->meals_sub($id) as  $key=>$meal)
              {{$meal->ar_name}}-{{$meal->calories}}

                     <input type="radio" id="{{$meal->id}}_{{$i}}" class="{{$i}}" name="meals[{{$meal->id}}][{{ $i }}]">

            @endforeach
        </div>
        </td>
    @endfor
</tr>
@endforeach

