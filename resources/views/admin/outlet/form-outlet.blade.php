@extends('layouts.appflexy')
@section('breadcrumb')
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="/" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{ route('outlet.index') }}" class="link">Outlet</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Tambah</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Outlet</h1> 
                    </div>
@endsection
@section('content')
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                              <h4 class="card-title mb-3 pb-3">@if (isset($outlet)) Ubah @else Tambah @endif Outlet</h4>
                                @if (isset($outlet))
                                <form method="post" action="{{ route('outlet.update', $outlet->id) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @else
                                <form method="post" action="{{ route('outlet.store') }}" enctype="multipart/form-data">
                                @endif
                                @csrf                                <div class="row">
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                      <input type="text" class="form-control @error('nama_outlet') is-invalid @enderror" name="nama_outlet" id="tb-outlet" value="{{ old('nama_outlet', $outlet->nama_outlet ?? '') }}" placeholder="Masukkan nama outlet">
                                      <label for="tb-outlet">Nama Outlet</label>
                                    </div>
                                    @error('nama_outlet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div>
                                      <label>Deskripsi</label>
                                      <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="2">{{ old('deskripsi', $outlet->deskripsi ?? '') }}</textarea>
                                    </div>
                                    @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                      <input type="text" class="form-control @error('nama_pemilik') is-invalid @enderror" name="nama_pemilik" id="tb-outlet" value="{{ old('nama_pemilik', $outlet->user->nama ?? '') }}" placeholder="Masukkan nama pemilik">
                                      <label for="tb-outlet">Nama Pemilik</label>
                                    </div>
                                    @error('nama_pemilik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                      <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="tb-email" value="{{ old('email', $outlet->user->email ?? '') }}" placeholder="Masukkan email">
                                      <label for="tb-email">Email</label>
                                    </div>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <small class="text-muted fst-italic">Kosongkan jika tidak ingin mengubah password.</small>
                                    <div class="form-floating">
                                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="tb-password" placeholder="Masukkan password">
                                      <label for="tb-password">Password</label>
                                    </div>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div>
                                      <label>Kategori</label>
                                      <select class="form-select shadow-none form-control-line @error('kategori') is-invalid @enderror" name="kategori" required="">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategori as $k)
                                          <option value="{{ $k->id }}" @selected(old('kategori', $outlet->kategori_id ?? '') == $k->id)>{{ $k->nama_kategori }}</option>
                                        @endforeach
                                      </select>
                                      @error('kategori')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div>
                                      <label>Kecamatan</label>
                                      <select class="form-select shadow-none form-control-line @error('kecamatan') is-invalid @enderror" name="kecamatan">
                                        <option value="">Pilih Kecamatan</option>
                                        @foreach($kecamatan as $k)
                                          <option value="{{ $k->id }}" @selected(old('kecamatan', $outlet->kecamatan_id ?? '') == $k->id)>{{ $k->nama_kec }}</option>
                                        @endforeach
                                      </select>
                                      @error('kecamatan')
                                      <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                      <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="tb-alamat" value="{{ old('alamat', $outlet->alamat ?? '') }}" placeholder="Masukkan alamat" >
                                      <label for="tb-alamat">Alamat</label>
                                    </div>
                                    @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating ">
                                      <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" id="tb-telp" value="{{ old('telp', $outlet->telp ?? '') }}" placeholder="Masukkan telp">
                                      <label for="tb-telp">Telp</label>
                                    </div>
                                    @error('telp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating ">
                                      <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="tb-longitude" value="{{ old('longitude', $outlet->longitude ?? '') }}" placeholder="Masukkan longitude">
                                      <label for="tb-longitude">Longitude</label>
                                    </div>
                                    @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating ">
                                      <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="tb-latitude" value="{{ old('latitude', $outlet->latitude ?? '') }}" placeholder="Masukkan latitude">
                                      <label for="tb-latitude">Latitude</label>
                                    </div>
                                    @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="">
                                      <label>Upload Gambar 1</label>
                                      <input type="file" class="form-control @error('img1') is-invalid @enderror" name="img1" accept="image/*" placeholder="img1">
                                      @error('img1')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="">
                                      <label>Upload Gambar 2</label>
                                      <input type="file" class="form-control @error('img2') is-invalid @enderror" name="img2" accept="image/*" placeholder="img2">
                                      @error('img2')
                                      <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                      </span>
                                      @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="mb-3">
                                      <label>Upload Gambar 3</label>
                                      <input type="file" class="form-control @error('img3') is-invalid @enderror" name="img3" accept="image/*" placeholder="img3">
                                      @error('img3')
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
