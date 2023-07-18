<?php

namespace App\Http\Controllers;

use App\Models\User;
use NumberFormatter;
use App\Models\Bimbingan;
use App\Models\Penilaian;
use App\Models\Permohonan;
use App\Models\Pendaftaran;
use App\Models\Penjadwalan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Yaza\LaravelGoogleDriveStorage\Gdrive;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = User::where('email', Auth::user()->email)->first();
        $dosbing = Pendaftaran::leftJoin('users', 'pendaftarans.NIP', '=', 'users.NIP')
        ->select('users.name')
        ->where('pendaftarans.NIM', Auth::user()->NIM)->first();
        return view('mahasiswa.home', [
            "mhs" => $mhs,
            "dosbing" => $dosbing,
        ]);
        
    }

    public function pendaftaran()
    {
        $balancing = new MahasiswaController;
        $balancing->balancing();
        $mhs = User::where('email', Auth::user()->email)->first();
        $all = User::where('role_id', 4)->where('status', 1)->get();
        $pendaftaran = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
        $alldosen = [];
        $dp = "";
        $perusahaan = Permohonan::where('NIM', Auth::user()->NIM)->first();

        // untuk memastikan apakah user sudah melakukan proses permohonan kerja praktik
        if (!isset($perusahaan)) {
            return redirect('/mahasiswa/permohonan')->with('mohon ini form pendaftaran terlebih dahulu');
        }

        if (isset($pendaftaran['NIP'])) {
            $all = User::where('role_id', 4)->where('NIP', '!=', $pendaftaran['NIP'])->where('status', 1)->get();
            $dp = User::where('NIP', $pendaftaran['NIP'])->first();
        }
        foreach ($all as $dosen) {
            if($dosen['kuota_bimbingan'] != 0){
                if ($dosen['bobot_bimbingan'] % $dosen['kuota_bimbingan'] != 0) {
                    $alldosen[] = $dosen;
                } else if ($dosen['bobot_bimbingan'] == 0 && $dosen['kuota_bimbingan'] != 0) {
                    $alldosen[] = $dosen;
                }
            }
        }
        return view('mahasiswa.pendaftaran', [
            "mhs" => $mhs,
            "alldosen" => $alldosen,
            "pendaftaran" => $pendaftaran,
            "dp" => $dp,
        ]);
    }

    public function pendaftaranstore(Request $request)
    {
        // dd($request);
        $perusahaan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        $ini = Pendaftaran::where('NIM', Auth::user()->NIM)->first();

        if (!isset($perusahaan)) {
            return redirect('/mahasiswa/permohonan')->with('mohon ini form pendaftaran terlebih dahulu');
        }
        $this->validate($request, [
            'topik_kp' => 'required|string|max:255',
            'bukti' => 'file|max:5120|required',
            'dosbing' => 'required|string|max:20',
        ]);
        $foldername = Auth::user()->name .' - ' . Auth::user()->NIM;
        $file = $request->file('bukti');
        $fileName = $file->getClientOriginalName(); // Retrieve the original file name
        Storage::disk('google')->put($foldername . '/' . $fileName, file_get_contents($file));
        $link = 'https://drive.google.com/file/d/';
        $google = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileName)->first()['extraMetadata']['id'];
        // $google = Gdrive::all('/', true);
        // dd($google);
        // pengondisian untuk data yang sudah ada
        if (isset($ini)) {
            Pendaftaran::where('NIM', Auth::user()->NIM)->first()->update([
                'topik_kp' => $request->topik_kp,
                'bukti' => $google,
                'NIP' => $request->dosbing,
            ]);
        } else {
            Pendaftaran::create([
                'NIM' => Auth::user()->NIM,
                'topik_kp' => $request->topik_kp,
                'bukti' => $google,
                'NIP' => $request->dosbing,
            ]);
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
        // definisikan variabel
        $semua = User::where('role_id', 4)->where('status', '1')->get();

        foreach($semua as $bimbingan){
            $a = [];
            $bobot = Pendaftaran::where('NIP', $bimbingan['NIP'])->get();
            foreach($bobot as $b){
                if($b->pendaftaranmhs->status != 'Selesai KP'){
                    $a[] = 1;
                }
            }
            $jumlah = count($a);
            User::where('NIP', $bimbingan['NIP'])->first()->update([
                'bobot_bimbingan' => $jumlah
            ]);
        }
        // untuk menghitung kuota bimbingan dan bobot bimbingan
        $bobotbimbingan = 0;
        $kuotabimbingan = 0;
        $i = 0;
        //untuk memperbarui nilai dari variabel $semua, maka variabel didefinisikan kembali
        $semua = User::where('role_id', 4)->where('status', '1')->get();
        foreach ($semua as $bimbingan) {
            if($bimbingan['kuota_bimbingan'] == 0){
                $bobotbimbingan += 0;
                $kuotabimbingan += 0;
            }
            else if ($bimbingan['bobot_bimbingan'] == 0) {
                $bobotbimbingan += $bimbingan['bobot_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            } else if ($bimbingan['bobot_bimbingan'] % $bimbingan['kuota_bimbingan'] == 0) {
                $bobotbimbingan += $bimbingan['kuota_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            } else {
                $bobotbimbingan += $bimbingan['bobot_bimbingan'] % $bimbingan['kuota_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            }
        }
        // pengondisian untuk update bobot bimbingan dosen
        if ($bobotbimbingan >= $kuotabimbingan){
            foreach ($semua as $bimbingan) {
                if ($bimbingan['role_id'] == 4 && $bimbingan['status'] == '1') {
                    User::where('NIP', $bimbingan['NIP'])->first()->update([
                        'bobot_bimbingan' => 0,
                    ]);
                }
            }
        }else{
            foreach ($semua as $bimbingan){
                if($bimbingan['kuota_bimbingan'] == 0){
                    $ini = 0;
                }else{
                    $ini = $bimbingan['bobot_bimbingan'] % $bimbingan['kuota_bimbingan'];
                }
                if($ini == 0 && $bimbingan['bobot_bimbingan'] == 0){
                    User::where('NIP', $bimbingan['NIP'])->first()->update([
                        'bobot_bimbingan' => 0,
                    ]);
                }
                else if ($ini == 0){
                    User::where('NIP', $bimbingan['NIP'])->first()->update([
                        'bobot_bimbingan' => $bimbingan['kuota_bimbingan'],
                    ]);
                }else{
                    User::where('NIP', $bimbingan['NIP'])->first()->update([
                        'bobot_bimbingan' => $ini,
                    ]);
                }
            }
        }
        return redirect('/mahasiswa/pendaftaran')->with('status', 'pendaftaran created!');
    }

    public function exportPdf()
    {
        $identity = Auth::user();
        $permohonan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        $to_date = Carbon::parse($permohonan->selesai);
        $from_date = Carbon::parse($permohonan->mulai);
        $months = $to_date->diffInMonths($from_date);
        return view('mahasiswa.pdf.export-permohonan',[
            'data' => $identity,
            'permohonan' => $permohonan,
            'selisih' => $months,
        ]);
        // $pdf = Pdf::loadView('mahasiswa.pdf.export-permohonan');
        // return $pdf->download('permohonanKP-' . Auth::user()->name . '.pdf');
    }

    public function permohonanFakultas()
    {
        $identity = Auth::user();
        $permohonan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        $to_date = Carbon::parse($permohonan->selesai);
        $from_date = Carbon::parse($permohonan->mulai);
        $months = $to_date->diffInMonths($from_date);
        return view('mahasiswa.pdf.permohonan-fakultas',[
            'data' => $identity,
            'permohonan' => $permohonan,
            'selisih' => $months,
        ]);
        // $pdf = Pdf::loadView('mahasiswa.pdf.export-permohonan');
        // return $pdf->download('permohonanKP-' . Auth::user()->name . '.pdf');
    }

    public function kpA1() {
        $user = Auth::user();
        $nipdosen = Pendaftaran::where('NIM', $user->NIM)->first()->NIP;
        $dosen = User::where('NIP', $nipdosen)->first();
        $koor = User::where('role_id', 2)->first();
        $permohonan = Permohonan::where('NIM', $user->NIM)->first();
        return view('mahasiswa.pdf.kpA1', [
            'user' => $user,
            'dosen' => $dosen,
            'koor' => $koor,
            'permohonan' => $permohonan,
        ]);
    }

    public function kpB1() {
        $jadwal = Penjadwalan::where('NIM', Auth::user()->NIM)->first();
        $user = Auth::user();
        $nipdosen = Pendaftaran::where('NIM', $user->NIM)->first()->NIP;
        $dosen = User::where('NIP', $nipdosen)->first();
        $koor = User::where('role_id', 2)->first();
        return view('mahasiswa.pdf.kpB1', [
            'jadwal' => $jadwal,
            'dosen' => $dosen,
            'user' => $user,
            'koor'=> $koor,
        ]);
    }

    

    public function kpB3() {
        function numberToWords($number)
        {
            $formatter = new NumberFormatter('id', NumberFormatter::SPELLOUT);
            return $formatter->format($number);
        }
        $user = Auth::user();
        $nilai_laporan = $user->mhspenilaian->nilai_laporan;
        $nilai_seminar = $user->mhspenilaian->nilai_seminar;
        $nilai_laporan_spelled = numberToWords($nilai_laporan);
        $nilai_seminar_spelled = numberToWords($nilai_seminar);
        $dosen = Pendaftaran::where('NIM', Auth::user()->NIM)->first()->NIP;
        $dosbing = User::where('NIP', $dosen)->first();
        return view('mahasiswa.pdf.kpB3', [
            'user' => $user,
            'nilai_laporan_spelled' => $nilai_laporan_spelled,
            'nilai_seminar_spelled' => $nilai_seminar_spelled,
            'dosbing' => $dosbing,
        ]);
    }

    public function bimbinganstore(Request $request)
    {
        $this->validate($request, [
            'makalah' => 'file|max:5120|required',
            'judul' => 'max:255',
            'laporan' => 'file|max:5120|required',
        ]);

        $foldername = Auth::user()->name .' - ' . Auth::user()->NIM;
        $link = 'https://drive.google.com/file/d/';
        $filelaporan = $request->file('laporan');
        $fileNamelaporan = $filelaporan->getClientOriginalName(); // Retrieve the original file name
        Storage::disk('google')->put($foldername . '/' . $fileNamelaporan, file_get_contents($filelaporan));
        $googlelaporan = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNamelaporan)->first()['extraMetadata']['id'];
        $filemakalah = $request->file('makalah');
        $fileNamemakalah = $filemakalah->getClientOriginalName(); // Retrieve the original file name
        Storage::disk('google')->put($foldername . '/' . $fileNamemakalah, file_get_contents($filemakalah));
        $googlemakalah = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNamemakalah)->first()['extraMetadata']['id'];

        $nim = Auth::user()->NIM;
        $data = Bimbingan::where('NIM', $nim)->first();
        $penilaian = Penilaian::where('NIM', $nim)->first();
        if (isset($data)) {
            $dosbing = Pendaftaran::where('NIM', Auth::user()->NIM)->first()['NIP'];
            Bimbingan::where('NIM', $nim)->first()->update([
                'judul' => $request->judul,
                'makalah' => $googlemakalah,
                'laporan' => $googlelaporan,
                'status' => $request->status,
            ]);
        } else {
            $dosbing = Pendaftaran::where('NIM', Auth::user()->NIM)->first()['NIP'];
            Bimbingan::create([
                'NIP' => $dosbing,
                'NIM' => Auth::user()->NIM,
                'judul' => $request->judul,
                'makalah' => $googlemakalah,
                'laporan' => $googlelaporan,
            ]);

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
        return redirect('/mahasiswa/pengumpulan')->with('status', 'pengumpulan berkas created!');
    }
    public function penjadwalanstore(Request $request)
    {
        $this->validate($request, [
            'kehadiran' => 'file|max:5120|required',
            'survey' => 'file|max:5120|required',
            'ruangan' => 'max:15',
        ]);
        $foldername = Auth::user()->name .' - ' . Auth::user()->NIM;
        $link = 'https://drive.google.com/file/d/';
        $filesurvey = $request->file('survey');
        $fileNamesurvey = $filesurvey->getClientOriginalName(); // Retrieve the original file name
        Storage::disk('google')->put($foldername . '/' . $fileNamesurvey, file_get_contents($filesurvey));
        $googlesurvey = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNamesurvey)->first()['extraMetadata']['id'];
        $filekehadiran = $request->file('kehadiran');
        $fileNamekehadiran = $filekehadiran->getClientOriginalName(); // Retrieve the original file name
        Storage::disk('google')->put($foldername . '/' . $fileNamekehadiran, file_get_contents($filekehadiran));
        $googlekehadiran = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNamekehadiran)->first()['extraMetadata']['id'];

        $nim = Auth::user()->NIM;
        $pendaftaran = Pendaftaran::where('NIM', $nim)->first();
        $data = Bimbingan::where('NIM', $nim)->first();
        $penilaian = Penilaian::where('NIM', $nim)->first();
        $penjadwalan = Penjadwalan::where('NIM', $nim)->first();
        if (isset($penjadwalan)) {
            Penjadwalan::where('NIM', $nim)->first()->update([
                'jadwal' => $request->jadwal,
                'kehadiran' => $googlekehadiran,
                'ruangan' => $request->ruangan,
                'survey' => $googlesurvey,
                'status' => $request->status,
            ]);
        } else {
            Penjadwalan::create([
                'NIP' => $pendaftaran->NIP,
                'NIM' => Auth::user()->NIM,
                'jadwal' => $request->jadwal,
                'ruangan' => $request->ruangan,
                'kehadiran' => $googlekehadiran,
                'survey' => $googlesurvey,
                'status' => null
            ]);

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
        return redirect('/mahasiswa/penjadwalan')->with('status', 'penjadwalan berkas created!');
    }

    public function pengumpulan()
    {
        $mhs = User::where('email', Auth::user()->email)->first();
        // untuk memastikan apakah user sudah melakukan proses permohonan kerja praktik
        $perusahaan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        if (!isset($perusahaan)) {
            return redirect('/mahasiswa/permohonan')->with('mohon ini form pendaftaran terlebih dahulu');
        }
        return view('mahasiswa.pengumpulan', [
            "mhs" => $mhs,
        ]);
    }

    public function penjadwalan() {
        $mhs = User::where('NIM', Auth::user()->NIM)->first();
        return view('mahasiswa.penjadwalan', [
            'mhs' => $mhs,
        ]);
    }

    public function finalisasi()
    {
        $mhs = User::where('email', Auth::user()->email)->first();
        // untuk memastikan apakah user sudah melakukan proses permohonan kerja praktik
        $name = Auth::user()->name .' - ' . Auth::user()->NIM;
        $perusahaan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        $datas = Gdrive::all('/', true)->where('path', $name);
        if (!isset($perusahaan)) {
            return redirect('/mahasiswa/permohonan')->with('mohon ini form pendaftaran terlebih dahulu');
        }
        return view('mahasiswa.finalisasi', [
            "mhs" => $mhs,
        ]);
    }

    public function finalisasistore(Request $request)
    {
        $this->validate($request, [
            'a1' => 'file|max:5120|required',
            'a2' => 'file|max:5120|required',
            'b1' => 'file|max:5120|required',
            'b2' => 'file|max:5120|required',
            'b3' => 'file|max:5120|required',
            'b4' => 'file|max:5120|required',
            'b5' => 'file|max:5120|required',
        ]);
        
        $foldername = Auth::user()->name .' - ' . Auth::user()->NIM;
        $link = 'https://drive.google.com/file/d/';


        $filea1 = $request->file('a1');
        $fileNamea1 = $filea1->getClientOriginalName(); // Retrieve the original file name
        $filea2 = $request->file('a2');
        $fileNamea2 = $filea2->getClientOriginalName(); // Retrieve the original file name
        $fileb1 = $request->file('b1');
        $fileNameb1 = $fileb1->getClientOriginalName(); // Retrieve the original file name
        $fileb2  = $request->file('b2');
        $fileNameb2 = $fileb2->getClientOriginalName(); // Retrieve the original file name
        $fileb3 = $request->file('b3');
        $fileNameb3 = $fileb3->getClientOriginalName(); // Retrieve the original file name
        $fileb4 = $request->file('b4');
        $fileNameb4 = $fileb4->getClientOriginalName(); // Retrieve the original file name
        $fileb5 = $request->file('b5');
        $fileNameb5 = $fileb5->getClientOriginalName(); // Retrieve the original file name


        Storage::disk('google')->put($foldername . '/' . $fileNamea1, file_get_contents($filea1));
        $googlea1 = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNamea1)->first()['extraMetadata']['id'];
        Storage::disk('google')->put($foldername . '/' . $fileNamea2, file_get_contents($filea2));
        $googlea2 = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNamea2)->first()['extraMetadata']['id'];
        Storage::disk('google')->put($foldername . '/' . $fileNameb1, file_get_contents($fileb1));
        $googleb1 = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNameb1)->first()['extraMetadata']['id'];
        Storage::disk('google')->put($foldername . '/' . $fileNameb2, file_get_contents($fileb2));
        $googleb2 = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNameb2)->first()['extraMetadata']['id'];
        Storage::disk('google')->put($foldername . '/' . $fileNameb3, file_get_contents($fileb3));
        $googleb3 = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNameb3)->first()['extraMetadata']['id'];
        Storage::disk('google')->put($foldername . '/' . $fileNameb4, file_get_contents($fileb4));
        $googleb4 = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNameb4)->first()['extraMetadata']['id'];
        Storage::disk('google')->put($foldername . '/' . $fileNameb5, file_get_contents($fileb5));
        $googleb5 = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileNameb5)->first()['extraMetadata']['id'];


        $nim = Auth::user()->NIM;
        $data = Penilaian::where('NIM', $nim)->first();
        if (isset($data)) {
            Penilaian::where('NIM', $nim)->first()->update([
                'a1' => $googlea1,
                'a2' => $googlea2,
                'b4' => $googleb4,
                'b5' => $googleb5,
                'b2' => $googleb2,
                'b3' => $googleb3,
                'b1' => $googleb1,
                'status' => null,
            ]);
            // Bimbingan::where('NIM', $nim)->first()->update([
            //     'makalah' => $googlemakalah,
            //     'laporan' => $googlelaporan,
            // ]);
        } else {
            $dosbing = Pendaftaran::where('NIM', Auth::user()->NIM)->first()['NIP'];
            Penilaian::create([
                'NIP' => $dosbing,
                'NIM' => Auth::user()->NIM,
                'a1' => $googlea1,
                'a2' => $googlea2,
                'b4' => $googleb4,
                'b5' => $googleb5,
                'b2' => $googleb2,
                'b3' => $googleb3,
                'b1' => $googleb1,
                'status' => null,
            ]);
            // Bimbingan::where('NIM', $nim)->first()->update([
            //     'makalah' => $googlemakalah,
            //     'laporan' => $googlelaporan,
            // ]);
            // apakah bimbingan perlu dibuaat juga??
        }
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
        return redirect('/mahasiswa/finalisasi')->with('status', 'finalisasi berkas created!');
    }

    public function setting(Request $request)
    {
        $this->validate($request, [
            'imageUpload' => 'image|file|max:5120',
            'name' => 'required|string|max:50',
            'NIM' => 'required|digits:14',
            'username' => 'required|string|max:25',
            'email' => 'required|email',
            'no_telp' => 'required|digits_between:1,20',
            'sks' => 'required|digits_between:1,3',
            'alamat' => 'required|string|max:50',
            'semester' => 'required|digits_between:1,2',
            'new_password' => 'required_with:password_confirmation|same:password_confirmation'
        ]);
        if($request->username != Auth::user()->username){
            $this->validate($request,[
                'username' => 'unique:users,username'
            ]);
        }
        if($request->email != Auth::user()->email){
            $this->validate($request,[
                'email' => 'unique:users,email'
            ]);
        }
        if($request->NIM != Auth::user()->NIM){
            $this->validate($request,[
                'NIM' => 'unique:users,NIM'
            ]);
        }
        $pendaftaran = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
        $permohonan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        $bimbingan = Bimbingan::where('NIM', Auth::user()->NIM)->first();
        $penilaian = Penilaian::where('NIM', Auth::user()->NIM)->first();
        $penjadwalan = Penjadwalan::where('NIM', Auth::user()->NIM)->first();
        if (isset($pendaftaran)) {
            $pendaftaran->update([
                'NIM' => $request->NIM,
            ]);
        }
        if (isset($permohonan)) {
            $permohonan->update([
                'name' => $request->name,
                'NIM' => $request->NIM,
            ]);
        }
        if (isset($bimbingan)) {
            $bimbingan->update([
                'NIM' => $request->NIM,
            ]);
        }
        if (isset($penilaian)) {
            $penilaian->update([
                'NIM' => $request->NIM,
            ]);
        }
        if (isset($penjadwalan)) {
            $penjadwalan->update([
                'NIM' => $request->NIM,
            ]);
        }


        if ($request->file('imageUpload') == null) {
            $file = $request->oldImage;
        } elseif ($request->file('imageUpload')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $file = $request->file('imageUpload')->store('./public/avatar-images/mahasiswa');
        }


        if(isset($request->new_password)){
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            User::find(Auth::user()->id)->update([
                'image' => $file,
                'name' => $request->name,
                'NIM' => $request->NIM,
                'username' => $request->username,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'sks' => $request->sks,
                'semester' => $request->semester,
                'alamat' => $request->alamat,
                'password' => Hash::make($request->new_password),
            ]);
        }else{
            User::find(Auth::user()->id)->update([
                'image' => $file,
                'name' => $request->name,
                'NIM' => $request->NIM,
                'username' => $request->username,
                'email' => $request->email,
                'no_telp' => $request->no_telp,
                'sks' => $request->sks,
                'semester' => $request->semester,
                'alamat' => $request->alamat,
            ]);
        }
        return redirect('/mahasiswa')->with('success', 'finalisasi berkas created!');
    }

    // ini buat profil picturenya, blom jadi
    public function drive()
    {
        return view('/mahasiswa/drive');
    }
    public function driveUpload(Request $request)
    {
        $this->validate($request, [
            'proposal' => 'file|max:5120',
        ]);

        $foldername = Auth::user()->name .' - ' . Auth::user()->NIM;
        $file = $request->file('proposal');
        $fileName = $file->getClientOriginalName(); // Retrieve the original file name
        Storage::disk('google')->put($foldername . '/' . $fileName, file_get_contents($file));
        $link = 'https://drive.google.com/file/d/';
        $google = $link . Gdrive::all('/', true)->where('path', $foldername . '/' . $fileName)->first()['extraMetadata']['id'];

        $datas = Gdrive::all('/', true)->where('path', $foldername);
        // return Gdrive::all('/', true);
        return Gdrive::all('/', true);
        // return Gdrive::all('/', true)->where('path', $foldername . '/' . $fileName)->last();
        // return Gdrive::get('path/filename.png');
        
    }

    public function balancing(){
        $semua = User::where('role_id', 4)->where('status', '1')->get();

        foreach($semua as $bimbingan){
            $a = [];
            $bobot = Pendaftaran::where('NIP', $bimbingan['NIP'])->get();
            foreach($bobot as $b){
                if($b->pendaftaranmhs->status != 'Selesai KP'){
                    $a[] = 1;
                }
            }
            $jumlah = count($a);
            User::where('NIP', $bimbingan['NIP'])->first()->update([
                'bobot_bimbingan' => $jumlah
            ]);
        }
        // untuk menghitung kuota bimbingan dan bobot bimbingan
        $bobotbimbingan = 0;
        $kuotabimbingan = 0;
        $i = 0;
        //untuk memperbarui nilai dari variabel $semua, maka variabel didefinisikan kembali
        $semua = User::where('role_id', 4)->where('status', '1')->get();
        foreach ($semua as $bimbingan) {
            if($bimbingan['kuota_bimbingan'] == 0){
                $bobotbimbingan += 0;
                $kuotabimbingan += 0;
            }
            else if ($bimbingan['bobot_bimbingan'] == 0) {
                $bobotbimbingan += $bimbingan['bobot_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            } else if ($bimbingan['bobot_bimbingan'] % $bimbingan['kuota_bimbingan'] == 0) {
                $bobotbimbingan += $bimbingan['kuota_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            } else {
                $bobotbimbingan += $bimbingan['bobot_bimbingan'] % $bimbingan['kuota_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            }
        }
        // pengondisian untuk update bobot bimbingan dosen
        if ($bobotbimbingan >= $kuotabimbingan){
            foreach ($semua as $bimbingan) {
                if ($bimbingan['role_id'] == 4 && $bimbingan['status'] == '1') {
                    User::where('NIP', $bimbingan['NIP'])->first()->update([
                        'bobot_bimbingan' => 0,
                    ]);
                }
            }
        }else{
            foreach ($semua as $bimbingan){
                if($bimbingan['kuota_bimbingan'] == 0){
                    $ini = 0;
                }else{
                    $ini = $bimbingan['bobot_bimbingan'] % $bimbingan['kuota_bimbingan'];
                }
                if($ini == 0 && $bimbingan['bobot_bimbingan'] == 0){
                    User::where('NIP', $bimbingan['NIP'])->first()->update([
                        'bobot_bimbingan' => 0,
                    ]);
                }
                else if ($ini == 0){
                    User::where('NIP', $bimbingan['NIP'])->first()->update([
                        'bobot_bimbingan' => $bimbingan['kuota_bimbingan'],
                    ]);
                }else{
                    User::where('NIP', $bimbingan['NIP'])->first()->update([
                        'bobot_bimbingan' => $ini,
                    ]);
                }
            }
        }
    }
}
