<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    use HasFactory;

    protected $table = "Artikel";
    protected $fillable = ['gambar','judul','deskripsi', 'nama_penulis', 'editor' ];
}
