<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Outlet;
use App\Models\ItemInOut;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function outlet()
    {
    	return $this->belongsTo(Outlet::class);
    }

    public function iteminout()
    {
    	return $this->hasMany(ItemInOut::class);
    }
}
