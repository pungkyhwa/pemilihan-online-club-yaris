<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Capresma;
use App\Models\Fakultas;
use App\Models\Mahasiswa;
use App\Models\Prodi;
use Illuminate\Http\Request;

class Analytics extends Controller
{
  public function index()
  {
    
    $capresmas = Capresma::get();
    $resultAll = mahasiswa::join('prodi', 'mahasiswa.prodi', '=', 'prodi.id')
        ->where('mahasiswa.status_memilih', '=', 'Sudah')
        ->count();
    $resultDone = array();
    for ($i = 1; $i < 2; $i++) {
      $jumlah = mahasiswa::join('prodi', 'mahasiswa.prodi', '=', 'prodi.id')
        ->where('mahasiswa.status_memilih', '=', 'Sudah')
        ->join('fakultas','prodi.fakultas','=','fakultas.id')
        ->where('fakultas.id', '=', $i)
        ->count();
        $fakultas = Fakultas::find($i);
        // dd($fakultas->nm_fakultas);
      array_push($resultDone, ['nilai' => $jumlah,'nama_prodi'=>$fakultas->nm_fakultas]);
    }

    $resultBlm = array();
    for ($i = 1; $i < 2; $i++) {
      $jumlah = mahasiswa::join('prodi', 'mahasiswa.prodi', '=', 'prodi.id')
      ->where('mahasiswa.status_memilih', '=', 'Belum')
      ->join('fakultas','prodi.fakultas','=','fakultas.id')
      ->where('fakultas.id', '=', $i)
      ->count();
      $fakultas = Fakultas::find($i);
    array_push($resultBlm, ['nilai' => $jumlah,'nama_prodi'=>$fakultas->nm_fakultas]);
    }
    
    $totalMhs = Mahasiswa::count();

    return view('content.dashboard.dashboard', compact('capresmas', 'totalMhs', 'resultBlm','resultDone','resultAll'));
  }
}
