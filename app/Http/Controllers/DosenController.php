<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Bimbingan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreDosenRequest;
use App\Http\Requests\UpdateDosenRequest;
// use GuzzleHttp\Psr7\Request;

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
        $alldosen = User::where('role_id', 4)->get();
        return view ('admin.bobot',[
            "alldosen"=>$alldosen
        ]);
    }

    
    public function kuotabimbingan(Request $request, $id){
        User::find($id)->update([
            'kuota_bimbingan' => $request->kuota,
        ]);

        return redirect('/admin/bobot')->with('success', 'Data updated');
    }
    

    public function halamanpendaftaran(){
        $mymahasiswa = Pendaftaran::where('dosbing', Auth::user()->name)->get();
        $user = [];
        foreach($mymahasiswa as $mahasiswa){
            $user[] = User::where('NIM', $mahasiswa['NIM'])->first();
        }
        return view('dosen.pendaftaran', [
            'mymahasiswa' => $mymahasiswa,
            'user'=>$user,
        ]);
    }

    public function bimbingan(){
        $bimbingan = Bimbingan::where('NIP', Auth::user()->NIP)->get();
        $user = [];
        foreach($bimbingan as $mahasiswa){
            $user[] = User::where('NIM', $mahasiswa['NIM'])->first();
        }
        return view('dosen.bimbingan', [
            'bimbingan'=>$bimbingan,
            'user' => $user,
        ]);
    }

    public function allmhs(){
        //ini harusnya memunculkan nama mahasiswa yang dibimbing oleh dosen tsb, coba cari dengan left join
        $mymahasiswa = User::where('role_id', 1)->get();
        $pendaftaran = Pendaftaran::where('dosbing', Auth::user()->name)->get();
        return view('dosen.list-mahasiswa', [
            "mymahasiswa" => $mymahasiswa,
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
    public function mahasiswadestroy($id)
    {
        User::find($id)->delete();
        return redirect('/dosen/list-mahasiswa');
    }
}
