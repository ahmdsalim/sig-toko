<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produk;
use App\Models\Outlet;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function indexadmin(Request $request)
    {
        $outlet_id = $request->query('outlet_id');
        $produk = Produk::query();
        if($outlet_id) $produk->where('outlet_id', $outlet_id);
        $data['produk'] = $produk->paginate(25);
        $data['outlet'] = Outlet::select('id','nama_outlet')->get();
        $data['outlet_id'] = $outlet_id;
        return view('admin.produk.index', $data);
    }

    public function index()
    {
        $outlet_id = auth()->user()->outlet->id;
        $data['produk'] = Produk::where('outlet_id',$outlet_id)->paginate(25);
        return view('user.produk.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.produk.form-produk');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(), [
                'nama_produk' => 'required|string',
                'harga' => 'required|numeric'
            ]);

            if(!$validator->fails()){
                $data = $validator->validated();

                $outlet = auth()->user()->outlet;

                $outlet->produks()->create([
                    'nama_produk' => $data['nama_produk'],
                    'harga' => $data['harga'],
                    'stok' => 0
                ]);

                return to_route('produk.index')->with('success','Berhasil Menyimpan Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            return to_route('produk.index')->with('failed','Gagal Menyimpan Data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $data['produk'] = $produk;
        return view('user.produk.form-produk', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Produk $produk)
    {
        try{

            $validator = \Validator::make($request->all(), [
                'nama_produk' => 'required|string',
                'harga' => 'required|numeric'
            ]);

            if(!$validator->fails()){
                $data = $validator->validated();
                
                $produk->update([
                    'nama_produk' => $data['nama_produk'],
                    'harga' => $data['harga']
                ]);

                return to_route('produk.index')->with('success','Berhasil Mengupdate Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            return to_route('produk.index')->with('failed','Gagal Mengupdate Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        try {
            $produk->delete();
            return to_route('produk.index')->with('success','Berhasil Menghapus Data');
        } catch (\Exception $e) {
            return to_route('produk.index')->with('failed','Gagal Menghapus Data');
        }
    }
}
