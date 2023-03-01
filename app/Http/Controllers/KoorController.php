<?php

namespace App\Http\Controllers;

use App\Models\Koor;
use App\Models\User;
use App\Models\Penilaian;
use App\Models\Permohonan;
use Illuminate\Routing\Controller;
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
        $mymahasiswa = Permohonan::where('status', 0)->get();
        $mymahasiswa1 = Permohonan::where('status', 1)->get();
        return view('koordinator.permohonan', [
            'mymahasiswa' => $mymahasiswa,
            'mymahasiswa1' => $mymahasiswa1,
        ]);
    }

    public function approved($id)
    {
        $approved = Permohonan::find($id)->update([
            'status' => 1,
        ]);
        return redirect('/koordinator/permohonan');
    }

    public function sudah_dinilai()
    {
        // $sudah_ttd = Penilaian::where('status', 1)->get();
        return view('koordinator.sudah-dinilai');
    }

    public function belum_dinilai()
    {
        // $belum_ttd = Penilaian::where('role_id', 1)->count();
        return view('koordinator.belum-dinilai');
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
    public function show(Koor $koor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Koor  $koor
     * @return \Illuminate\Http\Response
     */
    public function edit(Koor $koor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKoorRequest  $request
     * @param  \App\Models\Koor  $koor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKoorRequest $request, Koor $koor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Koor  $koor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Koor $koor)
    {
        //
    }
}
