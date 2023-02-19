<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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

    public function pendaftaran(){
        $alldosen = [];
        $all = User::where('role_id', 4)->get();
        $pendaftaran = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
        foreach($all as $dosen){
            if($dosen['bobot_bimbingan'] < $dosen['kuota_bimbingan']){
                $alldosen[] = $dosen;
            }
        }
        return view('mahasiswa.pendaftaran',[
            "alldosen"=>$alldosen,
            "pendaftaran"=>$pendaftaran,
        ]);
    }
    public function kuotabimbingan(Request $request, $id){
        User::find($id)->update([
            'kuota_bimbingan' => $request->kuota,
        ]);

        return redirect('/admin/bobot')->with('success', 'Data updated');
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
    public function destroy(Dosen $dosen)
    {
        //
    }
}
