<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Outlet;
use App\Models\Produk;

class ItemInOut extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function outlet()
    {
    	return $this->belongsTo(Outlet::class);
    }

    public function produk()
    {
    	return $this->belongsTo(Produk::class);
    }
}
