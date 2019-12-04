<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<div class="book">
    <div class="page">
        <div class="d-flex justify-content-between">

            @foreach($qrcodes as $qrcode)

            <div class="card" style="width:33%; margin-top: 15px">
                <div class="card-body d-flex justify-content-center">
                    {!! QrCode::size(200)->generate($qrcode->code) !!}
                </div>
                <div class="card-footer d-flex justify-content-center">
                    <div class="font-weight-bold">{{ $qrcode->code }}</div>
                </div>
            </div>
                @if($loop->iteration % 12 == 0)
                    {{-- End Row --}}
                    </div>
                    {{-- End page --}}
                    </div>
                    <div class="page">
                        <div class="d-flex justify-content-between">

                @elseif($loop->iteration % 3 == 0)
                    </div>
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
      padding: 2cm;
      margin: 1cm auto;
      border: 1px #D3D3D3 solid;
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