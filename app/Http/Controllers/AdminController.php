<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Penilaian;
use App\Models\Infomagang;
use App\Models\Permohonan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Middleware\Mahasiswa;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\StoreAdminRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\UpdateAdminRequest;

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
        })->get();
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
        $permohonan = Permohonan::all();
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
}
