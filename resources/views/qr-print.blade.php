<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="book">
    <div class="page justify-content-center">
        <div class="d-flex justify-content-center">

            @foreach($qrcodes as $qrcode)

            {{-- <div class="card" style="width:100%; margin-top: 0px"> --}}
                <div class="card d-flex justify-content-center" style="width:70mm;  height:40mm;">
                    {!! QrCode::size(250)->generate($qrcode->code) !!}
                <div class="card-footer justify-content-center">
                    <div class="font-weight-bold" style="text-align: center;">{{ $qrcode->code }}</div>
                </div>
                </div>
            {{-- </div> --}}
                @if($loop->iteration % $labelSize == 0)
                    {{-- End Row --}}
                    </div>
                    {{-- End page --}}
                    </div>
                    {{-- Start New Page --}}
                    <div class="page">
                        {{-- Start New Row --}}
                        <div class="d-flex justify-content-center">

                @elseif($loop->iteration % $rowNumbers == 0)
                    {{-- End Row --}}
                    </div>
                    {{-- Start New Row --}}
                    <div class="d-flex justify-content-center">
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
     /* margin-top: 16mm;
      margin-bottom: 16mm;*/
      margin: 0cm;
      width: 23.5cm;
      min-height: 32cm;
    }

    @media print {
        html, body {
          background: white;
          zoom:120%;
        }

      .page {
        margin-top: 8mm !important;
        margin-bottom: 8mm;
        margin-left: 4mm;
        margin-right: 4mm;
        page-break-after: always;
      }
    }
</style>