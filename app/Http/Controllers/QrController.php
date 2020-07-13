<?php

namespace App\Http\Controllers;

use App\Models\QrCode;
use Illuminate\Http\Request;

class QrController extends Controller
{
    public function newCodes (Request $request)
    {
        $num = $request->qrNum;
        $labelSize = $request->labelSize;
        
        if($labelSize==21){

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
            $qrcode->code = $request->qrChar . '_' . $qrcode->code;
            $qrcode->save();

            $qrcodes[] = $qrcode;
        }

        return view('qr-print', ['qrcodes'=>$qrcodes, 'labelSize'=>$labelSize, 'rowNumbers'=>$rowNumbers]);
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
