<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Outlet;

class Kategori extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function outlets()
    {
    	return $this->hasMany(Outlet::class);
    }
}
