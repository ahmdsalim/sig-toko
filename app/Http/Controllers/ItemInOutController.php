<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemInOut;
use App\Models\Produk;

class ItemInOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['iteminout'] = ItemInOut::orderBy('created_at', 'desc')->paginate(25);
        return view('user.iteminout.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        $data['produk'] = Produk::select('id','nama_produk')->where('outlet_id', $user->outlet->id)->get();
        return view('user.iteminout.form-iteminout', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(), [
                'produk' => 'required|numeric',
                'jumlah' => 'required|numeric',
                'status' => 'required|string|in:masuk,keluar',
                'keterangan' => 'nullable|string|max:180'
            ]);

            if(!$validator->fails()){
                $data = $validator->validated();

                $outlet = auth()->user()->outlet;


                $produk = Produk::select('id','stok')->where('id', $data['produk'])->first();

                $stokAkhir = $produk->stok;
                if($data['status'] == 'masuk') {
                    $stokAkhir += $data['jumlah'];
                }else {
                    $stokAkhir -= $data['jumlah'];
                }

                if($stokAkhir <= -1){
                    return redirect()->back()->with('failed','Stok akhir dikurang transaksi tidak boleh kurang dari 0.')->withInput();
                }

                \DB::beginTransaction();

                ItemInOut::create([
                    'outlet_id' => $outlet->id,
                    'produk_id' => $produk->id,
                    'jumlah' => $data['jumlah'],
                    'status' => $data['status'],
                    'keterangan' => $data['keterangan']
                ]);

                $produk->stok = $stokAkhir;
                $produk->save();

                \DB::commit();

                return to_route('iteminout.index')->with('success','Berhasil Menyimpan Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            \DB::rollback();
            return to_route('iteminout.index')->with('failed','Gagal Menyimpan Data');
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
    public function edit(ItemInOut $iteminout)
    {
        $user = auth()->user();
        $data['produk'] = Produk::select('id','nama_produk')->where('outlet_id', $user->outlet->id)->get();
        $data['iteminout'] = $iteminout;
        return view('user.iteminout.form-iteminout', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ItemInOut $iteminout)
    {
        try{
            $validator = \Validator::make($request->all(), [
                'jumlah' => 'required|numeric',
                'keterangan' => 'nullable|string|max:180'
            ]);

            if(!$validator->fails()){
                $data = $validator->validated();

                $produk = $iteminout->produk;

                $stokAkhir = $produk->stok;

                if($iteminout->status == 'masuk') {
                    $stokAkhir -= $iteminout->jumlah;
                } else {
                    $stokAkhir += $iteminout->jumlah;
                }

                $stokAkhir = $stokAkhir + $data['jumlah'];

                if($stokAkhir <= -1) {
                    return back()->with('failed','Gagal Mengubah. Stok akhir dikurang transaksi tidak boleh kurang dari 0.')->withInput();
                }

                \DB::beginTransaction();

                $iteminout->update([
                    'jumlah' => $data['jumlah'],
                    'keterangan' => $data['keterangan']
                ]);
                
                $produk->update(['stok' => $stokAkhir]);

                \DB::commit();

                return to_route('iteminout.index')->with('success','Berhasil Mengubah Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            \DB::rollback();
            return to_route('iteminout.index')->with('failed','Gagal Mengubah Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ItemInOut $iteminout)
    {
        try {
            $produk = $iteminout->produk;
            $stokAkhir = $produk->stok;

            if($iteminout->status == 'masuk'){
                $stokAkhir -= $iteminout->jumlah;
            }else{
                $stokAkhir += $iteminout->jumlah;
            }

            if($stokAkhir <= -1){
                return to_route('iteminout.index')->with('failed','Gagal Menghapus. Stok akhir tidak boleh kurang dari 0.');
            }

            $produk->update(['stok' => $stokAkhir]);
            $iteminout->delete();
            return to_route('iteminout.index')->with('success','Berhasil Menghapus Data');
        } catch (Exception $e) {
            return to_route('iteminout.index')->with('failed','Gagal Menghapus Data');
        }
    }
}
