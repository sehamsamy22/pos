@extends('admin.layout.master')
@section('title',' طباعة الباركود')

@section('styles')
<style>
    body {
        width: 100%;
        height: 100%;
        margin: 0;
        padding: 0;
        background-color: #FAFAFA;
        font-family: "Tahoma";
        font-size: 10px;
    }
    * {
        box-sizing: border-box;
        -moz-box-sizing: border-box;
    }
    .page {
        box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        flex-wrap: wrap;
        margin: 5mm;
    }
    .subpage {
        padding: 5px;
        height: 2.5cm;
        width: 5cm;
        background-color: #fff;
        margin: 20px 5px;
        direction: ltr;
    }
    /**  /////////////////////////////  REEM ////////////////////////////////////// */
    .flex-r {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    p {
margin: 0;
line-height: 1.7;
font-size: 8px;
white-space: nowrap;
overflow: hidden;
text-overflow: ellipsis;
            direction: ltr !important;
}
    h3 {
        text-align: center;
        font-weight: 100;
        margin: 0 auto 3px auto ;
            font-size: 11px;
        line-height: 1;
    }
    .img {
        max-width: 100%;
        object-fit: contain;
        max-height: 30px;
        margin: 0 auto;
        text-align: center;
        display: table;
    }
    img {
        max-width: 100%;
        object-fit: contain;
        max-height: 100%;
    }
    @page {
    margin: 0;
      size: 5cm 2.5cm;
}

@media print {
    .img div > div {
background-color: #000 !important;
}
    body {
-webkit-print-color-adjust: exact !important;
        font-size: 5px !important;
}
    p {
        font-size: 5px !important;
    }
    h3{
        font-size: 7px !important;
        font-weight: 700 !important
    }
    @page {
    margin: 0;
      size: 5cm 2.5cm;
}
    .subpage , #printableArea , body{
        padding: 1px;
        height: 2.5cm;
        width: 5cm;
        background-color: #fff;
        direction: ltr;
    }

}
</style>


        @endsection

        @section('content')
            <!-- Page Title -->

            <div class="row">
                <div class="card-box table-responsive flex-r page">
                 <input type="button" onclick="printDiv('printableArea')" value="طباعة" />
                    <div id="printableArea" class="subpage">
                        <div class="img">
                            @if(isset($row->barcode))
                                {!! DNS1D::getBarcodeHTML($size->barcode ,"C128",1.4,22) !!}
                                    <b>  {{$size->barcode}}</b><br>
                                    @endif
                                    <b>  {{$size->name}}</b><br>
                                    <b>  {{$size->size_price}}</b>
                        </div>

                    </div>

                </div>
            </div>
            @endsection

@section('scripts')

<script>
    function printDiv(divName) {
        var printContents = document.getElementById(divName).innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
   }


</script>
@endsection
