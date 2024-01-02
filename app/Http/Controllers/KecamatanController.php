<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;

class KecamatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['kecamatan'] = Kecamatan::paginate(25);
        return view('admin.kecamatan.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kecamatan.form-kecamatan');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(), [
                'nama_kecamatan' => 'required|string'
            ]);

            if(!$validator->fails()){
                $data = $validator->validated();

                Kecamatan::create([
                    'nama_kec' => $data['nama_kecamatan']
                ]);

                return to_route('kecamatan.index')->with('success','Berhasil Menyimpan Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            return to_route('kecamatan.index')->with('failed','Gagal Menyimpan Data');
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
    public function edit(string $id)
    {
        $data['kecamatan'] = Kecamatan::findOrFail($id);
        return view('admin.kecamatan.form-kecamatan',$data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try{
            $kecamatan = Kecamatan::findOrFail($id);

            $validator = \Validator::make($request->all(), [
                'nama_kecamatan' => 'required|string'
            ]);

            if(!$validator->fails()){
                $data = $validator->validated();
                
                $kecamatan->nama_kec = $data['nama_kecamatan'];

                $kecamatan->save();

                return to_route('kecamatan.index')->with('success','Berhasil Mengupdate Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            return to_route('kecamatan.index')->with('failed','Gagal Mengupdate Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
