<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Kategori;
use App\Models\Kecamatan;
use App\Models\Outlet;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    // protected function create(array $data)
    // {
    //     return User::create([
    //         'nama' => $data['name'],
    //         'email' => $data['email'],
    //         'password' => Hash::make($data['password']),
    //         'role' => 'admin'
    //     ]);
    // }

    public function register(Request $request)
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

                return to_route('login')->with('register-success','Berhasil Mendaftar. Silahkan Login'); 
            }else{
                return redirect()->back()->withErrors($validator)->withInput();
            }

        } catch (\Exception $e) {
            \DB::rollback();

            return back()->with('register-failed','Gagal Mendaftar. Silahkan coba kembali');
        }
    }

    public function showRegistrationForm()
    {
        $data['kategori'] = Kategori::select('id','nama_kategori')->get();
        $data['kecamatan'] = Kecamatan::select('id','nama_kec')->get();
        return view('auth.register', $data);
    }
}
