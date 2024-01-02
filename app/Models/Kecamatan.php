<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Outlet;
use App\Models\KecamatanLonglat;

class Kecamatan extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function outlets()
    {
    	return $this->hasMany(Outlet::class);
    }

    public function kecmatanlonglats()
    {
    	return $this->hasMany(KecamatanLonglat::class);
    }
}
