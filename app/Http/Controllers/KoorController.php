<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penilaian;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use App\Http\Middleware\Koor;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreKoorRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\UpdateKoorRequest;
use Illuminate\Support\Facades\Hash;

class KoorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mymahasiswa = User::rightjoin('permohonans', 'users.NIM', '=', 'permohonans.NIM')->where('permohonans.status', 0)->count();
        $mymahasiswa1 = User::rightjoin('permohonans', 'users.NIM', '=', 'permohonans.NIM')->where('permohonans.status', 1)->count();
        $databelum = Penilaian::leftjoin('users', 'users.NIM', '=', 'penilaians.NIM')
        ->join('pendaftarans', 'pendaftarans.NIM', '=', 'penilaians.NIM')
        ->join('bimbingans', 'bimbingans.NIM', '=', 'penilaians.NIM')
        ->join('permohonans', 'penilaians.NIM', '=', 'permohonans.NIM')
        ->select('penilaians.id', 'users.name', 'users.NIM', 'perusahaan', 'pendaftarans.a1', 'b1', 'b5', 'penilaians.status as status')
        ->where('penilaians.status', 0)->count();
        $mymahasiswaselesai = User::where('role_id', 1)->where('status', 'Selesai KP')->count();

        return view('koordinator.home', [
            "mymahasiswa" => $mymahasiswa,
            "mymahasiswa1" => $mymahasiswa1,
            "databelum" => $databelum,
            "mymahasiswaselesai" => $mymahasiswaselesai,
        ]);
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
        ->join('permohonans', 'penilaians.NIM', '=', 'permohonans.NIM')
        ->select('penilaians.id', 'users.name', 'users.NIM', 'users.semester','perusahaan', 'penilaians.a1', 'penilaians.b1', 'b5', 'penilaians.status as status')
        ->where('penilaians.status', 1)->get();
        $databelum = Penilaian::leftjoin('users', 'users.NIM', '=', 'penilaians.NIM')
        ->join('pendaftarans', 'pendaftarans.NIM', '=', 'penilaians.NIM')
        ->join('permohonans', 'penilaians.NIM', '=', 'permohonans.NIM')
        ->select('penilaians.id', 'users.name', 'users.NIM', 'users.semester', 'permohonans.perusahaan', 'penilaians.a1', 'penilaians.b1', 'penilaians.b5', 'penilaians.status as status')
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

    public function berkasakhir($id) {
        $mhs = User::join('permohonans', 'users.NIM', 'permohonans.NIM')->join('pendaftarans', 'users.NIM', 'pendaftarans.NIM')
        ->join('bimbingans', 'users.NIM', 'bimbingans.NIM')
        ->join('penilaians', 'users.NIM', 'penilaians.NIM')
        ->select('users.id', 'users.name', 'users.semester','users.image', 'users.NIM', 'permohonans.perusahaan', 'pendaftarans.bukti', 'bimbingans.laporan',
         'bimbingans.makalah', 'penilaians.a1', 'penilaians.b1', 'penilaians.b2', 'penilaians.b3', 'penilaians.a2',
          'penilaians.b4', 'penilaians.b5')
        ->where('penilaians.id', $id)->first();
        // dd($mhs);
        return view('koordinator.berkas-akhir', [
            'mhs' => $mhs,
        ]);
    }

    public function setting(Request $request)
    {
        $this->validate($request, [
            'imageUpload' => 'image|file|max:5120',
            'name' => 'required|string|max:50',
            'username' => 'required|string|max:25',
            'email' => 'required|email',
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
        if ($request->file('imageUpload') == null) {
            $file = $request->oldImage;
        } elseif ($request->file('imageUpload')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $file = $request->file('imageUpload')->store('./public/avatar-images/koor');
        }

        if(isset($request->new_password)){
            if (!Hash::check($request->current_password, Auth::user()->password)) {
                return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect']);
            }
            User::find(Auth::user()->id)->update([
                'image' => $file,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
                'password' => Hash::make($request->new_password),
            ]);
        }else{
            User::find(Auth::user()->id)->update([
                'image' => $file,
                'name' => $request->name,
                'username' => $request->username,
                'email' => $request->email,
            ]);
        }
        return redirect('/koordinator')->with('success', 'Profil Berhasil Diperbarui');
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
