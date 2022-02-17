<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PeriodeCollection;
use App\Models\Periode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $periode = new PeriodeCollection(Periode::orderBy('tglPeriode','desc')->paginate(10));
        return $periode;

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
            'tglPeriode' => 'required',

        ]);

        $periode = new Periode;
        $periode->tglPeriode = $request->tglPeriode;

        $periode->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Berhasil disimpan.',
            'data' => $periode,
        ], 200);

        // DB::table('prd_periode')->insert(['tglPeriode' => $request->tglPeriode, 'NamaJurusan' => $request->NamaJurusan]);  // result "true"

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $periode = DB::table('prd_periode')->where('tglPeriode',$id)->first();
        return response()->json($periode);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function edit(Periode $periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'tglPeriode' => 'required',
        ]);

        $post = Periode::where('tglPeriode', $id)->firstOrFail();
        $post->tglPeriode = $request->tglPeriode;

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
     * @param  \App\Models\Periode  $periode
     * @return \Illuminate\Http\Response
     */
    public function destroy($tglPeriode)
    {
        $post = Periode::where('tglPeriode', $tglPeriode)->delete();

        return response()->json(['periode' => 'deleted.'], 202);
    }
}
