@extends('admin.layout.master')
@section('title','إدارة المخزون')

@section('content')

    <!-- Page-Title -->
    <div class="row">
        <div class="col-sm-12">


            <h4 class="page-title"> شاشة  مسئول التشغيل  </h4>
        </div>
    </div>
    <!--End Page-Title -->

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box table-responsive">



                            <table  class="table table-striped table-bordered" cellspacing="0" width="100%">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>اسم الوجبة</th>
                                    <th>الكميه تم تجهزيها</th>
                                      <th>الكميه المستلمة</th>
                                        <th>الكميه الموزعة </th>
                                    <th>العمليات </th>
                                         
                                </tr>
                                </thead>
                                <tbody>
                                @php $i = 1; @endphp
                                @foreach($readymeals as $row)
                                  <form id="form-{{$row->id}}" >
                                   @csrf
                                    <tr>
                                        <td>{{$i++}}</td>
                                        <td>{{$row->meal->ar_name}}</td>
                                           
                                        <td><input type='number' class="form-control" name='quantity' value={{$row->quantity}}  readonly></td>
                                        <td><input type='number' class="form-control" name='received_quantity' value={{$row->received_quantity}} id='received_quantity{{$row->id}}' readonly></td>
                                        <td><input type='number' class="form-control" name='distributed_quantity' value={{$row->distributed_quantity}}  id='distributed_quantity{{$row->id}}' readonly></td>
                                        <td class="operation_btn{{$row->id}}">  
                                      
                                        <button type="submit" class="btn btn-danger " onclick="myfun({{$row->id}})" id="submit_btn{{$row->id}}">استلام</button>
    
                                        <button type="submit" class="btn btn-primary " onclick="myfun_distributed({{$row->id}})" id="submit_btn_distributed{{$row->id}}">  توزيع فى الاكياس</button>
                                     
                                        </td>
                                    </tr>
                                    </form>
                                @endforeach
                                </tbody>
                            </table>
                
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
                    url:"/dashboard/receive_meals/"+id,
                    data: form.serialize(),
                    success: function(data)
                    {
                        if(data.status='true'){
                            swal("  تم الاستلام", " تم استلام الوجبات من المطبخ", 'success', {
                                    buttons: 'موافق'
                            }); 
                            $('#submit_btn'+id).remove();
                            var x = document.createElement("INPUT");
                                    x.setAttribute("type", "button");
                                    x.setAttribute("value", "تم الاستلام");
                                    x.setAttribute("class", "btn btn-success");
                            document.getElementsByClassName("operation_btn"+id)[0].appendChild(x);
                         $('#received_quantity'+id).val(data.received_quantity);  

                        }else if(data.status='false'){
                          swal("   ", " الكميه غير متوفره الان بالمخزن", 'danger', {
                                    buttons: 'موافق'
                                });
                        }       
                    }   
                });     
                
            

            });
        }



           function myfun_distributed(id) {
            $('#form-'+id).submit(function(e) {
                e.preventDefault();
                var form = $(this);
                $.ajax({
                    type: "POST",
                    url:"/dashboard/distributed_meals/"+id,
                    data: form.serialize(),
                    success: function(data)
                    {
                        if(data.status='true'){
                            swal("  تم التوزيع", "تم توزيع الوجبات  فى الاكياس ", 'success', {
                                    buttons: 'موافق'
                            }); 
                            $('#submit_btn_distributed'+id).remove();
                            var xx = document.createElement("INPUT");
                                    xx.setAttribute("type", "button");
                                    xx.setAttribute("value", "تم التوزيع");
                                    xx.setAttribute("class", "btn btn-success");
                               document.getElementsByClassName("operation_btn"+id)[0].appendChild(xx);
                            $('#distributed_quantity'+id).val(data.distributed_quantity);  
     
                        }    
                    }   
                });     
                
            

            });
        }
    </script>

@endsection
 