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
                    <div class="col-6">
                        <div class="text-end upgrade-btn">
                            <a href="{{ route('produk.create') }}" class="btn btn-info text-white">
                                <i class="mdi mdi-plus me-1"></i>
                                Tambah Baru
                            </a>
                        </div>
                    </div>
@endsection
@section('content')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">List Produk</h4>
                                <h6 class="card-subtitle">Daftar produk yang ada di website.</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Nama Produk</th>
                                                <th scope="col">Harga</th>
                                                <th scope="col">Stok</th>
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