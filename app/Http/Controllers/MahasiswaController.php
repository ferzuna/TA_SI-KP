<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Bimbingan;
use App\Models\Penilaian;
use App\Models\Permohonan;
use App\Models\Pendaftaran;
use App\Models\Penjadwalan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $mhs = User::where('email', Auth::user()->email)->first();
        $bimbingan = Bimbingan::where('NIM', Auth::user()->NIM)->first();
        $permohonan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        // $permohonan->updated_at = Carbon::parse('2021-03-16 08:27:00')->locale('id');
        // $permohonan->updated_at->settings(['formatFunction' => 'translatedFormat']);
        $pendaftaran = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
        return view('mahasiswa.home', [
            "mhs" => $mhs,
            "jadwal" => $bimbingan,
            "pendaftaran" => $pendaftaran,
            "permohonan" => $permohonan,
        ]);
        
    }

    public function pendaftaran()
    {
        $all = User::where('role_id', 4)->where('status', 1)->get();
        $pendaftaran = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
        $alldosen = [];
        $dp = "";
        $perusahaan = Permohonan::where('NIM', Auth::user()->NIM)->first();

        // untuk memastikan apakah user sudah melakukan proses permohonan kerja praktik
        if (!isset($perusahaan)) {
            return redirect('/mahasiswa/permohonan')->with('mohon ini form pendaftaran terlebih dahulu');
        }

        if (isset($pendaftaran['dosbing'])) {
            $all = User::where('role_id', 4)->where('name', '!=', $pendaftaran['dosbing'])->where('status', 1)->get();
            $dp = $pendaftaran['dosbing'];
        }
        foreach ($all as $dosen) {
            if($dosen['kuota_bimbingan'] != 0){
                if ($dosen['bobot_bimbingan'] % $dosen['kuota_bimbingan'] != 0) {
                    $alldosen[] = $dosen;
                } else if ($dosen['bobot_bimbingan'] == 0 && $dosen['kuota_bimbingan'] != 0) {
                    $alldosen[] = $dosen;
                }
            }
        }
        return view('mahasiswa.pendaftaran', [
            "alldosen" => $alldosen,
            "pendaftaran" => $pendaftaran,
            "dp" => $dp,
        ]);
    }

    public function pendaftaranstore(Request $request)
    {
        $perusahaan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        $ini = Pendaftaran::where('NIM', Auth::user()->NIM)->first();

        if (!isset($perusahaan)) {
            return redirect('/mahasiswa/permohonan')->with('mohon ini form pendaftaran terlebih dahulu');
        }
        $this->validate($request, [
            'a1' => 'required|string|max:255',
            'bukti' => 'max:255',
            'dosbing' => 'required|string|max:255',
        ]);
        // pengondisian untuk data yang sudah ada
        if (isset($ini)) {
            Pendaftaran::where('NIM', Auth::user()->NIM)->first()->update([
                'a1' => $request->a1,
                'bukti' => $request->bukti,
                'dosbing' => $request->dosbing,
            ]);
        } else {
            Pendaftaran::create([
                'NIM' => Auth::user()->NIM,
                'a1' => $request->a1,
                'bukti' => $request->bukti,
                'dosbing' => $request->dosbing,
            ]);
            $status1 = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
            $status2 = Bimbingan::where('NIM', Auth::user()->NIM)->first();
            $status3 = Penilaian::where('NIM', Auth::user()->NIM)->first();
            if(isset($status3)){
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Selesai KP'
                ]);
            }else if(isset($status2)){
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Bimbingan KP'
                ]);
            }else if(isset($status1)){
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Pendaftaran KP'
                ]);
            }else{
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Permohonan KP'
                ]);
            }
        }

        $semua = User::where('role_id', 4)->get();
        $all = User::all();
        $k = 0;

        foreach ($all as $bimbingan) {
            $k++;
            if ($bimbingan['role_id'] == 4) {
                $bobot = Pendaftaran::where('dosbing', $bimbingan['name'])->get();
                $jumlah = count($bobot);
                User::find($k)->update([
                    'bobot_bimbingan' => $jumlah,
                ]);
            }
        }

        $bobotbimbingan = 0;
        $kuotabimbingan = 0;
        $i = 0;
        foreach ($semua as $bimbingan) {
            if ($bimbingan['bobot_bimbingan'] == 0) {
                $bobotbimbingan += $bimbingan['bobot_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            } else if ($bimbingan['bobot_bimbingan'] % $bimbingan['kuota_bimbingan'] == 0) {
                $bobotbimbingan += $bimbingan['kuota_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            } else {
                $bobotbimbingan += $bimbingan['bobot_bimbingan'] % $bimbingan['kuota_bimbingan'];
                $kuotabimbingan += $bimbingan['kuota_bimbingan'];
            }
        }
        if ($bobotbimbingan >= $kuotabimbingan) {
            foreach ($all as $bimbingan) {
                $i++;
                if ($bimbingan['role_id'] == 4) {
                    User::find($i)->update([
                        'bobot_bimbingan' => 0,
                    ]);
                }
            }
        }

        return redirect('/mahasiswa')->with('success', 'pendaftaran created!');
    }

    public function exportPdf()
    {
        $identity = Auth::user();
        $permohonan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        $to_date = Carbon::parse($permohonan->selesai);
        $from_date = Carbon::parse($permohonan->mulai);
        $months = $to_date->diffInMonths($from_date);
        return view('mahasiswa.pdf.export-permohonan',[
            'data' => $identity,
            'permohonan' => $permohonan,
            'selisih' => $months,
        ]);
        // $pdf = Pdf::loadView('mahasiswa.pdf.export-permohonan');
        // return $pdf->download('permohonanKP-' . Auth::user()->name . '.pdf');
    }

    public function permohonanFakultas()
    {
        $identity = Auth::user();
        $permohonan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        $to_date = Carbon::parse($permohonan->selesai);
        $from_date = Carbon::parse($permohonan->mulai);
        $months = $to_date->diffInMonths($from_date);
        return view('mahasiswa.pdf.permohonan-fakultas',[
            'data' => $identity,
            'permohonan' => $permohonan,
            'selisih' => $months,
        ]);
        // $pdf = Pdf::loadView('mahasiswa.pdf.export-permohonan');
        // return $pdf->download('permohonanKP-' . Auth::user()->name . '.pdf');
    }

    public function bimbinganstore(Request $request)
    {
        $this->validate($request, [
            'makalah' => 'max:255',
            'laporan' => 'max:255',
            'a1' => 'max:255',
            'b1' => 'max:255',
            'b2' => 'max:255',
            'b3' => 'max:255',
            'survey' => 'max:255',
            'ruangan' => 'max:255'
        ]);
        $nim = Auth::user()->NIM;
        $data = Bimbingan::where('NIM', $nim)->first();
        if (isset($data)) {
            Bimbingan::where('NIM', $nim)->first()->update([
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
                'b1' => $request->b1,
                'b2' => $request->b2,
                'b3' => $request->b3,
                'survey' => $request->survey,
            ]);

            Penjadwalan::where('NIM', $nim)->first()->update([
                'jadwal' => $request->jadwal,
                'ruangan' => $request->ruangan
            ]);

            Pendaftaran::where('NIM', $nim)->first()->update([
                'a1' => $request->a1,
            ]);
        } else {
            $dosbing = Pendaftaran::where('NIM', Auth::user()->NIM)->first()['dosbing'];
            Bimbingan::create([
                'NIP' => User::where('name', $dosbing)->first()['NIP'],
                'NIM' => Auth::user()->NIM,
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
                'b1' => $request->b1,
                'b2' => $request->b2,
                'b3' => $request->b3,
                'survey' => $request->survey,
                'status' => '',
            ]);
            Penjadwalan::create([
                'NIP' => User::where('name', $dosbing)->first()['NIP'],
                'NIM' => Auth::user()->NIM,
                'jadwal' => $request->jadwal,
                'ruangan' => $request->ruangan,
            ]);
            Pendaftaran::where('NIM', $nim)->first()->update([
                'a1' => $request->a1,
            ]);

            $status1 = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
            $status2 = Bimbingan::where('NIM', Auth::user()->NIM)->first();
            $status3 = Penilaian::where('NIM', Auth::user()->NIM)->first();
            if(isset($status3)){
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Selesai KP'
                ]);
            }else if(isset($status2)){
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Bimbingan KP'
                ]);
            }else if(isset($status1)){
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Pendaftaran KP'
                ]);
            }else{
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Permohonan KP'
                ]);
            }
        }
        return redirect('/mahasiswa')->with('success', 'pengumpulan berkas created!');
    }

    public function pengumpulan()
    {
        // untuk memastikan apakah user sudah melakukan proses permohonan kerja praktik
        $perusahaan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        if (!isset($perusahaan)) {
            return redirect('/mahasiswa/permohonan')->with('mohon ini form pendaftaran terlebih dahulu');
        }
        $data = Bimbingan::join('penjadwalans', 'bimbingans.NIM', '=', 'penjadwalans.NIM')->join('pendaftarans', 'bimbingans.NIM', '=', 'pendaftarans.NIM')
        ->select('bimbingans.id', 'penjadwalans.ruangan as ruangan', 'bimbingans.NIM', 'penjadwalans.jadwal', 'pendaftarans.a1 as a1', 'b1', 'b2', 'b3', 'bimbingans.survey', 'laporan', 'makalah')
        ->where('bimbingans.NIM', Auth::user()->NIM)->first();
        return view('mahasiswa.pengumpulan', [
            'data' => $data,
        ]);
    }

    public function finalisasi()
    {
        // untuk memastikan apakah user sudah melakukan proses permohonan kerja praktik
        $perusahaan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        if (!isset($perusahaan)) {
            return redirect('/mahasiswa/permohonan')->with('mohon ini form pendaftaran terlebih dahulu');
        }
        $data = Bimbingan::leftJoin('penilaians', 'bimbingans.NIM', '=', 'penilaians.NIM')
        ->where('bimbingans.NIM', Auth::user()->NIM)
        ->select('penilaians.id', 'bimbingans.laporan', 'bimbingans.makalah', 'kehadiran', 'penilaians.a2', 'bimbingans.b2', 'bimbingans.b3', 'penilaians.b4', 'penilaians.b5')->first();
        return view('mahasiswa.finalisasi', [
            'data' => $data,
        ]);
    }

    public function finalisasistore(Request $request)
    {
        $this->validate($request, [
            'makalah' => 'max:255',
            'laporan' => 'max:255',
            'kehadiran' => 'max:255',
            'a2' => 'max:255',
            'b2' => 'max:255',
            'b3' => 'max:255',
            'b4' => 'max:255',
            'b5' => 'max:255',
        ]);
        $nim = Auth::user()->NIM;
        $data = Penilaian::where('NIM', $nim)->first();
        if (isset($data)) {
            Penilaian::where('NIM', $nim)->first()->update([
                'kehadiran' => $request->kehadiran,
                'a2' => $request->a2,
                'b4' => $request->b4,
                'b5' => $request->b5,
                'status' => 0,
            ]);
            Bimbingan::where('NIM', $nim)->first()->update([
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
                'b2' => $request->b2,
                'b3' => $request->b3,
            ]);
        } else {
            $dosbing = Pendaftaran::where('NIM', Auth::user()->NIM)->first()['dosbing'];
            Penilaian::create([
                'NIP' => User::where('name', $dosbing)->first()['NIP'],
                'NIM' => Auth::user()->NIM,
                'kehadiran' => $request->kehadiran,
                'a2' => $request->a2,
                'b4' => $request->b4,
                'b5' => $request->b5,
                'status' => 0,
            ]);
            Bimbingan::where('NIM', $nim)->first()->update([
                'makalah' => $request->makalah,
                'laporan' => $request->laporan,
                'b2' => $request->b2,
                'b3' => $request->b3,
            ]);
            // apakah bimbingan perlu dibuaat juga??

            $status1 = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
            $status2 = Bimbingan::where('NIM', Auth::user()->NIM)->first();
            $status3 = Penilaian::where('NIM', Auth::user()->NIM)->first();
            if(isset($status3)){
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Selesai KP'
                ]);
            }else if(isset($status2)){
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Bimbingan KP'
                ]);
            }else if(isset($status1)){
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Pendaftaran KP'
                ]);
            }else{
                User::where('NIM', Auth::user()->NIM)->first()->update([
                    'status' => 'Permohonan KP'
                ]);
            }
        }
        return redirect('/mahasiswa')->with('success', 'finalisasi berkas created!');
    }

    public function setting(Request $request)
    {
        $this->validate($request, [
            'imageUpload' => 'image|file|max:5120',
            'name' => 'required|string|max:255',
            'NIM' => 'required|digits:14',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'no_telp' => 'required|digits_between:1,20',
            'sks' => 'required|digits_between:1,3',
            'alamat' => 'required|string|max:255',
            'semester' => 'required|digits_between:1,2',
        ]);
        $pendaftaran = Pendaftaran::where('NIM', Auth::user()->NIM)->first();
        $permohonan = Permohonan::where('NIM', Auth::user()->NIM)->first();
        $bimbingan = Bimbingan::where('NIM', Auth::user()->NIM)->first();
        $penilaian = Penilaian::where('NIM', Auth::user()->NIM)->first();
        $penjadwalan = Penjadwalan::where('NIM', Auth::user()->NIM)->first();
        if (isset($pendaftaran)) {
            $pendaftaran->update([
                'NIM' => $request->NIM,
            ]);
        }
        if (isset($permohonan)) {
            $permohonan->update([
                'name' => $request->name,
                'NIM' => $request->NIM,
            ]);
        }
        if (isset($bimbingan)) {
            $bimbingan->update([
                'NIM' => $request->NIM,
            ]);
        }
        if (isset($penilaian)) {
            $penilaian->update([
                'NIM' => $request->NIM,
            ]);
        }
        if (isset($penjadwalan)) {
            $penjadwalan->update([
                'NIM' => $request->NIM,
            ]);
        }


        if ($request->file('imageUpload') == null) {
            $file = $request->oldImage;
        } elseif ($request->file('imageUpload')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $file = $request->file('imageUpload')->store('./public/avatar-images/mahasiswa');
        }



        User::find(Auth::user()->id)->update([

            'image' => $file,
            'name' => $request->name,
            'NIM' => $request->NIM,
            'username' => $request->username,
            'email' => $request->email,
            'no_telp' => $request->no_telp,
            'sks' => $request->sks,
            'semester' => $request->semester,
            'alamat' => $request->alamat,
            'new_password' => $request->new_password,
        ]);
        return redirect('/mahasiswa')->with('success', 'finalisasi berkas created!');
    }

    // ini buat profil picturenya, blom jadi
    public function avatar(Request $request)
    {
        // $this->validate($request, [
        //     'image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        // ]);

        // $image_path = $request->file('image')->store('image', 'public');

        // User::where('name', Auth::user()->name)->update([
        //     'image' => $image_path,
        // ]);
        $s = "ijln";
        dd($s);

        return redirect('/mahasiswa');
    }
}
