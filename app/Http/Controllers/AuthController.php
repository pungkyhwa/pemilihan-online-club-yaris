<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;
class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index():View
    {
        date_default_timezone_set('Asia/Jakarta');
        $tgl_sekarang = date("Y-m-d");
        $jam_sekarang = date("H:i:s");
        $tgl_buka = '2023-12-24';
        $jam_buka = '09:00:00';
        $tgl_tutup = '2024-01-01';
        $jam_tutup = '23:59:00';
        // dd( $jam_sekarang);

        if ($tgl_sekarang == $tgl_buka) {
            if ($jam_sekarang >= $jam_buka) {
                return view("verifikasi.index");
            }elseif ($jam_sekarang < $jam_buka) {
                return view("verifikasi.close");
            }
            return view("verifikasi.index");

        }elseif ($tgl_sekarang >= $tgl_tutup){
            if ($jam_sekarang >= $jam_tutup) {
                return view("verifikasi.close");
            }else{
                return view("verifikasi.close");
            }
            return view("verifikasi.close");

        }

        return view("verifikasi.index");
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request):RedirectResponse
    {
       

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
 
 /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request):RedirectResponse
    {
        $nim = $request->input('nim');
        $mahasiswa = Mahasiswa::where('nim', $nim)->first();

        // Periksa apakah Mahasiswa dengan nim yang diberikan ditemukan
        if ($mahasiswa) {
            // Set session 'verifikasi' menjadi 'verified'
           
            $status = $mahasiswa->status_memilih;
            if ($status == "Sudah") {
                return redirect()->route('verifikasi.index')
                    ->with('error', 'eitss anda sudah pernah vote, tidak boleh curangg');
            }else{
                Session::put('verifikasi', 'verified');
                Session::put('id_mahasiswa', $nim);
                $mahasiswa->update([
                    'status_memilih' => 'Sedang Memilih'
                ]);
                return redirect()->route('kotak-suara.index')->with('success', 'Verifikasi berhasil.');
            }
            
           
        } else {
            return redirect()->route('verifikasi.index')->with('error', 'NIM tidak valid.');
        }
    }
    public function logout():RedirectResponse
    {
        Session::forget('verifikasi');
        Session::forget('id_mahasiswa');
        return redirect('verifikasi')->with('success', 'Logout berhasil.');
    }
}
