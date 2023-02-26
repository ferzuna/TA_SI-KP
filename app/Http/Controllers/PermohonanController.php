<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
// use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;

class PermohonanController extends Controller
{

    public function index()
    {
        $data = Permohonan::where('NIM', Auth::user()->NIM)->first();
        if(!isset($data)){
            $data = [
                'perusahaan' => '',
                'proposal' => '',
                'dok_rekomendasi' => '',
                'sks' => '',
            ];
        }
        return view('mahasiswa.permohonan', [
            'data'=>$data
        ]);
    }
    public function sendPermohonan(Request $request)
    {
        $data = Permohonan::where('NIM', Auth::user()->NIM)->first();
        if(isset($data)){
            Permohonan::where('NIM', Auth::user()->NIM)->first()->update([
                'perusahaan' => $request->perusahaan,
                'proposal' => $request->proposal,
                'dok_rekomendasi' => $request->dok_rekomendasi,
                'sks' => $request->sks,
                'status'=> false,
            ]);
        }else{
        // $this->validate($request, [
        //     'perusahaan' => ['required', 'string', 'max:255'],
        //     'proposal' => ['required', 'string', 'max:255'],
        //     'dokumen' => ['required', 'string', 'max:255'],
        //     'sks' => ['required', 'string', 'max:255'],
        // ]);

        $contact = [
            'name' => Auth::user()->name,
            'NIM' => Auth::user()->NIM,
            'email' => Auth::user()->email,
            'perusahaan' => $request['perusahaan'],
            'proposal' => $request['proposal'],
            'dok_rekomendasi' => $request['dok_rekomendasi'],
            'sks' => $request['sks'],
            'status'=> false,
        ];
        Permohonan::create($contact);
    }

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
