<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
        return view('mahasiswa.home');
    }


    public function allmhs(){
        $mymahasiswa = Mahasiswa::all();
        return view('dosen.list-mahasiswa', [
            "mymahasiswa" => $mymahasiswa
        ]);
    }

    public function pendaftaranstore(Request $request){
        Pendaftaran::create([
            'perusahaan' => $request->perusahaan,
            'a1' => $request->a1,
            'bukti' => $request->bukti,
            'dosbing' => $request->dosbing,
        ]);

        $value = Dosen::where('nama', $request->dosbing)->first();
        $bobot = Dosen::find($value['id'])['bobot_bimbingan'];

        Dosen::find($value['id'])->update([
            'bobot_bimbingan' => $bobot + 1,
        ]);

        $bobotbimbingan = 0;
        $kuotabimbingan = 0;
        $i = 0;
        $semua = Dosen::all();
        foreach ($semua as $bimbingan){
            $bobotbimbingan = $bobotbimbingan + $bimbingan['bobot_bimbingan'];
            $kuotabimbingan = $kuotabimbingan + $bimbingan['kuota_bimbingan'];
        }
        if($bobotbimbingan >= $kuotabimbingan){
            foreach($semua as $bimbingan){
                $i++;
                Dosen::find($i)->update([
                    'bobot_bimbingan' => 0,
                ]);
            }
        }

        return redirect('/mahasiswa')->with('success', 'pendaftaran created!');
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
