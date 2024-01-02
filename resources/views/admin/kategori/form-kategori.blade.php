@extends('layouts.appflexy')
@section('breadcrumb')
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="/" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{ route('kategori.index') }}" class="link">Kategori</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Kategori</h1> 
                    </div>
@endsection
@section('content')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <h4 class="card-title mb-3 pb-3">@if (isset($kategori)) Ubah @else Tambah @endif Kategori</h4>
                                @if (isset($kategori))
                                <form method="post" action="{{ route('kategori.update', $kategori->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @else
                                <form method="post" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
                                @endif
                                @csrf                                <div class="row">
                                  <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control @error('nama_kategori') is-invalid @enderror" name="nama_kategori" id="tb-kategori" value="{{ old('nama_kategori', $kategori->nama_kategori ?? '') }}" placeholder="Masukkan kategori baru">
                                      <label for="tb-kategori">Kategori Baru</label>
                                    </div>
                                    @error('nama_kategori')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12">
                                    <div class="mb-3">
                                      <label>Upload Icon</label>
                                      <input type="file" class="form-control @error('icon') is-invalid @enderror" name="icon" accept="image/*" placeholder="Icon">
                                      @error('icon')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
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
