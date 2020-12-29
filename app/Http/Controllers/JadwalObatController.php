<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JadwalObat;

class JadwalObatController extends Controller
{
    public function index()
    {
        $jadwalobats = JadwalObat::all();

        $response = [
            'message' => 'List of all jadwalobats',
            'jadwalobats' => $jadwalobats
        ];

        return response()->json($response, 200);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'tanggalambil' => 'required',
            'tanggalkembali' => 'required',
            'keluhan' => 'required',
            'data_pasien_id' => 'required'
         ]);
 
         $tanggalambil = $request->input('tanggalambil');
         $tanggalkembali = $request->input('tanggalkembali');
         $keluhan = $request->input('keluhan');
         $data_pasien_id = $request->input('data_pasien_id');
 
         $jadwalobat = new JadwalObat([
             'keluhan' => $keluhan,
             'tanggalambil' => $tanggalambil,
             'tanggalkembali' => $tanggalkembali,
             'data_pasien_id' => $data_pasien_id,
         ]);
 
         if ($jadwalobat->save()) {
             $jadwalobat->view_jadwalobat = [
                 'href' => 'api/v1/jadwalobat/' . $jadwalobat->id,
                 'method' => 'GET'
             ];
             $message = [
                 'message' => 'jadwalobat created',
                 'jadwalobat' => $jadwalobat
             ];
             return response()->json($message, 201);
         }
 
         $response = [
             'message' => 'Error during creationg'
         ];
 
         return response()->json($response, 404);
    }

    
    public function show($data_pasien_id)
    {
        $jadwalobat = JadwalObat::where('data_pasien_id', $data_pasien_id)->get();

        $response = [
            'message' => 'jadwalobat information',
            'jadwalobat' => $jadwalobat
        ];
        return response()->json($response, 200);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'tanggalambil' => 'required',
            'tanggalkembali' => 'required',
            'keluhan' => 'required',
         ]);
 
         $tanggalambil = $request->input('tanggalambil');
         $tanggalkembali = $request->input('tanggalkembali');
         $keluhan = $request->input('keluhan');
 

        $jadwalobat = JadwalObat::findOrFail($id);

        $jadwalobat->tanggalambil = $tanggalambil;
        $jadwalobat->tanggalkembali = $tanggalkembali;
        $jadwalobat->keluhan = $keluhan;

        if(!$jadwalobat->update()){
            return response()->json([
                'message' => 'Error during update'
            ], 404);
        }

        $jadwalobat->view_jadwalobat = [
            'href' => 'api/v1/jadwalobat/' . $jadwalobat->id,
            'method' => 'GET'
        ];

        $response = [
            'message' => 'jadwalobat Updated',
            'jadwalobat' => $jadwalobat
        ];

        return response()->json($response, 200);
    }

  
    public function destroy($id)
    {
        $jadwalobat = JadwalObat::findOrFail($id);

        if(!$jadwalobat->delete()){
            return response()->json([
                'message' => 'Deletion Failed'
            ], 404);
        }

        $response = [
            'message' => 'jadwalobat deleted',
            'create' => [
                'href' => 'api/v1/jadwalobat',
                'method' => 'POST',
                'params' => 'title, description, time'
            ]
        ];

        return response()->json($response, 200);
    }
}
