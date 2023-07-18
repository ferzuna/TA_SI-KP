<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bimbingan;
use App\Models\Penilaian;
use App\Models\Permohonan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class PermohonanController extends Controller
{

    public function index()
    {
        $mhs = User::where('email', Auth::user()->email)->first();
        $data = Permohonan::where('NIM', Auth::user()->NIM)->first();
        return view('mahasiswa.permohonan', [
            'mhs' => $mhs,
            'data'=>$data
        ]);
    }
    public function sendPermohonan(Request $request)
    {
        $this->validate($request, [
            'perusahaan' => 'required|string|max:50',
            'proposal' => 'file|max:5120|required',
            'alamat' => 'string|max:75',
        ]);
        
        $foldername = Auth::user()->name .' - ' . Auth::user()->NIM;
        $file = $request->file('proposal');
        $fileName = $file->getClientOriginalName(); // Retrieve the original file name
        Storage::disk('google')->put($foldername . '/' . $fileName, file_get_contents($file));
        $link = 'https://drive.google.com/file/d/';
        $google = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileName)->first()['extraMetadata']['id'];
        $name = Gdrive::all('/', true)->where('path', $foldername . '/' . $fileName)->first()['path'];

        $data = Permohonan::where('NIM', Auth::user()->NIM)->first();
        if(isset($data)){
            Permohonan::where('NIM', Auth::user()->NIM)->first()->update([
                'perusahaan' => $request->perusahaan,
                'alamatins' => $request->alamat,
                'proposal' => $google,
                'mulai' => $request->mulai,
                'selesai' => $request->selesai,
                'status' => false,
            ]);
        }else{
        $contact = [
            'NIM' => Auth::user()->NIM,
            'email' => Auth::user()->email,
            'perusahaan' => $request->perusahaan,
            'alamatins' => $request->alamat,
            'proposal' => $google,
            'mulai' => $request->mulai,
            'selesai' => $request->selesai,
            'status'=> false,
        ];
        Permohonan::create($contact);

        $status1 = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
        $status2 = Bimbingan::where('NIM', Auth::user()->NIM)->first();
        $status3 = Penilaian::where('NIM', Auth::user()->NIM)->first();
        if(isset($status3)){
            User::where('NIM', Auth::user()->NIM)->first()->update([
                'status' => 'Selesai KP'
            ]);
        }else if(isset($status2)){
            User::where('NIM', Auth::user()->NIM)->first()->update([
                'status' => 'Bimbingan KP'
            ]);
        }else if(isset($status1)){
            User::where('NIM', Auth::user()->NIM)->first()->update([
                'status' => 'Pendaftaran KP'
            ]);
        }else{
            User::where('NIM', Auth::user()->NIM)->first()->update([
                'status' => 'Permohonan KP'
            ]);
        }
    }

        try {
            //     //code...
            // Mail::to('fadzil324@gmail.com')->send(new ContactFormMail($contact));
            // dd("BISA");

            return redirect()->route('permohonan')->with('status', ' Departemen akan memproses permohonan anda');
        } catch (\Exception $e) {
            //throw $th;
            return redirect()->route('permohonan')->with('error', ' Pesan Anda gagal terkirim');
        }
    }
}
