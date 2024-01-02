<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Produk;
use App\Models\ItemInOut;

class Outlet extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user()
    {
    	return $this->belongsTo(User::class);
    }

    public function kategori()
    {
    	return $this->belongsTo(Kategori::class);
    }

    public function kecamatan()
    {
    	return $this->belongsTo(Kecamatan::class);
    }

    public function produks()
    {
    	return $this->hasMany(Produk::class);
    }

    public function iteminout()
    {
    	return $this->hasMany(ItemInOut::class);
    }
}
