<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use App\Http\Requests\QrCodeRequest;

class QrController extends Controller
{
    public function newCodes (QrCodeRequest $request)
    {

        $num = $request->qrNum;
        $label_number = $request->label_number;

        if($label_number==21){

            $rowNumbers=3;
        }else{

            $rowNumbers=2;
        }
        //create new QR code entries
        $qrcodes = [];

        for($i = 0; $i < $num; $i++) {
            $qrcode = QrCode::create([
                'code' => rand(pow(10, 3), pow(10, 4)-1),
                'status' => 'new',
            ]);
            $qrcode->code = $request->prefix . '_' . sprintf('%06d', $qrcode->id);
            $qrcode->save();

            $qrcodes[] = $qrcode;
        }

        return view('qr-print', ['qrcodes'=>$qrcodes, 'labelSize'=>$label_number, 'rowNumbers'=>$rowNumbers]);
    }

    public function printView ()
    {

        if(session('qrcodes')) {

            $qrcodes = session()->get('qrcodes');
        }
        else {
            $qrcodes = QrCode::all();
        }

        return view('qr-print',compact('qrcodes'));
    }
}
