@extends('admin.layout.master')

@section('styles')
    <style>
        .erro{
            color: red;
        }
    </style>
@endsection

@section('content')
    <!-- Page Title -->
    <div class="row">
        <div class="col-sm-12">
            <div class="btn-group pull-right m-t-15">

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <div class="card-box">
                <table id="datatable-buttons" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>المنتج</th>
                        <th>الكمية </th>
                        <th>الكمية الفعليه </th>
                        <th style="width: 250px;" >الجرد</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $i = 1; @endphp
                    @foreach($inventory->sizes as $row)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>{{$row->size->name}}</td>
                            <td>{{$row->quantity}}</td>
                            <td>{{$row->real_quantity}}</td>
                            <td>
                                @if($row->quantity > $row->real_quantity )
                                    <label class="label label-danger"> عجز</label>
                                @elseif($row->quantity < $row->real_quantity )
                                    <label class="label label-warning"> زيادة</label>
                                @else
                                    <label class="label label-success"> متساوى</label>

                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        </div><!-- end col -->
    </div>
@endsection
@section('scripts')
    <script>
        // Date Picker
        jQuery('#datepicker').datepicker();


        $('.dropify').dropify({
            messages: {
                'default': 'إضغط هنا او اسحب وافلت الصورة',
                'replace': 'إسحب وافلت او إضغط للتعديل',
                'remove': 'حذف',
                'error': 'حدث خطأ ما'
            },
            error: {
                'fileSize': 'حجم الصورة كبير (1M max).',
                'fileExtension': 'نوع الصورة غير مدعوم (png - gif - jpg - jpeg)',
            }
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        //        $("#spec").hide();
        //        $("#spec_label").hide();
        //
        //        $("#dept_select_label").hide();
        //        $("#dept_select").hide();


    </script>

    <script>
        $('#role_select').on('change', function () {

            var role_select = $('#role_select').val();


            console.log(role_select);

            if(role_select === 'technical'){
                $("#spec").show();
                $("#spec_label").show();
                $("#dept_select_label").hide();
                $("#dept_select").hide();

            }

            else if(role_select === 'dept_admin'){
                $("#dept_select_label").show();
                $("#dept_select").show();

                $("#spec").hide();
                $("#spec_label").hide();


            }

            else {
                $("#spec").hide();
                $("#spec_label").hide();

                $("#dept_select_label").hide();
                $("#dept_select").hide();
            }

        });

    </script>

@endsection
