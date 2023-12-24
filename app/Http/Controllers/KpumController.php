<?php

namespace App\Http\Controllers;

use App\Models\Capresma;
use App\Models\Mahasiswa;
use App\Models\Pemilihan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Session;

class KpumController extends Controller
{

    public function index()
    {
        if (!Session::has('verifikasi')) {
            return redirect()->route('verifikasi.index')
                ->with('error', 'verifikasi terlebih dahulu');
        } else {
            $capresmas = Capresma::get();
            return view('kotak-suara.index', compact('capresmas'));
        }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        $decryptedId = decrypt($id);

        $capresmaModel = Capresma::find($decryptedId);

        return view('kotak-suara.show', ['capresma' => $capresmaModel]);
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
    public function update(Request $request, $id): RedirectResponse
    {
        try {
            $decryptedId = decrypt($id);
            $nim = Session::get('id_mahasiswa');
            $capresma = Capresma::findOrFail($decryptedId);
            $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();
            $currentVoteCount = $capresma->jumlah_vote;
            $newVoteCount = $currentVoteCount + 1;
            $status = $mahasiswa->status_memilih;
            Session::forget('verifikasi');
            Session::get('id_mahasiswa');
            if ($status == "Sudah") {
                return redirect()->route('verifikasi.index')
                    ->with('error', 'eitss anda sudah pernah vote, tidak boleh curangg');
            } else {
                $capresma->update([
                    'jumlah_vote' => $newVoteCount,
                ]);

                $mahasiswa->update([
                    'status_memilih' => 'Sudah'
                ]);

                $pemilihan = new Pemilihan([
                    'id_capresma' => $decryptedId,
                    'nim' => $nim,
                ]);
                $pemilihan->save();

                return redirect()->route('success-vote.index')
                    ->with('success', 'Vote berhasil ditambahkan.');
            }
        } catch (\Exception $e) {
            return redirect()->route('kotak-suara.index')
                ->with('error', $e->getMessage());
        }
    }
    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
