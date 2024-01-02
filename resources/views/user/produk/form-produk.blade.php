@extends('layouts.appflexy')
@section('breadcrumb')
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="/" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{ route('produk.index') }}" class="link">Produk</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Tambah</li>
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
                              <h4 class="card-title mb-3 pb-3">@if (isset($produk)) Ubah @else Tambah @endif Produk</h4>
                                @if (isset($produk))
                                <form method="post" action="{{ route('produk.update', $produk->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @else
                                <form method="post" action="{{ route('produk.store') }}" enctype="multipart/form-data">
                                @endif
                                @csrf                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" name="nama_produk" id="tb-produk" value="{{ old('nama_produk', $produk->nama_produk ?? '') }}" placeholder="Masukkan nama produk">
                                      <label for="tb-produk">Nama Produk</label>
                                    </div>
                                    @error('nama_produk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control @error('harga') is-invalid @enderror" name="harga" id="tb-harga" value="{{ old('harga', $produk->harga ?? '') }}" placeholder="Masukkan harga">
                                      <label for="tb-harga">Harga</label>
                                    </div>
                                    @error('harga')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-12 text-end">
                                        <button type="submit" class="
                                            btn btn-success text-white
                                            font-weight-medium
                                            px-4
                                          ">
                                          Simpan
                                        </button>
                                  </div>
                                </div>
                              </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
