<!-- custom comment : the next script is for graph -->
<script src="{{asset('/admin/assets/js/modernizr.min.js')}}"></script>

<script>
    var resizefunc = [];
</script>
<!-- jQuery  -->
<script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
<script src="{{asset('admin/assets/js/bootstrap-rtl.min.js')}}"></script>
<script src="{{asset('admin/assets/js/detect.js')}}"></script>
<script src="{{asset('admin/assets/js/fastclick.js')}}"></script>

<script src="{{asset('admin/assets/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.blockUI.js')}}"></script>
<script src="{{asset('admin/assets/js/waves.js')}}"></script>
<script src="{{asset('admin/assets/js/wow.min.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.nicescroll.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.scrollTo.min.js')}}"></script>



<!-- Datatables-->
<script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/dataTables.bootstrap.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/buttons.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/jszip.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/pdfmake.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/vfs_fonts.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/buttons.print.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/dataTables.keyTable.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/responsive.bootstrap.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/datatables/dataTables.scroller.min.js')}}"></script>

<!-- Datatable init js -->
<script src="{{asset('admin/assets/pages/datatables.init.js')}}"></script>


<!-- KNOB JS -->
<!--[if IE]>
<script type="text/javascript" src={{request()->root()}}/public/admin/assets/plugins/jquery-knob/excanvas.js/public"></script>
<![endif]-->
<script src="{{asset('admin/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>

<!--Morris Chart-->
<script src="{{asset('admin/assets/plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/raphael/raphael-min.js')}}"></script>

<!-- Dashboard init -->
<script src="{{asset('admin/assets/pages/jquery.dashboard.js')}}"></script>

<!-- Validation js (Parsleyjs) -->
<script type="text/javascript" src="{{asset('admin/assets/plugins/parsleyjs/dist/parsley.min.js')}}"></script>

<!-- Toastr js -->
<script src="{{asset('admin/assets/plugins/toastr/toastr.min.js')}}"></script>

<!-- Sweet Alert js -->
<script src="{{asset('admin/assets/plugins/bootstrap-sweetalert/sweet-alert.min.js')}}"></script>
<script src="{{asset('admin/assets/pages/jquery.sweet-alert.init.js')}}"></script>

<!-- Plugins Js -->
<script src="{{asset('admin/assets/plugins/switchery/switchery.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/assets/plugins/multiselect/js/jquery.multi-select.js')}}"></script>
<script type="text/javascript" src="{{asset('admin/assets/plugins/jquery-quicksearch/jquery.quicksearch.js')}}"></script>
<script src="{{asset('admin/assets/plugins/select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-inputmask/bootstrap-inputmask.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/assets/plugins/moment/moment.js')}}"></script>
<script src="{{asset('admin/assets/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/mjolnic-bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<script src="{{asset('admin/assets/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js')}}" type="text/javascript"></script>



<!-- file uploads js -->
<script src="{{asset('admin/assets/plugins/fileuploads/js/dropify.min.js')}}"></script>


<!-- isotope filter plugin -->
<script type="text/javascript" src="{{asset('admin/assets/plugins/isotope/dist/isotope.pkgd.min.js')}}"></script>

<!-- Magnific popup -->
<script type="text/javascript" src="{{asset('admin/assets/plugins/magnific-popup/dist/jquery.magnific-popup.min.js')}}"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>--}}

<!-- App js -->
<script src="{{asset('admin/assets/js/jquery.core.js')}}"></script>
<script src="{{asset('admin/assets/js/jquery.app.js')}}"></script>

<script>
    /// loading website

    jQuery(window).load(function () {
        $(".loader").fadeOut(500, function () {
            $(".loading").fadeOut(500);
            $("body").css("overflow-y", "auto");
        });
    });
</script>

{{--Some code for initalizing datatable--}}
<script type="text/javascript">
    $(document).ready(function() {
        $('#datatable').dataTable();
        $('#datatable-keytable').DataTable( { keys: true } );
        $('#datatable-responsive').DataTable({

            columnDefs: [{orderable: false, targets: [0]}],
            "language": {
                "lengthMenu": " عرض _MENU_ الصفحة",
                "info": "عرض الصفحة _PAGE_ من  _PAGES_",
                "infoEmpty": "لا يوجد بيانات متاحة الآن",
                "infoFiltered": "(التصفية _MAX_ من الإجمالي)",
                "paginate": {
                    "first": "الأولى",
                    "last": "الأخيرة",
                    "next": "التالي",
                    "previous": "السابق"
                },
                "search": "بحث:",
                "zeroRecords": "لا يوجد نتيجة لبحثك",
            },

        });
        $('#datatable-scroller').DataTable( { ajax: "assets/plugins/datatables/json/scroller-demo.json", deferRender: true, scrollY: 380, scrollCollapse: true, scroller: true } );
        var table = $('#datatable-fixed-header').DataTable( { fixedHeader: true } );
    } );
    TableManageButtons.init();

    $(document).ready(function() {
        $('form').parsley();
    });



    // This piece of code for toaster notification....

    @if(session()->has('success'))
        setTimeout(function () {
        showMessage('{{ session()->get('success') }}');
    }, 2000);

    @endif

    function showMessage(message) {
        var shortCutFunction = 'success';
        var msg = message;
        var title = "نجاح";
        toastr.options = {
            positionClass: 'toast-top-center',
            onclick: null,
            showMethod: 'slideDown',
            hideMethod: "slideUp",
            showDuration: "1000",
            hideDuration: "1000",
            timeOut: "1500",
            extendedTimeOut: "2000",
        };
        var $toast = toastr[shortCutFunction](msg, title);
        // Wire up an event handler to a button in the toast, if it exists
        $toastlast = $toast;
    }


</script>
