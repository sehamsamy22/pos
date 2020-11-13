@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> شاشة  مسئول المطبخ  </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">



            <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" role="tab" aria-controls="menu1" href="#menu1">   استلام الكميات  </a></li>
                        <li><a data-toggle="tab" role="tab" aria-controls="menu2" href="#menu2">  تجهيز الوجبات </a></li>
             </ul>

                    <div class="tab-content">
                        <div role="tabpanel" id="menu1" class="tab-pane active">
                            <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الصنف</th>
                                    <th>الكميه المتوفرة</th>
                                    <th>الكمية المطلوبه  </th>
                                    <th>استلام </th>
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @foreach($storeproducts as $row)
                                  <form id="form-{{$row->id}}" >
                                   @csrf
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->product->ar_name}}</td>
                                        <td><input name="" type="number" class="form-control"  value={{$row->quantity}} id="quantity{{$row->id}}" readonly></td>
                                    
                                        <td><input type='number' class="form-control" name='quantity' value={{$row->product->orders($row->product->id)}}  readonly></td>
                                        <td class="received_btn{{$row->id}}">  

                                        <button type="submit" class="btn btn-danger " onclick="myfun({{$row->id}})" id="submit_btn{{$row->id}}">استلام</button>

                                        </td>
                                    </tr>
                                    </form>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div role="tabpanel" id="menu2" class="tab-pane">
                            <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                    <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>اسم الوجبة</th>
                                        <th>الكميه المطلوبة</th>
                                        <th>الحالة </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i = 1; @endphp
                                    @foreach($meals as $row)
                                     <form id="formready-{{$row->id}}" >
                                      @csrf
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$row->ar_name}}</td>                                   
                                           <td><input type='number' class="form-control" name='quantity' value={{$row->orders($row->id)}}  readonly></td>

                                           <td class="ready_btn{{$row->id}}">  

                                            <button type="submit" class="btn btn-warning " onclick="myfun_ready({{$row->id}})" id="submit_btn_ready{{$row->id}}">تجهيزوتحضير</button>

                                            </td>
                                        </tr>
                                        </form>
                                    @endforeach
                                    </tbody>
                            </table>
                        </div>
                    </div>
    </div>
    </div>
@endsection

@section('scripts')

    {{-- @include('admin.layout.form_validation_js') --}}

    <script>

        function myfun(id) {
            $('#form-'+id).submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: "POST",
                    url:"/dashboard/receive_products/"+id,
                    data: form.serialize(),
                    success: function(data)
                    {
                        if(data.status='true'){
                            swal("  تم الاستلام", " تم استلام الاصناف من المخزن", 'success', {
                                    buttons: 'موافق'
                            }); 
                            $('#submit_btn'+id).remove();
                            var x = document.createElement("INPUT");
                                    x.setAttribute("type", "button");
                                    x.setAttribute("value", "تم الاستلام");
                                    x.setAttribute("class", "btn btn-success");
                            document.getElementsByClassName("received_btn"+id)[0].appendChild(x);
                                   
                        }else if(data.status='false'){
                          swal("   ", " الكميه غير متوفره الان بالمخزن", 'danger', {
                                    buttons: 'موافق'
                                });
                        }       
                    }   
                });     
                
            

            });
        }



           function myfun_ready(meal_id) {
            $('#formready-'+meal_id).submit(function(e) {
                e.preventDefault();
                var form_r = $(this);
                $.ajax({
                    type: "POST",
                    url:"/dashboard/ready_meals/"+meal_id,
                    data: form_r.serialize(),
                    success: function(data)
                    {
                        if(data.status='true'){
                            swal("  تم التجهيز", " تم تجهيز الوجبات", 'success', {
                                    buttons: 'موافق'
                            }); 
                            $('#submit_btn_ready'+meal_id).remove();
                            var xx = document.createElement("INPUT");
                                    xx.setAttribute("type", "button");
                                    xx.setAttribute("value", "تم التجهيز");
                                    xx.setAttribute("class", "btn btn-success");
                               document.getElementsByClassName("ready_btn"+meal_id)[0].appendChild(xx);
                                   
                        }    
                    }   
                });     
                
            

            });
        }
    </script>

@endsection
 