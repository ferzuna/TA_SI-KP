<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bimbingan;
use App\Models\Penilaian;
use App\Models\Infomagang;
use App\Models\Permohonan;
use App\Models\Pendaftaran;
use App\Models\Penjadwalan;
use Illuminate\Http\Request;
use App\Http\Middleware\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAdminRequest;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home');
    }
    public function search(Request $request)
    {
        $search = $request->search;
        $mymahasiswa = User::where('name', 'like', "%" . $search . "%")->where('role_id', 1)->paginate();

        return view('admin.list-mahasiswa', [
            'mymahasiswa' => $mymahasiswa
        ]);
    }

    public function allmhs()
    {
        $mymahasiswa = User::where('role_id', 1)->get();
        return view('admin.list-mahasiswa', [
            "mymahasiswa" => $mymahasiswa
        ]);
    }
    public function infomagangdepan()
    {
        $infomagang = Infomagang::all();
        return view('info-magang', [
            'infomagang' => $infomagang,
        ]);
    }

    public function infomagangcreate()
    {
        $infomagang = Infomagang::all();
        return view('admin.info-magang', [
            'infomagang' => $infomagang,
        ]);
    }

    public function addinfomagang(Request $request)
    {
        Infomagang::create([
            'perusahaan' => $request->perusahaan,
            'posisi' => $request->posisi,
            'durasi' => $request->durasi,
            'requirement' => $request->requirement,
        ]);
        return redirect('/admin/info-magang')->with('success', 'pendaftaran created!');
    }

    public function berkas()
    {
        // $data = Penilaian::all();
        $data = Penilaian::leftJoin('users', function ($join) {
            $join->on('penilaians.NIM', '=', 'users.NIM');
        })
        ->select('users.id as id', 'users.name as name', 'users.NIM as NIM', 'users.semester as semester', 'penilaians.status')
        ->get();
        return view('admin.berkas-nilai', [
            'datas' => $data,
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
     * @param  \App\Http\Requests\StoreAdminRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function permohonan()
    {
        $permohonan = Permohonan::join('users', 'permohonans.NIM', '=', 'users.NIM')
        ->select('permohonans.id as id', 'users.name as name', 'users.NIM as NIM', 'perusahaan', 'proposal', 'users.sks as sks', 'permohonans.status as status')
        ->orderBy('permohonans.updated_at', 'desc')->get();
        // $permohonan = Permohonan::leftjoin('users', 'permohonans.NIM', '=', 'users.NIM')->get();
        // $permohonan = Permohonan::all();
        return view('admin.permohonan', [
            'permohonan' => $permohonan,
        ]);
    }
    public function store(StoreAdminRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    // public function show(Admin $admin)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    // public function edit(Admin $admin)
    // {
    //     //
    // }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAdminRequest  $request
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Infomagang::find($id)->update([
            'perusahaan' => $request->perusahaan,
            'posisi' => $request->posisi,
            'durasi' => $request->durasi,
            'requirement' => $request->requirement,
        ]);
        return redirect('/admin/info-magang')->with('success', 'info magang updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Admin  $admin
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Infomagang::find($id)->delete();
        return redirect('/admin/info-magang')->with('success', 'magang deleted');
    }
    public function mhsdestroy($id)
    {
        $mhs = User::find($id);
        User::find($id)->delete();
        Permohonan::where('NIM', $mhs['NIM'])->first()->delete();
        Bimbingan::where('NIM', $mhs['NIM'])->first()->delete();
        Penilaian::where('NIM', $mhs['NIM'])->first()->delete();
        Pendaftaran::where('NIM', $mhs['NIM'])->first()->delete();
        Penjadwalan::where('NIM', $mhs['NIM'])->first()->delete();
        return redirect('/admin/list-mahasiswa')->with('success', 'mahasiswa deleted');
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
            $file = $request->file('imageUpload')->store('avatar-images/mahasiswa');
        }

        User::find(Auth::user()->id)->update([

            'image' => $file,
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'new_password' => $request->new_password,
        ]);
        return redirect('/admin')->with('success', 'Profil Berhasil Diperbarui');
    }

    // public function berkasakhir(){
    //     return view('admin.berkas-akhir');
    // }
    public function berkasakhir($id){
        $mhs = User::join('permohonans', 'users.NIM', 'permohonans.NIM')->join('pendaftarans', 'users.NIM', 'pendaftarans.NIM')
        ->join('penjadwalans', 'users.NIM', 'penjadwalans.NIM')->join('bimbingans', 'users.NIM', 'bimbingans.NIM')
        ->join('penilaians', 'users.NIM', 'penilaians.NIM')
        ->select('users.id', 'users.name', 'users.NIM', 'permohonans.perusahaan', 'pendaftarans.bukti', 'bimbingans.laporan',
         'bimbingans.makalah', 'pendaftarans.a1', 'bimbingans.b1', 'bimbingans.b2', 'bimbingans.b3', 'penilaians.a2',
          'penilaians.b4', 'penilaians.b5')
        ->where('users.id', $id)->first();
        // dd($mhs);
        return view('admin.berkas-akhir', [
            'mhs' => $mhs,
        ]);
    }

    public function editpermohonan(Request $request, $id){
        Permohonan::find($id)->update([
            'perusahaan' => $request->perusahaan,
            'proposal' => $request->proposal,         
        ]);
        return redirect('/admin/permohonan');
    }

    public function editmahasiswa(Request $request, $id){
        User::find($id)->update([
            'NIM' => $request->NIM,
            'name' => $request->name,
            'semester' => $request->semester,
            'no_telp' => $request->no_telp,
            'sks' => $request->sks,
        ]);
        return redirect('/admin/list-mahasiswa');
    }

    public function deletepermohonan($id){
        Permohonan::find($id)->delete();
        return redirect('/admin/permohonan');
    }
}
