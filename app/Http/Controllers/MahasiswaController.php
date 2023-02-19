<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Bimbingan;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        return view('mahasiswa.home', [
            "mhs" => $mhs
        ]);
    }


    public function allmhs(){
        $mymahasiswa = User::where('role_id', 1)->get();
        return view('dosen.list-mahasiswa', [
            "mymahasiswa" => $mymahasiswa,
        ]);
    }

    public function pendaftaranstore(Request $request){
        Pendaftaran::create([
            'perusahaan' => $request->perusahaan,
            'NIM' => Auth::user()->NIM,
            'a1' => $request->a1,
            'bukti' => $request->bukti,
            'dosbing' => $request->dosbing,
        ]);

        $value = User::where('name', $request->dosbing)->first();
        $bobot = User::find($value['id'])['bobot_bimbingan'];

        User::find($value['id'])->update([
            'bobot_bimbingan' => $bobot + 1,
        ]);

        $bobotbimbingan = 0;
        $kuotabimbingan = 0;
        $i = 0;
        $semua = User::where('role_id', 4)->get();
        $all = User::all();
        foreach ($semua as $bimbingan){
            $bobotbimbingan = $bobotbimbingan + $bimbingan['bobot_bimbingan'];
            $kuotabimbingan = $kuotabimbingan + $bimbingan['kuota_bimbingan'];
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
                'status' => $request->b3,
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
                'status' => $request->b3,
            ]);
        }
        return redirect('/mahasiswa')->with('success', 'pengumpulan berkas created!');
    }

    public function pengumpulan(){
        $nim = Auth::user()->NIM;
        $data = Bimbingan::where('NIM', $nim)->first();
        if(!isset($data)){
            $data = [
                'makalah' => '',
                'laporan' => '',
                'a1' => '',
                'b1' => '',
                'b2' => '',
                'b3' => '',
                'status' => '',
            ];
        }
        return view('mahasiswa.pengumpulan', [
            'data' => $data,
        ]);
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
    public function show(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function edit(Mahasiswa $mahasiswa)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMahasiswaRequest  $request
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMahasiswaRequest $request, Mahasiswa $mahasiswa)
    {
        return view('/home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mahasiswa  $mahasiswa
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        //
    }
    public function test(){
        return view('/home');
    }
}
