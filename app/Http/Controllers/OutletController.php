<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\User;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['outlet'] = Outlet::paginate(25);
        return view('admin.outlet.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data['kategori'] = Kategori::select('id','nama_kategori')->get();
        $data['kecamatan'] = Kecamatan::select('id','nama_kec')->get();
        return view('admin.outlet.form-outlet', $data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $validator = \Validator::make($request->all(), [
                'nama_outlet' => 'required|string',
                'deskripsi' => 'required|string',
                'nama_pemilik' => 'required|string',
                'email' => 'required|email|unique:users,email',
                'password' => 'required|string',
                'kategori' => 'required|numeric',
                'kecamatan' => 'required|numeric',
                'alamat' => 'required|string',
                'telp' => 'required',
                'longitude' => 'required',
                'latitude' => 'required',
                'img1' => 'required|mimes:jpg,jpeg,png,webp|max:2040',
                'img2' => 'nullable|mimes:jpg,jpeg,png,webp|max:2040',
                'img3' => 'nullable|mimes:jpg,jpeg,png,webp|max:2040'
            ]);

            if(!$validator->fails()){
                $data = $validator->validated();

                \DB::beginTransaction();

                $user = User::create(['email' => $data['email'],
                                      'nama' => $data['nama_pemilik'],
                                      'password' => $data['password'],
                                      'role' => 'outlet'
                                    ]);

                $outlet = new Outlet();
                $outlet->nama_outlet = $data['nama_outlet'];
                $outlet->deskripsi = $data['deskripsi'];
                
                $outlet->user_id = $user->id;
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

                return to_route('outlet.index')->with('success','Berhasil Menyimpan Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            \DB::rollback();

            return to_route('outlet.index')->with('failed','Gagal Menyimpan Data');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Outlet $outlet)
    {
        $data['outlet'] = $outlet;
        return view('admin.outlet.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data['outlet'] = Outlet::findOrFail($id);
        $data['kategori'] = Kategori::select('id','nama_kategori')->get();
        $data['kecamatan'] = Kecamatan::select('id','nama_kec')->get();

        return view('admin.outlet.form-outlet', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Outlet $outlet)
    {
        try{
            $validator = \Validator::make($request->all(), [
                'nama_outlet' => 'required|string',
                'deskripsi' => 'required|string',
                'nama_pemilik' => 'required|string',
                'email' => 'required|email|unique:users,email,' . $outlet->user->id,
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

                \DB::beginTransaction();

                $user = $outlet->user;
                $userdata = [
                    'email' => $data['email'],
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
                    \Storage::delete($destination . $outlet->img1);
                    $outlet->img1 = $img1_name;
                }

                if($request->hasFile('img2')){
                    $destination = 'public/outlet-img2/';
                    $img2 = $request->file('img2');
                    $img2_name = \Str::slug($data['nama_outlet']).\Str::random(4).'.'.$img2->getClientOriginalExtension();
                    $img2->storeAs($destination, $img2_name);
                    \Storage::delete($destination . $outlet->img2);
                    $outlet->img2 = $img2_name;
                }

                if($request->hasFile('img3')){
                    $destination = 'public/outlet-img3/';
                    $img3 = $request->file('img3');
                    $img3_name = \Str::slug($data['nama_outlet']).\Str::random(4).'.'.$img3->getClientOriginalExtension();
                    $img3->storeAs($destination, $img3_name);
                    \Storage::delete($destination . $outlet->img3);
                    $outlet->img3 = $img3_name;
                }
                
                $outlet->save();

                \DB::commit();

                return to_route('outlet.index')->with('success','Berhasil Menyimpan Data'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            \DB::rollback();

            return to_route('outlet.index')->with('failed','Gagal Menyimpan Data');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Outlet $outlet)
    {
        try {
            \DB::beginTransaction();

            \Storage::delete('public/outlet-img1/'.$outlet->img1);
            if(!empty($outlet->img2)) \Storage::delete('public/outlet-img2/'.$outlet->img2);
            if(!empty($outlet->img3)) \Storage::delete('public/outlet-img3/'.$outlet->img3);
            $outlet->delete();
            $outlet->user->delete();

            \DB::commit();

            return back()->with('success', 'Berhasil Menghapus Data');
        } catch (\Exception $e) {
            \DB::rollback();

            return back()->with('failed', 'Gagal Menghapus Data');
        }
    }
}
