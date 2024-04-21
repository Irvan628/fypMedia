<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Artikel; 
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
        $judul = $request->judul;
        $deskripsi = $request->deskripsi;
        $nama_penulis = $request->nama_penulis;
        $editor = $request->editor;
        $gambar = $request->file('gambar');
        $path = $gambar->store('public/storage/images');


        $client = new Client();
        $url = "http://localhost:8000/api/artikel";
        $response = $client->request('POST', $url);
        $content = $response->getBody()->getContents();
        $contentArray = json_decode($content, true);
        if($contentArray['status'] != true){
            $error = $contentArray['data'];
            return redirect()->to('artikel')->with($error)->withInput();
        } else {
            return redirect()->to('artikel')->with('succes', 'Berhasil menambahkan data');
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

