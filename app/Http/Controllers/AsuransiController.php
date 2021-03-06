<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Asuransi;

class AsuransiController extends Controller
{
    private function getAsuransi($id = null)
    {
        if (isset($id)) {
            return Asuransi::with('pasien')->findOrFail($id);
        } else {
            return Asuransi::with('pasien')->get();
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            'allAsuransi' => $this->getAsuransi()
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payload = $request->input('asuransi');
        
        $exist_asuransi = Asuransi::where('id_pasien', '=', $payload['id_pasien'])
                                    ->where('nama_asuransi', '=', $payload['nama_asuransi'])
                                    ->first();
                                    
        if ($exist_asuransi) {
            if ($exist_asuransi->no_kartu != $payload['no_kartu']) {
                $exist_asuransi->no_kartu = $payload['no_kartu'];
                $exist_asuransi->save();
            }
            return response()->json([
                'asuransi' => $exist_asuransi
            ], 201); 
        }

        $asuransi = new Asuransi;
        $asuransi->id_pasien = $payload['id_pasien'];
        $asuransi->no_kartu = $payload['no_kartu'];
        $asuransi->nama_asuransi = $payload['nama_asuransi'];
        $asuransi->save();

        return response()->json([
            'asuransi' => $asuransi
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json([
            'asuransi' => $this->getAsuransi($id)
        ]);
    }

    public function getAsuransiByIdPasien($id_pasien)
    {
        return Asuransi::where('id_pasien', '=', $id_pasien)
          ->get();
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
        $payload = $request->input('asuransi');
        $asuransi = Asuransi::findOrFail($id);
        $asuransi->no_kartu = $payload['no_kartu'];
        $asuransi->save();
        
        return response()->json([
            'asuransi' => $asuransi
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Asuransi::destroy($id);
    }
}
