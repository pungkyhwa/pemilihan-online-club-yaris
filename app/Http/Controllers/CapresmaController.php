<?php

namespace App\Http\Controllers;

use App\Models\Capresma;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CapresmaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        $capresmas = Capresma::first()->paginate(5);
        return view('capresma.index', compact('capresmas'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(): View
    {
        
        return view('capresma.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'ketua' => 'required',
            'wakil' => 'required',
            'visi' => 'required',
            'misi' => 'required',
            'fakultas' => 'required',
            'photoUrl' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imageName = time() . '.' . $request->file('photoUrl')->extension();
        $request->photoUrl->storeAs('public/capresma', $imageName);
        $capresma = new Capresma([
            'nm_capresma' => $request->input('ketua'),
            'wakil' => $request->input('wakil'),
            'visi' => $request->input('visi'),
            'misi' => $request->input('misi'),
            'fakultas' => $request->input('fakultas'),
            'foto_url' => $imageName,
            'jumlah_vote' => 0
        ]);

        $capresma->save();
        return redirect()->route('capresma.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id): View
    {
        // Decrypt the encrypted ID
        $decryptedId = decrypt($id);

        // Gunakan $decryptedId sesuai kebutuhan Anda

        // Contoh: Mendapatkan data dari model
        $capresmaModel = Capresma::find($decryptedId);

        // Contoh: Mengirim data ke view
        return view('capresma.show', ['capresma' => $capresmaModel]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
    //     try {
    //         $decryptedId = decrypt($id);
    //         $capresma = Capresma::findOrFail($decryptedId);

    //         $currentVoteCount = $capresma->jumlah_vote;

    //         $newVoteCount = $currentVoteCount + 1;

    //         $capresma->update([
    //             'jumlah_vote' => $newVoteCount,
    //         ]);

    //         return redirect()->route('success-vote.index')
    //             ->with('success', 'Vote berhasil ditambahkan.');

    //     } catch (\Exception $e) {
    //         return redirect()->route('kotak-suara.index')
    //             ->with('error', 'Gagal menambahkan vote.');
    //     }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id): RedirectResponse
    {
        $decryptedId = decrypt($id);
        $capresma = Capresma::findOrFail($decryptedId);
        $jumlahVote = $capresma->jumlah_vote;
        if ($jumlahVote > 0) {
            return redirect()->route('capresma.index')
            ->with('error', 'gagal menghapus, karena sudah ada vote yg masuk');
        }else{
            $capresma->delete();

        return redirect()->route('capresma.index')
            ->with('success', 'capresma Berhasil Di Hapus');
        }
       
    }
}
