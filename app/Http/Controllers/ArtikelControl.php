<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ArtikelControl extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $client =new Client();
        $url = "http://localhost:8000/api/artikel";
        $response = $client->request('GET', $url);
        //dd($response);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        $data = $contentArray['data'];
        return view('TEST', ['data'=>$data]);

    }

       
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $gambar = $request->gambar;
        $judul = $request->judul;
        $deskripsi = $request->deskripsi;
        $nama_penulis = $request->penulis;
        $editor = $request->editor;

        $parameter = [
            'gambar' => $gambar,
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'nama_penulis' => $nama_penulis,
            'editor' => $editor
        ];

        $client =new Client();
        $url = "http://localhost:8000/api/artikel";
        $response = $client->request('POST', $url, [
            'headers' => ['content-type' => 'application/json'],
            'body' => json_encode($parameter)
        ]);
        //dd($response);
        $content = $response->getBody()->getContents();
        return redirect()->to('welcome');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
