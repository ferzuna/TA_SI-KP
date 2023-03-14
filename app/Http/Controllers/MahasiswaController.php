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
use App\Http\Requests\StoreMahasiswaRequest;
use App\Http\Requests\UpdateMahasiswaRequest;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = User::where('name', Auth::user()->name)->first();
        $bimbingan = Bimbingan::where('NIM', Auth::user()->NIM)->first();
        $pendaftaran = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
        return view('mahasiswa.home', [
            "mhs" => $mhs,
            "jadwal"=> $bimbingan,
            "pendaftaran"=>$pendaftaran,
        ]);
    }

    public function pendaftaran(){
        $alldosen = [];
        $all = User::where('role_id', 4)->get();
        $pendaftaran = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
        $dp = "";

        if(isset($pendaftaran['dosbing'])){
            $all = User::where('role_id', 4)->where('name', '!=', $pendaftaran['dosbing'])->get();
            $dp = $pendaftaran['dosbing'];
        }
        foreach($all as $dosen){
            if($dosen['bobot_bimbingan']%$dosen['kuota_bimbingan'] != 0){
                $alldosen[] = $dosen;
            }
            else if($dosen['bobot_bimbingan'] == 0 && $dosen['kuota_bimbingan'] != 0){
                $alldosen[] = $dosen;
            }
        }
        return view('mahasiswa.pendaftaran',[
            "alldosen"=>$alldosen,
            "pendaftaran"=>$pendaftaran,
            "dp"=>$dp,
        ]);
    }

    public function pendaftaranstore(Request $request){
        $perusahaan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        $ini = Pendaftaran::where('NIM', Auth::user()->NIM)->first();

        if(!isset($perusahaan)){
            return redirect('/mahasiswa/permohonan')->with('mohon ini form pendaftaran terlebih dahulu');
        }
        $this->validate($request, [
            'a1' => 'required|string|max:255',
            'bukti' => 'max:255',
            'dosbing' => 'required|string|max:255',
        ]);
        // pengondisian untuk data yang sudah ada
        if(isset($ini)){
            Pendaftaran::where('NIM', Auth::user()->NIM)->first()->update([
                'a1' => $request->a1,
                'bukti' => $request->bukti,
                'dosbing' => $request->dosbing,
            ]);
        }else{
            Pendaftaran::create([
                'perusahaan' => $perusahaan['perusahaan'],
                'NIM' => Auth::user()->NIM,
                'a1' => $request->a1,
                'bukti' => $request->bukti,
                'dosbing' => $request->dosbing,
            ]);
        }
        
        $semua = User::where('role_id', 4)->get();
        $all = User::all();
        $k = 0;
        
        foreach($all as $bimbingan){
            $k++;
            if($bimbingan['role_id'] == 4){
                $bobot = Pendaftaran::where('dosbing', $bimbingan['name'])->get();
                $jumlah = count($bobot);
                User::find($k)->update([
                    'bobot_bimbingan' => $jumlah,
                ]);
            }
        }

        $bobotbimbingan = 0;
        $kuotabimbingan = 0;
        $i = 0;
        foreach ($semua as $bimbingan){
            if($bimbingan['bobot_bimbingan'] == 0){
                $bobotbimbingan += $bimbingan['bobot_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            }
            else if($bimbingan['bobot_bimbingan'] % $bimbingan['kuota_bimbingan'] == 0){
                $bobotbimbingan += $bimbingan['kuota_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            }else{
                $bobotbimbingan += $bimbingan['bobot_bimbingan'] % $bimbingan['kuota_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            }
        }
        if($bobotbimbingan >= $kuotabimbingan){
            foreach($all as $bimbingan){
                $i++;
                if($bimbingan['role_id'] == 4){
                    User::find($i)->update([
                        'bobot_bimbingan' => 0,
                    ]);
                }
            }
        }

        return redirect('/mahasiswa')->with('success', 'pendaftaran created!');
    }

    public function bimbinganstore(Request $request){
        $this->validate($request, [
            'makalah' => 'max:255',
            'laporan' => 'max:255',
            'a1' => 'max:255',
            'b1' => 'max:255',
            'b2' => 'max:255',
            'b3' => 'max:255',
            'survey' => 'max:255',
            // 'jadwal' => 'date',
        ]);
        $nim = Auth::user()->NIM;
        $data = Bimbingan::where('NIM', $nim)->first();
        if(isset($data)){
            Bimbingan::where('NIM', $nim)->first()->update([
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
                'a1' => $request->a1,
                'b1' => $request->b1,
                'b2' => $request->b2,
                'b3' => $request->b3,
                'survey' => $request->survey,
                'jadwal' => $request->jadwal,
                'status' => 0,
            ]);

            Penjadwalan::where('NIM', $nim)->first()->update([
                'waktu_seminar' => $request->jadwal,
            ]);
        }else{
            $dosbing = Pendaftaran::where('NIM', Auth::user()->NIM)->first()['dosbing'];
            Bimbingan::create([
                'NIP' => User::where('name', $dosbing)->first()['NIP'],
                'NIM' => Auth::user()->NIM,
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
                'a1' => $request->a1,
                'b1' => $request->b1,
                'b2' => $request->b2,
                'b3' => $request->b3,
                'survey' => $request->survey,
                'jadwal' => $request->jadwal,
                'status' => 0,
            ]);
            Penjadwalan::create([
                'NIP' => User::where('name', $dosbing)->first()['NIP'],
                'NIM' => Auth::user()->NIM,
                'waktu_seminar' => $request->jadwal,
            ]);
        }
        return redirect('/mahasiswa/pengumpulan')->with('success', 'pengumpulan berkas created!');
    }

    public function pengumpulan(){
        $data = Bimbingan::where('NIM', Auth::user()->NIM)->first();
        return view('mahasiswa.pengumpulan', [
            'data' => $data,
        ]);
    }

    public function finalisasi(){
        $data = Penilaian::where('NIM', Auth::user()->NIM)->first();
        return view('mahasiswa.finalisasi', [
            'data' => $data,
        ]);
    }

    public function finalisasistore(Request $request){
        $this->validate($request, [
            'makalah' => 'max:255',
            'laporan' => 'max:255',
            'kehadiran' => 'max:255',
            'a2' => 'max:255',
            'b2' => 'max:255',
            'b3' => 'max:255',
        ]);
        $nim = Auth::user()->NIM;
        $data = Penilaian::where('NIM', $nim)->first();
        if(isset($data)){
            Penilaian::where('NIM', $nim)->first()->update([
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
                'kehadiran' => $request->kehadiran,
                'a2' => $request->a2,
                'b2' => $request->b2,
                'b3' => $request->b3,
                'status' => 0,
            ]);
        }else{
            $dosbing = Pendaftaran::where('NIM', Auth::user()->NIM)->first()['dosbing'];
            Penilaian::create([
                'NIP' => User::where('name', $dosbing)->first()['NIP'],
                'NIM' => Auth::user()->NIM,
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
                'kehadiran' => $request->kehadiran,
                'a2' => $request->a2,
                'b2' => $request->b2,
                'b3' => $request->b3,
                'status' => 0,
            ]);
        }
        return redirect('/mahasiswa')->with('success', 'finalisasi berkas created!');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreMahasiswaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMahasiswaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    // public function show(Mahasiswa $mahasiswa)
    // {
        //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    // public function edit(Mahasiswa $mahasiswa)
    // {
        //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMahasiswaRequest  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    // {
        // return view('/home');
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Mahasiswa $mahasiswa)
    // {
        //
    // }
    public function setting(Request $request){
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'NIM' => 'required|digits:14',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|digits_between:1,20',
            'sks' => 'required|digits_between:1,3',
            'alamat' => 'required|string|max:255',
            'angkatan' => 'required|digits:4',
        ]);
        User::find(Auth::user()->id)->update([
            'name' => $request->name,
            'NIM' => $request->NIM,
            'username' => $request->username,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'sks' => $request->sks,
            'angkatan' => $request->angkatan,
            'alamat' => $request->alamat,
            'new_password' => $request->new_password,
        ]);
        return redirect('/mahasiswa')->with('success', 'finalisasi berkas created!');
    }

    // ini buat profil picturenya, blom jadi
    public function avatar(Request $request){
        User::find(Auth::user()->NIM)->update([
            'image' => $request->test,
        ]);
    }
}
