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
    @php($week=2)
    @foreach($types as $key => $type)
        <tr>
            <td style="font-weight: 600;">{{ $type->name }}</td>
            @for($i=1;$i<=7;$i++)
                <td>
                    @foreach(meals($id,$week,$i,$type->id) as $meal)
                        @if($type->id == $meal->type_id)

                        <li style="list style:none">
                            <input type="radio" id="{{$meal->id}}_{{$i}}" class="{{$i}}" name="meals[{{$week}}{{$i}}{{$type->id}}][]"   value="{{$meal->id}}">
                            {{$meal->ar_name}}
                        </li>
                        @endisset
                    @endforeach
                </td>
            @endfor
        </tr>
    @endforeach
    </tbody>
</table>
