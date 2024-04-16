<?php

namespace App\Http\Controllers\Api;

use App\Models\Artikel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ArtikelController extends Controller
{

    public function index()
    {
        $data = Artikel::orderBy('id', 'asc') ->get(); //diambil dari model Artikel
        return response()->json([
            'status' => true,
            'message' => 'data ditemukan',
            'data' => $data
        ], 200); //200 untuk berhasil

    }
    public function store(Request $request)
{
    $rules = [
        'gambar' => 'required',
        'judul' => 'required',
        'deskripsi' => 'required',
        'nama_penulis' => 'required',
        'editor' => 'required',
    ];

    $validator = Validator::make($request->all(), $rules);
    if ($validator->fails()) {
        return response()->json([
            'status' => false,
            'message' => 'Gagal menambahkan data',
            'data' => $validator->errors()
        ]);
    }
    $data = [
        'gambar' => $request->gambar,
        'judul' => $request->judul,
        'deskripsi' => $request->deskripsi,
        'nama_penulis' => $request->nama_penulis,
        'editor' => $request->editor
    ];

    $client = new Client();
    $url = "http://localhost:8000/api/artikel"; 
    $response = $client->post($url, [
        'json' => $data,
        'headers' => [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ],
    ]);

    $statusCode = $response->getStatusCode();

    if ($statusCode == 200) { //status code 200 untuk berhasill dan 404 untuk gagal
        return response()->json([
            'status' => true,
            'message' => 'Data berhasil ditambahkan',
        ], 200);
    } else {
        return response()->json([
            'status' => false,
            'message' => 'Gagal menambahkan data',
        ], $statusCode);
    }
}



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = Artikel::find($id); //dari model artikel menggunakan find berdasarkan id
        if ($data) {
            // Mendapatkan URL gambar
            $data->gambar = Storage::url($data->gambar);

            return response()->json([
                'status' => true,
                'message' => 'Data ditemukan',
                'data' => $data
            ], 200);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }
    }


    /**
    * Update the specified resource in storage.
    */
    public function update(Request $request, string $id)
    {
        $dataArtikel = Artikel::find($id);

        if (!$dataArtikel) {
            return response()->json([
                'status' => false,
                'message' => 'Data tidak ditemukan',
            ], 404);
        }

        $rules = [
            'judul' => 'required',
            'deskripsi' => 'required',
            'nama_penulis' => 'required',
            'editor' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg,gif,svg' // Validasi untuk gambar
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Gagal memperbarui data',
                'data' => $validator->errors()
            ]);
        }

        // Update data artikel
        $dataArtikel->judul = $request->judul;
        $dataArtikel->deskripsi = $request->deskripsi;
        $dataArtikel->nama_penulis = $request->nama_penulis;
        $dataArtikel->editor = $request->editor;

        // update ganbar
        if ($request->hasFile('gambar')) {
            Storage::delete($dataArtikel->gambar);
            $gambar = $request->file('gambar');
            $path = $gambar->store('public/images');
            $dataArtikel->gambar = $path;
        }
        $dataArtikel->save();

        return response()->json([
            'status' => true,
            'message' => 'Data berhasil diperbarui',
            'data' => $dataArtikel
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
