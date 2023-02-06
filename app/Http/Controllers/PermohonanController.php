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
            'nama' => ['required', 'string', 'max:255'],
            'nim' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'perusahaan' => ['required', 'string', 'max:255'],
            'proposal' => ['required', 'string', 'max:255'],
            'dokumen' => ['required', 'string', 'max:255'],
            'sks' => ['required', 'string', 'max:255']
        ]);

        $contact = [
            'nama' => $request['nama'],
            'nim' => $request['nim'],
            'email' => $request['email'],
            'perusahaan' => $request['perusahaan'],
            'proposal' => $request['proposal'],
            'dokumen' => $request['dokumen'],
            'sks' => $request['sks'],
        ];


        try {
            //     //code...
            Mail::to('fadzil324@gmail.com')->send(new ContactFormMail($contact));
            // dd("BISA");

            return redirect()->route('permohonan')->with('status', ' Departemen akan memproses permohonan anda');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('permohonan')->with('error', ' Pesan Anda gagal terkirim');
        }
    }
}
