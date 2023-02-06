<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
use App\Models\Pendaftaran;
use GuzzleHttp\Psr7\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dosen.home');
    }

    public function bobotdosen(){
        $alldosen = Dosen::all();
        return view ('admin.bobot',[
            "alldosen"=>$alldosen
        ]);
    }

    public function pendaftaran(){
        $alldosen = [];
        $all = Dosen::all();
        foreach($all as $dosen){
            if($dosen['bobot_bimbingan'] < $dosen['kuota_bimbingan']){
                $alldosen[] = $dosen;
            }
        }
        return view('mahasiswa.pendaftaran',[
            "alldosen"=>$alldosen
        ]);
    }

    // public function pendaftaranpart2(){
    //     $semuadosen = Dosen::all();
    //     foreach ($semuadosen as $dosen){

    //     }
    // }

// function yang belom jadi
    // public function bimbingan(){
    //     $bobot = Dosen::all();
    //     $totalkuota = 0;
    //     $totalbobot = 0;
    //     foreach ($bobot as $bimbingan){
    //         $totalkuota = $totalkuota + $bimbingan['kuota_bimbingan'];
    //         $totalbobot = $totalbobot + $bimbingan['bobot_bimbingan'];
    //     }

    //     return $totalkuota;
    // }
    

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
     * @param  \App\Http\Requests\StoreDosenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDosenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function show(Dosen $dosen)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function edit(Dosen $dosen)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDosenRequest  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDosenRequest $request, Dosen $dosen)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dosen $dosen)
    {
        //
    }
}
