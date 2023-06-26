<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bimbingan;
use App\Models\Penilaian;
use App\Models\Permohonan;
use App\Models\Pendaftaran;
use App\Models\Penjadwalan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use NumberFormatter;
use Illuminate\Support\Facades\Hash;

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
            'bukti' => 'max:255',
            'dosbing' => 'required|string|max:20',
        ]);
        // pengondisian untuk data yang sudah ada
        if (isset($ini)) {
            Pendaftaran::where('NIM', Auth::user()->NIM)->first()->update([
                'topik_kp' => $request->topik_kp,
                'bukti' => $request->bukti,
                'NIP' => $request->dosbing,
            ]);
        } else {
            Pendaftaran::create([
                'NIM' => Auth::user()->NIM,
                'topik_kp' => $request->topik_kp,
                'bukti' => $request->bukti,
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
        $number = 88;
        $spelled = numberToWords($number);
        $dosen = Pendaftaran::where('NIM', Auth::user()->NIM)->first()->NIP;
        $dosbing = User::where('NIP', $dosen)->first();
        return view('mahasiswa.pdf.kpB3', [
            'spelled' => $spelled,
            'dosbing' => $dosbing,
        ]);
    }

    public function bimbinganstore(Request $request)
    {
        $this->validate($request, [
            'makalah' => 'max:255',
            'judul' => 'max:255',
            'laporan' => 'max:255',
        ]);
        $nim = Auth::user()->NIM;
        $data = Bimbingan::where('NIM', $nim)->first();
        $penilaian = Penilaian::where('NIM', $nim)->first();
        if (isset($data)) {
            $dosbing = Pendaftaran::where('NIM', Auth::user()->NIM)->first()['NIP'];
            Bimbingan::where('NIM', $nim)->first()->update([
                'judul' => $request->judul,
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
                'status' => $request->status,
            ]);
        } else {
            $dosbing = Pendaftaran::where('NIM', Auth::user()->NIM)->first()['NIP'];
            Bimbingan::create([
                'NIP' => $dosbing,
                'NIM' => Auth::user()->NIM,
                'judul' => $request->judul,
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
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
            'kehadiran' => 'max:255',
            'survey' => 'max:255',
            'ruangan' => 'max:15',
        ]);
        $nim = Auth::user()->NIM;
        $pendaftaran = Pendaftaran::where('NIM', $nim)->first();
        $data = Bimbingan::where('NIM', $nim)->first();
        $penilaian = Penilaian::where('NIM', $nim)->first();
        $penjadwalan = Penjadwalan::where('NIM', $nim)->first();
        if (isset($penjadwalan)) {
            Penjadwalan::where('NIM', $nim)->first()->update([
                'jadwal' => $request->jadwal,
                'kehadiran' => $request->kehadiran,
                'ruangan' => $request->ruangan,
                'survey' => $request->survey,
                'status' => $request->status,
            ]);
        } else {
            Penjadwalan::create([
                'NIP' => $pendaftaran->NIP,
                'NIM' => Auth::user()->NIM,
                'jadwal' => $request->jadwal,
                'ruangan' => $request->ruangan,
                'kehadiran' => $request->kehadiran,
                'survey' => $request->survey,
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
        $perusahaan = Permohonan::where('NIM', Auth::user()->NIM)->first();
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
            'makalah' => 'max:255',
            'laporan' => 'max:255',
            'a1' => 'max:255',
            'a2' => 'max:255',
            'b1' => 'max:255',
            'b2' => 'max:255',
            'b3' => 'max:255',
            'b4' => 'max:255',
            'b5' => 'max:255',
        ]);
        $nim = Auth::user()->NIM;
        $data = Penilaian::where('NIM', $nim)->first();
        if (isset($data)) {
            Penilaian::where('NIM', $nim)->first()->update([
                'a1' => $request->a1,
                'a2' => $request->a2,
                'b4' => $request->b4,
                'b5' => $request->b5,
                'b2' => $request->b2,
                'b3' => $request->b3,
                'b1' => $request->b1,
                'status' => 0,
            ]);
            Bimbingan::where('NIM', $nim)->first()->update([
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
            ]);
        } else {
            $dosbing = Pendaftaran::where('NIM', Auth::user()->NIM)->first()['NIP'];
            Penilaian::create([
                'NIP' => $dosbing,
                'NIM' => Auth::user()->NIM,
                'a1' => $request->a1,
                'a2' => $request->a2,
                'b4' => $request->b4,
                'b5' => $request->b5,
                'b2' => $request->b2,
                'b3' => $request->b3,
                'b1' => $request->b1,
                'status' => 0,
            ]);
            Bimbingan::where('NIM', $nim)->first()->update([
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
            ]);
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
    public function avatar(Request $request)
    {
        // $this->validate($request, [
        //     'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        // ]);

        // $image_path = $request->file('image')->store('image', 'public');

        // User::where('name', Auth::user()->name)->update([
        //     'image' => $image_path,
        // ]);
        $s = "ijln";
        dd($s);

        return redirect('/mahasiswa');
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
