<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kategori;
use App\Models\Kecamatan;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['user'] = auth()->user();
        return view('user.profile.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit()
    {
        $data['user'] = auth()->user();
        $data['kategori'] = Kategori::select('id','nama_kategori')->get();
        $data['kecamatan'] = Kecamatan::select('id','nama_kec')->get();
        return view('user.profile.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try{

            $validator = \Validator::make($request->all(), [
                'nama_outlet' => 'required|string',
                'deskripsi' => 'required|string',
                'nama_pemilik' => 'required|string',
                'password' => 'nullable|string',
                'kategori' => 'required|numeric',
                'kecamatan' => 'required|numeric',
                'alamat' => 'required|string',
                'telp' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'img1' => 'nullable|mimes:jpg,jpeg,png,webp|max:2040',
                'img2' => 'nullable|mimes:jpg,jpeg,png,webp|max:2040',
                'img3' => 'nullable|mimes:jpg,jpeg,png,webp|max:2040'
            ]);

            if(!$validator->fails()){
                $data = $validator->validated();
                
                $user = auth()->user();
                $outlet = $user->outlet;
                
                \DB::beginTransaction();

                $userdata = [
                    'nama' => $data['nama_pemilik']
                ];
                !empty($data['password']) ?? ($userdata['password'] = $data['password']);

                $user->update($userdata);

                $outlet->nama_outlet = $data['nama_outlet'];
                $outlet->deskripsi = $data['deskripsi'];
                $outlet->kategori_id = $data['kategori'];
                $outlet->kecamatan_id = $data['kecamatan'];
                $outlet->alamat = $data['alamat'];
                $outlet->telp = $data['telp'];
                $outlet->longitude = $data['longitude'];
                $outlet->latitude = $data['latitude'];

                if($request->hasFile('img1')){
                    $destination = 'public/outlet-img1/';
                    $img1 = $request->file('img1');
                    $img1_name = \Str::slug($data['nama_outlet']).\Str::random(4).'.'.$img1->getClientOriginalExtension();
                    $img1->storeAs($destination, $img1_name);
                    $outlet->img1 = $img1_name;
                }

                if($request->hasFile('img2')){
                    $destination = 'public/outlet-img2/';
                    $img2 = $request->file('img2');
                    $img2_name = \Str::slug($data['nama_outlet']).\Str::random(4).'.'.$img2->getClientOriginalExtension();
                    $img2->storeAs($destination, $img2_name);
                    $outlet->img2 = $img2_name;
                }

                if($request->hasFile('img3')){
                    $destination = 'public/outlet-img3/';
                    $img3 = $request->file('img3');
                    $img3_name = \Str::slug($data['nama_outlet']).\Str::random(4).'.'.$img3->getClientOriginalExtension();
                    $img3->storeAs($destination, $img3_name);
                    $outlet->img3 = $img3_name;
                }
                
                $outlet->save();

                \DB::commit();

                return to_route('user.index')->with('success','Berhasil Mengupdate Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            return to_route('user.index')->with('failed','Gagal Mengupdate Data'.$e->getMessage());
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
