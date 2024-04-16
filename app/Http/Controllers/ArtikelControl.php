<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artikel; // Added the Artikel model import

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
        $gambar = $request->file('gambar'); // Changed to get the file input
        $judul = $request->judul;
        $deskripsi = $request->deskripsi;
        $nama_penulis = $request->nama_penulis;
        $editor = $request->editor;

        // Save the uploaded image to the desired directory
        $gambar = $request->file('gambar');
        $path = $gambar->store('public/storage/images');
        $artikel = new Artikel;
        $artikel->gambar = $path;
        $artikel->judul = $judul;
        $artikel->deskripsi = $deskripsi;
        $artikel->nama_penulis = $nama_penulis;
        $artikel->editor = $editor;
        $artikel->save();

        return redirect()->to('artikel')->with('success', 'Berhasil Memasukkan Data');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

