@extends('layouts.appflexy')
@section('breadcrumb')
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="/" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Produk</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Produk</h1> 
                    </div>
@endsection
@section('content')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List Produk</h4>
                                <h6 class="card-subtitle">Daftar produk yang ada di website.</h6>
                                <form class="row form-inline">
                                    <div class="col-12 col-md-4">
                                        <form class="form-inline" action="" method="GET">
                                            <div class="input-group mb-3">
                                                <select class="form-control" name="outlet_id">
                                                    <option value="">Semua</option>
                                                @foreach($outlet as $data)
                                                    <option value="{{ $data->id }}" @selected($data->id == $outlet_id)>{{ $data->nama_outlet }}</option>
                                                @endforeach
                                                </select>
                                                <button class="btn btn-info text-white" type="submit">
                                                  <svg width="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M3 4.6C3 4.03995 3 3.75992 3.10899 3.54601C3.20487 3.35785 3.35785 3.20487 3.54601 3.10899C3.75992 3 4.03995 3 4.6 3H19.4C19.9601 3 20.2401 3 20.454 3.10899C20.6422 3.20487 20.7951 3.35785 20.891 3.54601C21 3.75992 21 4.03995 21 4.6V6.33726C21 6.58185 21 6.70414 20.9724 6.81923C20.9479 6.92127 20.9075 7.01881 20.8526 7.10828C20.7908 7.2092 20.7043 7.29568 20.5314 7.46863L14.4686 13.5314C14.2957 13.7043 14.2092 13.7908 14.1474 13.8917C14.0925 13.9812 14.0521 14.0787 14.0276 14.1808C14 14.2959 14 14.4182 14 14.6627V17L10 21V14.6627C10 14.4182 10 14.2959 9.97237 14.1808C9.94787 14.0787 9.90747 13.9812 9.85264 13.8917C9.7908 13.7908 9.70432 13.7043 9.53137 13.5314L3.46863 7.46863C3.29568 7.29568 3.2092 7.2092 3.14736 7.10828C3.09253 7.01881 3.05213 6.92127 3.02763 6.81923C3 6.70414 3 6.58185 3 6.33726V4.6Z" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path> </g></svg>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </form>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Stok</th>
                                                @if(!isset($outlet_id))
                                                <th scope="col">Outlet</th>
                                                @endif
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $startIndex = ($produk->currentPage() - 1) * $produk->perPage() + 1;
                                        @endphp
                                        @forelse($produk as $data)
                                            <tr>
                                                <th scope="row">{{ $startIndex++ }}</th>
                                                <td>{{ $data->nama_produk }}</td>
                                                <td>{{ $data->harga }}</td>
                                                <td>{{ $data->stok }}</td>
                                                @if(!isset($outlet_id))
                                                <td>{{ $data->outlet->nama_outlet }}</td>
                                                @endif
                                                <td>
                                                	<div class="">
                                                		<a class="btn btn-info text-white btn-sm" href="{{ route('produk.edit', $data->id) }}">Ubah</a>
                                                		<form class="d-inline-block" action="{{ route('produk.destroy', $data->id) }}"method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="button" class="btn btn-danger text-white btn-sm" onclick="confirmOnDel(this)">
                                                            	Hapus
                                                            </button>
                                                        </form>
                                                	</div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td align="center" colspan="7">Belum ada Produk</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {!! $produk->links() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
@endsection

@push('js')
@vite('resources/js/alert.js')
@endpush