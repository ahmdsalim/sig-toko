<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Kecamatan;

class KecamatanLonglat extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kecamatan()
    {
    	return $this->belongsTo(Kecamatan::class);
    }
}
