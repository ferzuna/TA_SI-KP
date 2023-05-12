<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bimbingan;
use App\Models\Permohonan;
use App\Models\Pendaftaran;
use Illuminate\Http\Request;
use App\Http\Middleware\Dosen;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
            'status' => $request->status,
        ]);

        return redirect('/admin/bobot')->with('success', 'Data updated');
    }
    

    public function halamanpendaftaran(){
        $mymahasiswa = User::leftJoin('pendaftarans', function($join) {
            $join->on('users.NIM', '=', 'pendaftarans.NIM');
        })->join('permohonans', 'users.NIM', '=', 'permohonans.NIM')
        ->select('pendaftarans.id', 'users.name', 'users.semester', 'permohonans.perusahaan', 'pendaftarans.a1', 'pendaftarans.bukti')
        ->where('pendaftarans.NIP', Auth::user()->NIP)->get();
        return view('dosen.pendaftaran', [
            'mymahasiswa' => $mymahasiswa,
        ]);
    }

    public function bimbingan(){
        $bimbingan = Bimbingan::leftJoin('users', function($join) {
            $join->on('bimbingans.NIM', '=', 'users.NIM');
        })->join('permohonans', 'users.NIM', 'permohonans.NIM')
        ->join('pendaftarans', 'bimbingans.NIM', '=', 'pendaftarans.NIM')
        ->join('penjadwalans', 'bimbingans.NIM', '=', 'penjadwalans.NIM')
        ->select('bimbingans.id', 'users.name as name', 'bimbingans.NIM as NIM', 'bimbingans.status as status', 'permohonans.perusahaan as perusahaan', 'sks', 'survey', 'jadwal',
        'b1', 'b2', 'b3', 'proposal', 'pendaftarans.NIP', 'bimbingans.laporan')->where('bimbingans.status', null)->where('pendaftarans.NIP', Auth::user()->NIP)->get();
        $bimbingan1 = Bimbingan::leftJoin('users', function($join) {
            $join->on('bimbingans.NIM', '=', 'users.NIM');
        })->join('permohonans', 'users.NIM', 'permohonans.NIM')
        ->join('pendaftarans', 'bimbingans.NIM', '=', 'pendaftarans.NIM')
        ->join('penjadwalans', 'bimbingans.NIM', '=', 'penjadwalans.NIM')
        ->select('bimbingans.id', 'users.name as name', 'bimbingans.NIM as NIM', 'bimbingans.status as status', 'permohonans.perusahaan as perusahaan', 'sks', 'survey', 'jadwal',
        'b1', 'b2', 'b3', 'proposal', 'pendaftarans.NIP', 'bimbingans.laporan')->where('bimbingans.status', 'revisi')->where('pendaftarans.NIP', Auth::user()->NIP)->get();
        $bimbingan3 = Bimbingan::leftJoin('users', function($join) {
            $join->on('bimbingans.NIM', '=', 'users.NIM');
        })->join('permohonans', 'users.NIM', 'permohonans.NIM')
        ->join('pendaftarans', 'bimbingans.NIM', '=', 'pendaftarans.NIM')
        ->join('penjadwalans', 'bimbingans.NIM', '=', 'penjadwalans.NIM')
        ->select('bimbingans.id', 'users.name as name', 'bimbingans.NIM as NIM', 'bimbingans.status as status', 'permohonans.perusahaan as perusahaan', 'sks', 'survey', 'jadwal',
        'b1', 'b2', 'b3', 'proposal', 'pendaftarans.NIP', 'bimbingans.laporan')->where('bimbingans.status', 'sudah direvisi')->where('pendaftarans.NIP', Auth::user()->NIP)->get();
        $bimbingan2 = Bimbingan::leftJoin('users', function($join) {
            $join->on('bimbingans.NIM', '=', 'users.NIM');
        })->join('permohonans', 'users.NIM', 'permohonans.NIM')
        ->join('pendaftarans', 'bimbingans.NIM', '=', 'pendaftarans.NIM')
        ->join('penjadwalans', 'bimbingans.NIM', '=', 'penjadwalans.NIM')
        ->select('bimbingans.id', 'users.name as name', 'bimbingans.NIM as NIM', 'bimbingans.status as status', 'permohonans.perusahaan as perusahaan', 'sks', 'survey', 'jadwal',
        'b1', 'b2', 'b3', 'proposal', 'pendaftarans.NIP', 'bimbingans.laporan')
        ->where('bimbingans.status', 'acc')->where('pendaftarans.NIP', Auth::user()->NIP)->get();
        // dd($bimbingan);
        return view('dosen.bimbingan', [
            'bimbingan'=>$bimbingan,
            'bimbingan1'=>$bimbingan1,
            'bimbingan2'=>$bimbingan2,
            'bimbingan3'=>$bimbingan3,
        ]);
    }

    public function setujuilaporan($id){
        Bimbingan::find($id)->update([
            'status' => 'acc',
        ]);
        return redirect('/dosen/bimbingan');
    }

    public function allmhs(){
        $mymahasiswa = Pendaftaran::leftJoin('users', function($join) {
            $join->on('pendaftarans.NIM', '=', 'users.NIM');
        })->join('permohonans', 'pendaftarans.NIM', '=', 'permohonans.NIM')
        ->select('users.NIM', 'users.name', 'semester', 'no_telp', 'permohonans.perusahaan', 'users.status as status', 'users.id as id')
        ->where('pendaftarans.NIP', Auth::user()->NIP)
        ->get();
        return view('dosen.list-mahasiswa', [
            "mymahasiswa" => $mymahasiswa,
        ]);
    }

    public function jadwalseminar(){
        $seminar = Pendaftaran::leftJoin('users', function($join) {
            $join->on('pendaftarans.NIM', '=', 'users.NIM');
        })->leftJoin('penjadwalans', 'pendaftarans.NIM', '=', 'penjadwalans.NIM')
        ->join('permohonans', 'pendaftarans.NIM', '=', 'permohonans.NIM')
        ->join('penilaians', 'pendaftarans.NIM', '=', 'penilaians.NIM')
        ->where('pendaftarans.NIP', Auth::user()->NIP)->get();
        return view('dosen.jadwal', [
            'seminar' => $seminar,
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
    // public function show(Dosen $dosen)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    // public function edit(Dosen $dosen)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDosenRequest  $request
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    // public function update(UpdateDosenRequest $request, Dosen $dosen)
    // {
    //     //
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dosen  $dosen
     * @return \Illuminate\Http\Response
     */
    public function mahasiswadestroy($id)
    {   
        $user = User::find($id); 
        Permohonan::where('NIM', $user['NIM'])->first()->delete();
        Pendaftaran::where('NIM', $user['NIM'])->first()->delete();
        
        return redirect('/dosen/list-mahasiswa');
    }

    public function search(Request $request)
    {
        $search = $request->search;
        // $mymahasiswa = User::where('name', 'like', "%".$search."%")->where('role_id', 1)->paginate();
        $mymahasiswa = User::leftJoin('pendaftarans', function($join){
            $join->on('users.NIM', '=', 'pendaftarans.NIM');  
        })->where('name', 'like', "%".$search."%")->where('role_id', 1)->where('pendaftarans.NIP', Auth::user()->NIP)->paginate();
        return view('dosen.list-mahasiswa', [
            'mymahasiswa' => $mymahasiswa
        ]);
    }

    public function setting(Request $request)
    {
        $this->validate($request, [
            'imageUpload' => 'image|file|max:5120',
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
        ]);

        if ($request->file('imageUpload') == null) {
            $file = $request->oldImage;
        } elseif ($request->file('imageUpload')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $file = $request->file('imageUpload')->store('./public/avatar-images/dosen');
        }

        User::find(Auth::user()->id)->update([

            'image' => $file,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'new_password' => $request->new_password,
        ]);
        return redirect('/dosen')->with('success', 'Profil Berhasil Diperbarui');
    }

    public function editbimbingan(Request $request, $id){
        Bimbingan::find($id)->update([
            'status' => $request->status,
        ]);
        return redirect('/dosen/bimbingan');
    }
}
