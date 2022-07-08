<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bukus = Buku::get();

        return response()->json([
            'success' => true,
            'messages' => 'List data buku',
            'data' => $bukus
        ], 200);
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
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'judul_buku' => 'required',
            'penerbit_buku' => 'required',
            'pengarang_buku' => 'required',
            'tahun' => 'required',
        ]);

        // response if fail
        if($validator->fails()) {
            return response()->json($validator->errors(),400);
        }

        // save to DB
        $buku = Buku::create([
            'kategori_id' => $request->kategori_id,
            'judul_buku' => $request->judul_buku,
            'penerbit_buku' => $request->penerbit_buku,
            'pengarang_buku' => $request->pengarang_buku,
            'tahun' => $request->tahun
        ]);

        if($buku) {
            return response()->json([
                'success' => true,
                'messages' => 'Buku Created',
                'data' => $buku
            ], 201);
        }
        return response()->json([
            'success' => false,
            'messages' => 'Buku failed to save'
        ], 409);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $buku = Buku::findOrfail($id);

        return response()->json([
            'success' => true,
            'messages' => 'Detail data buku',
            'data' => $buku
        ],200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function edit(Buku $buku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buku $buku)
    {
        //set validation
        $validator = Validator::make($request->all(), [
            'kategori_id' => 'required',
            'judul_buku' => 'required',
            'penerbit_buku' => 'required',
            'pengarang_buku' => 'required',
            'tahun' => 'required',
        ]);
        
        //response error validation
        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        //find buku by ID
        $buku = Buku::findOrFail($buku->id);

        if($buku) {

            //update buku
            $buku->update([
                'kategori_id' => $request->kategori_id,
                'judul_buku' => $request->judul_buku,
                'penerbit_buku' => $request->penerbit_buku,
                'pengarang_buku' => $request->pengarang_buku,
                'tahun' => $request->tahun
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Buku Updated',
                'data'    => $buku  
            ], 200);

        }

        //data bukupost not found
        return response()->json([
            'success' => false,
            'message' => 'Buku Not Found',
        ], 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buku  $buku
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         //find buku by ID
         $buku = Buku::findOrfail($id);

         if($buku) {
 
             //delete buku
             $buku->delete();
 
             return response()->json([
                 'success' => true,
                 'message' => 'Buku Deleted',
             ], 200);
 
         }
 
         //data buku not found
         return response()->json([
             'success' => false,
             'message' => 'Buku Not Found',
         ], 404);
    }
}
