<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProdiCollection;
use App\Models\Prodi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $prodi = new ProdiCollection(Prodi::paginate());
        return $prodi;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'KodeJurusan' => 'required|unique:prd_jurusan|max:255',
            'NamaJurusan' => 'required',

        ]);

        $prodi = new Prodi;
        $prodi->KodeJurusan = $request->KodeJurusan;
        $prodi->NamaJurusan = $request->NamaJurusan;

        $prodi->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil disimpan.',
            'data' => $prodi,
        ], 200);

        // DB::table('prd_jurusan')->insert(['KodeJurusan' => $request->KodeJurusan, 'NamaJurusan' => $request->NamaJurusan]);  // result "true"

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prodi = DB::table('prd_jurusan')->where('KodeJurusan',$id)->first();
        return response()->json($prodi);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function edit(Prodi $prodi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'KodeJurusan' => 'required|max:2',
            'NamaJurusan' => 'required',
        ]);

        $post = Prodi::where('KodeJurusan', $id)->firstOrFail();
        $post->KodeJurusan = $request->KodeJurusan;
        $post->NamaJurusan = $request->NamaJurusan;

        $post->save();

        return response()->json([
            'post' => $post,
            'message'=>"berhasil diupdate"
        ],
        201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prodi  $prodi
     * @return \Illuminate\Http\Response
     */
    public function destroy($kodeJurusan)
    {
        $post = Prodi::where('KodeJurusan', $kodeJurusan)->delete();

        return response()->json(['prodi' => 'deleted.'], 202);
    }
}
