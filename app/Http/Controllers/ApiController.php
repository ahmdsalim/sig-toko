<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\KecamatanLonglat;

class ApiController extends Controller
{
    public function getOutlets()
    {
    	$outlets = Outlet::with(['kategori','kecamatan'])->get();
        return response()->json($outlets);
    }

    public function getLocation(Request $request)
    {
    	$data = [];
    	$data['coordinat'] = [];
    	$kategori = $request->input('kategori');
    	$kecamatan = $request->input('kecamatan');
    	$search = $request->input('search');
    	$outlet = Outlet::query()->with('kategori:id,nama_kategori,icon')->with('kecamatan:id,nama_kec');
    	
    	if(!empty($search)){
    		$outlet->where('nama_outlet','like', "%{$search}%");
    	}

    	if(!empty($kategori)){
    		$outlet->where('kategori_id', $kategori);
    	}

    	if(!empty($kecamatan)){
    		$data['coordinat'] = KecamatanLonglat::select('longitude','latitude')->where('kecamatan_id', $kecamatan)->get();
    		$outlet->where('kecamatan_id', $kecamatan);
    	}

    	$data['marker'] = $outlet->get();

    	return response()->json($data, 200);

    }
}
