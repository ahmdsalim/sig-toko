<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Outlet;

class LandingController extends Controller
{
	public function index()
	{
		$data['kategori'] = Kategori::select('id','nama_kategori')->get();
		$data['kecamatan'] = Kecamatan::select('id','nama_kec')->get();
		$data['outlet'] = Outlet::latest()->take(3)->get();
    	return view('landing', $data);
	}

	public function listoutlet(Request $request)
	{
		$data['search'] = $request->query('search');
		$data['kategori'] = $request->query('kategori');
		$outlet = Outlet::query();

		if(!empty($data['search'])) {
			$outlet->where('nama_outlet','like',"%{$search}%");
		}

		if(!empty($data['kategori'])) {
			$outlet->where('kategori_id',$data['kategori']);
		}

		$data['outlet'] = $outlet->paginate(10);
		$data['kategoris'] = Kategori::select('id','nama_kategori')->get();

		return view('user.outlet.index', $data);
	}

	public function detailoutlet(Outlet $outlet)
	{
		$data['outlet'] = $outlet;
		return view('user.outlet.detail', $data);
	}
}
