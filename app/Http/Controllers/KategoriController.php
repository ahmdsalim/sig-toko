<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kategori'] = Kategori::paginate(25);
        return view('admin.kategori.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kategori.form-kategori');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(), [
                'nama_kategori' => 'required|string',
                'icon' => 'required|mimes:jpg,jpeg,png,webp|max:2040'
            ]);

            if(!$validator->fails()){
                $data = $validator->validated();

                $kategori = new Kategori();
                $kategori->nama_kategori = $data['nama_kategori'];

                if($request->hasFile('icon')){
                    $destination = 'public/icon-kategori/';
                    $icon = $request->file('icon');
                    $icon_name = \Str::slug($data['nama_kategori']).\Str::random(4).'.'.$icon->getClientOriginalExtension();
                    $icon->storeAs($destination, $icon_name);
                    $kategori->icon = $icon_name;
                }
                
                $kategori->save();

                return to_route('kategori.index')->with('success','Berhasil Menyimpan Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            return to_route('kategori.index')->with('failed','Gagal Menyimpan Data');
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
    public function edit($id)
    {
        $data['kategori'] = Kategori::findOrFail($id);
        return view('admin.kategori.form-kategori',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        try{
            $kategori = Kategori::findOrFail($id);

            $validator = \Validator::make($request->all(), [
                'nama_kategori' => 'required|string',
                'icon' => 'nullable|mimes:jpg,jpeg,png,webp|max:2040'
            ]);

            if(!$validator->fails()){
                $data = $validator->validated();
                
                $kategori->nama_kategori = $data['nama_kategori'];

                if($request->hasFile('icon')){
                    $destination = 'public/icon-kategori/';
                    $icon = $request->file('icon');
                    $icon_name = \Str::slug($data['nama_kategori']).\Str::random(4).'.'.$icon->getClientOriginalExtension();
                    $icon->storeAs($destination, $icon_name);
                    \Storage::delete($destination . $kategori->icon);
                    $kategori->icon = $icon_name;
                }

                $kategori->save();

                return to_route('kategori.index')->with('success','Berhasil Mengupdate Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            return to_route('kategori.index')->with('failed','Gagal Mengupdate Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $kategori = Kategori::findOrFail($id);
            \Storage::delete('public/icon-kategori/'.$kategori->icon);
            $kategori->delete();

            return to_route('kategori.index')->with('success','Berhasil Menghapus Data'); 
        } catch (\Exception $e) {
            return to_route('kategori.index')->with('failed','Gagal Menghapus Data');
        }
    }
}
