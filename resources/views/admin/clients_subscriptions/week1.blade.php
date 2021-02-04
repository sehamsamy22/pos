<table  class="table table-striped table-bordered">
    <thead>
    <tr>
        <th></th>
        <th>اليوم الاول </th>
        <th>اليوم التانى </th>
        <th>اليوم الثالث </th>
        <th>اليوم الرابع </th>
        <th>اليوم الخامس </th>
        <th>اليوم السادس </th>
        <th>اليوم السابع </th>
    </tr>
    </thead>
    <tbody>
    @php($week=1)
    @foreach($types as $key => $type)
        <tr>
            <td style="font-weight: 600;">{{ $type->name }}</td>
            @for($i=1;$i<=7;$i++)
                <td>
                    @foreach(meal_sizes($id,$week,$i,$type->id) as $size)
                        @if($type->id == $size->meal->type_id)
                        <li style="list style:none">
                            <input type="radio" id="{{$size->meal->id}}_{{$i}}" class="{{$i}}" name="meals[{{$week}}{{$i}}{{$type->id}}][]"   value="{{$size->id}}">
                            {{$size->name}}
                        </li>
                        @endif
                    @endforeach
                </td>
            @endfor
        </tr>
    @endforeach
    </tbody>
</table>
