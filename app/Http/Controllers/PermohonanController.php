<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class PermohonanController extends Controller
{

    public function index()
    {
        return view('permohonan');
    }
    public function sendPermohonan(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'perusahaan' => ['string', 'max:255'],
            'proposal' => ['required', 'string', 'max:255'],
            'dokumen' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'int', 'max:10']
        ]);

        $contact = [
            'name' => $request['name'],
            'nim' => $request['nim'],
            'email' => $request['email'],
            'perusahaan' => $request['perusahaan'],
            'proposal' => $request['proposal'],
            'dokumen' => $request['dokumen'],
            'sks' => $request['sks'],
        ];
        dd("bisa");

        // try {
        //     //code...
        //     Mail::to('noreply.sikp@gmail.com')->send(new ContactFormMail($contact));
        //     dd("BISA");

        //     return redirect()->route('permohonan')->with('status', ' Pesan Anda telah terkirim');
        // } catch (\Exception $e) {
        //     //throw $th;
        //     dd("GABISA");
        //     return redirect()->route('permohonan')->with('error', ' Pesan Anda gagal terkirim');
        // }
    }
}
