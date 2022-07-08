<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    use HasFactory;

    protected $table = "buku";
    protected $fillable = [
        'id',
        'kategori_id',
        'judul_buku',
        'penerbit_buku',
        'pengarang_buku',
        'tahun',
    ];
}
