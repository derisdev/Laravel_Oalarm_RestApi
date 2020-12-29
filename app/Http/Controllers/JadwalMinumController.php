<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JadwalMinum;

class JadwalMinumController extends Controller
{
   
    public function index()
    {
        $jadwalminums = JadwalMinum::all();

        $response = [
            'message' => 'List of all jadwalminums',
            'jadwalminums' => $jadwalminums
        ];

        return response()->json($response, 200);
    }


    public function store(Request $request)
    {
        $this->validate($request,[
            'terapi' => 'required',
            'dosis' => 'required',
            'jadwalminum' => 'required',
            'data_pasien_id' => 'required'
         ]);
 
         $terapi = $request->input('terapi');
         $dosis = $request->input('dosis');
         $jadwalminum = $request->input('jadwalminum');
         $data_pasien_id = $request->input('data_pasien_id');
 
         $newjadwalminum = new JadwalMinum([
             'jadwalminum' => $jadwalminum,
             'terapi' => $terapi,
             'dosis' => $dosis,
             'data_pasien_id' => $data_pasien_id
         ]);
 
         if ($newjadwalminum->save()) {
             $newjadwalminum->view_newjadwalminum = [
                 'href' => 'api/v1/newjadwalminum/' . $newjadwalminum->id,
                 'method' => 'GET'
             ];
             $message = [
                 'message' => 'newjadwalminum created',
                 'newjadwalminum' => $newjadwalminum
             ];
             return response()->json($message, 201);
         }
 
         $response = [
             'message' => 'Error during creationg'
         ];
 
         return response()->json($response, 404);
    }

    
    public function show($datapasien_id)
    {
        $jadwalminum = JadwalMinum::where('data_pasien_id', $datapasien_id)->get();
        $jadwalminum->view_jadwalminums = [
            'href' => 'api/v1/jadwalminum',
            'method' => 'GET'
        ];

        $response = [
            'message' => 'jadwalminum information',
            'jadwalminum' => $jadwalminum
        ];
        return response()->json($response, 200);
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'terapi' => 'required',
            'dosis' => 'required',
            'jadwalminum' => 'required',
         ]);
 
         $terapi = $request->input('terapi');
         $dosis = $request->input('dosis');
         $jadwalminum = $request->input('jadwalminum');
 

        $newjadwalminum = JadwalMinum::findOrFail($id);

        $newjadwalminum->terapi = $terapi;
        $newjadwalminum->dosis = $dosis;
        $newjadwalminum->jadwalminum = $jadwalminum;

        if(!$newjadwalminum->update()){
            return response()->json([
                'message' => 'Error during update'
            ], 404);
        }

        $newjadwalminum->view_jadwalminum = [
            'href' => 'api/v1/newjadwalminum/' . $newjadwalminum->id,
            'method' => 'GET'
        ];

        $response = [
            'message' => 'newjadwalminum Updated',
            'newjadwalminum' => $newjadwalminum
        ];

        return response()->json($response, 200);
    }

  
    public function destroy($id)
    {
        $jadwalminum = JadwalMinum::findOrFail($id);

        if(!$jadwalminum->delete()){
            return response()->json([
                'message' => 'Deletion Failed'
            ], 404);
        }

        $response = [
            'message' => 'jadwalminum deleted',
            'create' => [
                'href' => 'api/v1/jadwalminum',
                'method' => 'POST',
                'params' => 'title, description, time'
            ]
        ];

        return response()->json($response, 200);
    }
}
