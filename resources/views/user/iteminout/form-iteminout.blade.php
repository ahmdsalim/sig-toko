@extends('layouts.appflexy')
@section('breadcrumb')
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="/" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{ route('iteminout.index') }}" class="link">Barang Masuk & Keluar</a></li>
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
                              <h4 class="card-title mb-3 pb-3">@if (isset($iteminout)) Ubah @else Tambah @endif Barang Masuk & Keluar</h4>
                                @if (isset($iteminout))
                                <form method="post" action="{{ route('iteminout.update', $iteminout->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @else
                                <form method="post" action="{{ route('iteminout.store') }}" enctype="multipart/form-data">
                                @endif
                                @csrf
                                <div class="row">
                                  <div class="col-md-12 mb-3">
                                    <div>
                                      <label>Produk</label>
                                      <select class="form-select shadow-none form-control-line @error('produk') is-invalid @enderror" name="produk" @if(isset($iteminout)) disabled="true" @endif required="">
                                        <option value="">Pilih Produk</option>
                                        @foreach($produk as $p)
                                          <option value="{{ $p->id }}" @selected(old('produk', $iteminout->produk_id ?? '') == $p->id)>{{ $p->nama_produk }}</option>
                                        @endforeach
                                      </select>
                                      @error('produk')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control @error('jumlah') is-invalid @enderror" name="jumlah" id="tb-jumlah" value="{{ old('jumlah', $iteminout->jumlah ?? '') }}" placeholder="Masukkan jumlah">
                                      <label for="tb-jumlah">Jumlah</label>
                                    </div>
                                    @error('jumlah')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12">
                                    <div class="mb-3">
                                      <label>Status</label>
                                      <select class="form-select shadow-none form-control-line @error('status') is-invalid @enderror" @if(isset($iteminout)) disabled="true" @endif name="status" required="">
                                        <option value="masuk">Masuk</option>
                                        <option value="keluar">Keluar</option>
                                      </select>
                                      @error('status')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="form-floating mb-3">
                                      <input type="text" class="form-control @error('keterangan') is-invalid @enderror" name="keterangan" id="tb-keterangan" value="{{ old('keterangan', $iteminout->keterangan ?? '') }}" placeholder="Masukkan keterangan">
                                      <label for="tb-keterangan">Keterangan</label>
                                    </div>
                                    @error('keterangan')
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
