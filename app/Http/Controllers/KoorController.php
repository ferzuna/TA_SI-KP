<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penilaian;
use App\Models\Permohonan;
use App\Http\Middleware\Koor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKoorRequest;
use App\Http\Requests\UpdateKoorRequest;

class KoorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mahasiswa_aktif = User::where('role_id', 1)->count();
        return view('koordinator.home', compact('mahasiswa_aktif'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function permohonan()
    {
        $mymahasiswa = User::rightjoin('permohonans', 'users.NIM', '=', 'permohonans.NIM')->where('permohonans.status', 0)->get();
        $mymahasiswa1 = User::rightjoin('permohonans', 'users.NIM', '=', 'permohonans.NIM')->where('permohonans.status', 1)->get();
        // $mymahasiswa1 = User::rightJoin('Permohonans', function($join) {
        //     $join->on('users.NIM', '=', 'permohonans.NIM');
        // })->where('permohonans.status', 1)->get();
        return view('koordinator.permohonan', [
            'mymahasiswa' => $mymahasiswa,
            'mymahasiswa1' => $mymahasiswa1,
        ]);
    }

    public function approved($id)
    { 
        Permohonan::find($id)->update([
            'status' => 1,
        ]);
        return redirect('/koordinator/permohonan');
    }

    public function penilaian()
    {
        $datasudah = Penilaian::leftjoin('users', 'users.NIM', '=', 'penilaians.NIM')
        ->join('pendaftarans', 'pendaftarans.NIM', '=', 'penilaians.NIM')
        ->join('bimbingans', 'bimbingans.NIM', '=', 'penilaians.NIM')
        ->select('penilaians.id', 'users.name', 'users.NIM', 'perusahaan', 'pendaftarans.a1', 'b1', 'b5', 'penilaians.status as status')
        ->where('penilaians.status', 1)->get();
        $databelum = Penilaian::leftjoin('users', 'users.NIM', '=', 'penilaians.NIM')
        ->join('pendaftarans', 'pendaftarans.NIM', '=', 'penilaians.NIM')
        ->join('bimbingans', 'bimbingans.NIM', '=', 'penilaians.NIM')
        ->select('penilaians.id', 'users.name', 'users.NIM', 'perusahaan', 'pendaftarans.a1', 'bimbingans.b1', 'penilaians.b5', 'penilaians.status as status')
        ->where('penilaians.status', 0)->get();
        // dd($datas);
        return view('koordinator.penilaian', [
            'datasudah' => $datasudah,
            'databelum' => $databelum,
        ]);
    }

    public function penilaianapproved($id){
        Penilaian::find($id)->update([
            'status' => 1,
        ]);
        return redirect('/koordinator/penilaian');
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKoorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKoorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Koor  $koor
     * @return \Illuminate\Http\Response
     */
    // public function show(Koor $koor)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Koor  $koor
     * @return \Illuminate\Http\Response
     */
    // public function edit(Koor $koor)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKoorRequest  $request
     * @param  \App\Models\Koor  $koor
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateKoorRequest $request, Koor $koor)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Koor  $koor
     * @return \Illuminate\Http\Response
     */
    // public function destroy(Koor $koor)
    // {
    //     //
    // }
}
