@extends('layouts.appflexy')
@section('breadcrumb')
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="index.html" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Dashboard</h1> 
                    </div>
@endsection
@section('content')
                <div class="row gx-3">
                  <div class="col-md-4 col-6">
                    <div class="card text-white bg-primary">
                      <div class="card-body">
                        <span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-grid feather-lg fill-white"><rect x="3" y="3" width="7" height="7"></rect><rect x="14" y="3" width="7" height="7"></rect><rect x="14" y="14" width="7" height="7"></rect><rect x="3" y="14" width="7" height="7"></rect></svg>
                        </span>
                        <h3 class="card-title mt-3 mb-0 text-white">{{ $total_produk }}</h3>
                        <p class="card-text text-white-50 fs-6"">
                          Produk
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-6">
                    <div class="card text-white bg-success">
                      <div class="card-body">
                        <span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive feather-lg fill-white"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>
                        </span>
                        <h3 class="card-title mt-3 mb-0 text-white">{{ $total_itemin }}</h3>
                        <p class="card-text text-white-50 fs-6"">
                          Barang Masuk
                        </p>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4 col-6">
                    <div class="card text-white bg-danger">
                      <div class="card-body">
                        <span>
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-gift feather-lg fill-white"><polyline points="20 12 20 22 4 22 4 12"></polyline><rect x="2" y="7" width="20" height="5"></rect><line x1="12" y1="22" x2="12" y2="7"></line><path d="M12 7H7.5a2.5 2.5 0 0 1 0-5C11 2 12 7 12 7z"></path><path d="M12 7h4.5a2.5 2.5 0 0 0 0-5C13 2 12 7 12 7z"></path></svg>
                        </span>
                        <h3 class="card-title mt-3 mb-0 text-white">{{ $total_itemout }}</h3>
                        <p class="card-text text-white-50 fs-6"">
                          Barang Keluar
                        </p>
                      </div>
                    </div>
                  </div>
                </div>
@endsection
