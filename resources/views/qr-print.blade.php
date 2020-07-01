<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="book">
    <div class="page">
        <div class="d-flex justify-content-between">

            @foreach($qrcodes as $qrcode)

            {{-- <div class="card" style="width:100%; margin-top: 0px"> --}}
                <div class="card justify-content-center" style="width:70mm;  height:36mm;">
                    {!! QrCode::size(200)->generate($qrcode->code) !!}
                {{-- <div class="card-footer d-flex justify-content-center"> --}}
                    <div class="font-weight-bold" style="text-align: center;">{{ $qrcode->code }}</div>
                {{-- </div> --}}
                </div>
            {{-- </div> --}}
                @if($loop->iteration % 24 == 0)
                    {{-- End Row --}}
                    </div>
                    {{-- End page --}}
                    </div>
                    {{-- Start New Page --}}
                    <div class="page">
                        {{-- Start New Row --}}
                        <div class="d-flex justify-content-between">

                @elseif($loop->iteration % 3 == 0)
                    {{-- End Row --}}
                    </div>
                    {{-- Start New Row --}}
                    <div class="d-flex justify-content-between">
                @endif


            @endforeach
        </div>
    </div>
</div>


<style>
    body {
      margin: 0;
      padding: 0;
      background-color: #FAFAFA;
      font: 12pt "Tahoma";
    }

    * {
      box-sizing: border-box;
      -moz-box-sizing: border-box;
    }

    .page {
      width: 21cm;
      min-height: 29.7cm;
      padding: 0cm;
      margin: 0cm auto;
      border: 0px #D3D3D3 solid;
      border-radius: 5px;
      background: white;
      box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
    }

    .subpage {
      padding: 1cm;
      border: 5px red solid;
      height: 256mm;
      outline: 2cm #FFEAEA solid;
    }

    @page {
      size: A4;
      margin: 0;
    }

    @media print {
        html, body {
            width: 210mm;
            height: 297mm;
        }
      .page {
        margin: 0;
        border: initial;
        border-radius: initial;
        width: initial;
        min-height: initial;
        box-shadow: initial;
        background: initial;
        page-break-after: always;
      }
    }
</style>