@extends('layouts.appflexy')
@section('breadcrumb')
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="/" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Outlet</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Outlet</h1> 
                    </div>
                    <div class="col-6">
                    	<div class="text-end upgrade-btn">
                            <a href="{{ route('outlet.create') }}" class="btn btn-info text-white">
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
                                <h4 class="card-title">Outlet</h4>
                                <h6 class="card-subtitle">Daftar outlet yang mendaftar di website.</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Img.</th>
                                                <th scope="col">Nama Outlet</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Kec.</th>
                                                <th scope="col">Telp.</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $startIndex = ($outlet->currentPage() - 1) * $outlet->perPage() + 1;
                                        @endphp
                                        @forelse($outlet as $data)
                                            <tr>
                                                <th scope="row">{{ $startIndex++ }}</th>
                                                <td><img src="{{ Storage::url('outlet-img1/'.$data->img1) }}" width="70" height="40"></td>
                                                <td>{{ $data->nama_outlet }}</td>
                                                <td>{{ $data->kategori->nama_kategori }}</td>
                                                <td>{{ $data->kecamatan->nama_kec }}</td>
                                                <td>{{ $data->telp }}</td>
                                                <td>
                                                	<div class="">
                                                        <a class="btn btn-success text-white btn-sm" href="{{ route('outlet.show', $data->id) }}">Detail</a>
                                                		<a class="btn btn-info text-white btn-sm" href="{{ route('outlet.edit', $data->id) }}">Ubah</a>
                                                		<form class="d-inline-block" action="{{ route('outlet.destroy', $data->id) }}"method="POST">
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
                                                <td align="center" colspan="7">Belum ada outlet</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {!! $outlet->links() !!}
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
