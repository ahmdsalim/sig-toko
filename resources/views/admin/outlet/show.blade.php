@extends('layouts.appflexy')
@section('breadcrumb')
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="/" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link">Dashboard</a></li>
                              <li class="breadcrumb-item"><a href="{{ route('outlet.index') }}" class="link">Outlet</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Detail</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Detail</h1> 
                    </div>
@endsection
@section('content')
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-header bg-info">
                        <h4 class="mb-0 text-white">Detail Outlet</h4>
                      </div>
                      <form class="form-horizontal">
                        <div class="form-body">
                          <div class="card-body">
                            <h4 class="card-title mb-0">Info Akun</h4>
                          </div>
                          <div class="card-body border-top">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group row py-3">
                                  <label class="
                                      control-label
                                      text-end
                                      col-md-4
                                      font-weight-medium
                                    ">Email:</label>
                                  <div class="col-md-8">
                                    <p class="form-control-static">{{ $outlet->user->email }}</p>
                                  </div>
                                </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                <div class="form-group row py-3">
                                  <label class="
                                      control-label
                                      text-end
                                      col-md-4
                                      font-weight-medium
                                    ">Nama Pemilik:</label>
                                  <div class="col-md-8">
                                    <p class="form-control-static">{{ $outlet->user->nama }}</p>
                                  </div>
                                </div>
                              </div>
                              <!--/span-->
                            </div>
                          </div>
                          <div class="card-body">
                            <h4 class="card-title mb-0">Info Outlet</h4>
                          </div>
                          <div class="card-body border-top">
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group row py-3">
                                  <label class="
                                      control-label
                                      text-end
                                      col-md-4
                                      font-weight-medium
                                    ">Nama Outlet:</label>
                                  <div class="col-md-8">
                                    <p class="form-control-static">{{ $outlet->nama_outlet }}</p>
                                  </div>
                                </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                <div class="form-group row py-3">
                                  <label class="
                                      control-label
                                      text-end
                                      col-md-4
                                      font-weight-medium
                                    ">Kategori:</label>
                                  <div class="col-md-8">
                                    <p class="form-control-static">{{ $outlet->kategori->nama_kategori }}</p>
                                  </div>
                                </div>
                              </div>
                              <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group row py-3">
                                  <label class="
                                      control-label
                                      text-end
                                      col-md-4
                                      font-weight-medium
                                    ">Deskripsi:</label>
                                  <div class="col-md-8">
                                    <p class="form-control-static">{{ $outlet->deskripsi }}</p>
                                  </div>
                                </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                <div class="form-group row py-3">
                                  <label class="
                                      control-label
                                      text-end
                                      col-md-4
                                      font-weight-medium
                                    ">Kecamatan:</label>
                                  <div class="col-md-8">
                                    <p class="form-control-static">{{ $outlet->kecamatan->nama_kec }}</p>
                                  </div>
                                </div>
                              </div>
                              <!--/span-->
                            </div>
                            <!--/row-->
                            <div class="row">
                              <div class="col-md-6">
                                <div class="form-group row py-3">
                                  <label class="
                                      control-label
                                      text-end
                                      col-md-4
                                      font-weight-medium
                                    ">Telp:</label>
                                  <div class="col-md-8">
                                    <p class="form-control-static">{{ $outlet->telp }}</p>
                                  </div>
                                </div>
                              </div>
                              <!--/span-->
                              <div class="col-md-6">
                                <div class="form-group row py-3">
                                  <label class="
                                      control-label
                                      text-end
                                      col-md-4
                                      font-weight-medium
                                    ">Alamat:</label>
                                  <div class="col-md-8">
                                    <p class="form-control-static">{{ $outlet->alamat }}</p>
                                  </div>
                                </div>
                              </div>
                              <!--/span-->
                            </div>
                            <!--/row-->
                          </div>
                          <div class="card-body">
                            <h4 class="card-title mb-0">Gambar</h4>
                          </div>
                          <div class="card-body border-top">
                            <div class="d-flex gap-2">
                                <img src="{{ Storage::url('outlet-img1/'.$outlet->img1) }}" width="150">
                                @if(!empty($outlet->img2))
                                <img src="{{ Storage::url('outlet-img2/'.$outlet->img2) }}" width="150">
                                @endif
                                @if(!empty($outlet->img3))
                                <img src="{{ Storage::url('outlet-img3/'.$outlet->img3) }}" width="150">
                                @endif
                            </div>
                          </div>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
@endsection
