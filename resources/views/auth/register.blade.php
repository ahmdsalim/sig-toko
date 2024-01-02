@extends('layouts.applanding')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                            <div class="card-body">
                              <h4 class="card-title mb-3 pb-3">Daftar Outlet</h4>
                              @if(session('register-failed'))
                              <div class="alert alert-danger" role="alert">
                                  {{ session('register-failed') }}
                                </div>
                              @endif
                                <form method="post" action="{{ route('register') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                      <input type="text" class="form-control @error('nama_outlet') is-invalid @enderror" name="nama_outlet" id="tb-outlet" value="{{ old('nama_outlet') }}" placeholder="">
                                      <label for="tb-outlet">Nama Outlet</label>
                                    @error('nama_outlet')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div>
                                      <label>Deskripsi</label>
                                      <textarea class="form-control @error('deskripsi') is-invalid @enderror" name="deskripsi" rows="2">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                      <input type="text" class="form-control @error('nama_pemilik') is-invalid @enderror" name="nama_pemilik" id="tb-outlet" value="{{ old('nama_pemilik') }}" placeholder="">
                                      <label for="tb-outlet">Nama Pemilik</label>
                                    @error('nama_pemilik')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                      <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" id="tb-email" value="{{ old('email') }}" placeholder="">
                                      <label for="tb-email">Email</label>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div class="form-floating">
                                      <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="tb-password" placeholder="">
                                      <label for="tb-password">Password</label>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    </div>
                                  </div>
                                  <div class="col-md-12 mb-3">
                                    <div>
                                      <label>Kategori</label>
                                      <select class="form-select shadow-none form-control-line @error('kategori') is-invalid @enderror" name="kategori" required="">
                                        <option value="">Pilih Kategori</option>
                                        @foreach($kategori as $k)
                                          <option value="{{ $k->id }}" @selected(old('kategori') == $k->id)>{{ $k->nama_kategori }}</option>
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
                                          <option value="{{ $k->id }}" @selected(old('kecamatan' == $k->id))>{{ $k->nama_kec }}</option>
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
                                      <input type="text" class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="tb-alamat" value="{{ old('alamat') }}" placeholder="" >
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
                                      <input type="text" class="form-control @error('telp') is-invalid @enderror" name="telp" id="tb-telp" value="{{ old('telp') }}" placeholder="">
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
                                      <input type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" id="tb-longitude" value="{{ old('longitude') }}" placeholder="">
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
                                      <input type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" id="tb-latitude" value="{{ old('latitude') }}" placeholder="">
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
                                          Submit
                                        </button>
                                  </div>
                                </div>
                              </form>
                            </div>
                        </div>
        </div>
    </div>
</div>
@endsection
