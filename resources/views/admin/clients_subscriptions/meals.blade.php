
   @foreach($types as $key => $type)

  <tr>
    <td>{{ $type->name }}</td>
    @for($i=1;$i<=7;$i++)
        <td style="">

            <div class="{{$i}}">
            @foreach($type->meals_sub($id) as  $key=>$meal)
            <li style="list style:none">
                <input type="radio" id="{{$meal->id}}_{{$i}}" class="{{$i}}" name="meals[{{$meal->id}}][{{ $i }}]" >
                {{$meal->ar_name}}
            </li>
            @endforeach
        </div>
        </td>
    @endfor
</tr>
@endforeach

   <script>

       function clicked(){

       $("input[type=radio]").click(function() {
               $(this).closest("div").find("input:radio").prop("disabled", this.checked);
               $(this).prop("disabled", false);
       });
     }

   </script>
