<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Outlet;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->role == 'admin'){
            $data['outlet'] = Outlet::all();
            return view('home', $data);
        }elseif (auth()->user()->role == 'outlet') {
            $user = auth()->user();
            $data['total_produk'] = $user->outlet->produks->count();
            $data['total_itemin'] = $user->outlet->iteminout()->where('status','masuk')->sum('jumlah');
            $data['total_itemout'] = $user->outlet->iteminout()->where('status','keluar')->sum('jumlah');
            return view('user.home', $data);
        }

        abort(401);
    }
}
