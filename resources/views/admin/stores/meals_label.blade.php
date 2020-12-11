@foreach($clients as $client)
    @for($i=1;$i< $Ready_meal->quantity;$i++)
<table  class="table-bordered" id="{{$i}}" style="margin-bottom: 50px;">
    <thead>
    <tr>
    <th>اسم الوجبة </th>
    <th>اسم العميل</th>
    </tr>
    </thead>

    <tbody  >

        <tr>
            <td>{{$Ready_meal->meal->ar_name}}</td>
            <td>{{ $client->name}}</td>
        </tr>


    </tbody>

</table>
    @endfor
@endforeach

<script>
    window.print();

</script>


</html>
