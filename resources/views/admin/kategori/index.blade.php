@extends('layouts.appflexy')
@section('breadcrumb')
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="/" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Kategori</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Kategori</h1> 
                    </div>
                    <div class="col-6">
                    	<div class="text-end upgrade-btn">
                            <a href="{{ route('kategori.create') }}" class="btn btn-info text-white">
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
                                <h4 class="card-title">Kategori</h4>
                                <h6 class="card-subtitle">Daftar kategori toko yang tersedia di website.</h6>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Kategori</th>
                                                <th scope="col">Icon</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php
                                            $startIndex = ($kategori->currentPage() - 1) * $kategori->perPage() + 1;
                                        @endphp
                                        @forelse($kategori as $data)
                                            <tr>
                                                <th scope="row">{{ $startIndex++ }}</th>
                                                <td>{{ $data->nama_kategori }}</td>
                                                <td><img src="{{ Storage::url('icon-kategori/'.$data->icon) }}" width="30"/></td>
                                                <td>
                                                	<div class="">
                                                		<a class="btn btn-info text-white btn-sm" href="{{ route('kategori.edit', $data->id) }}">Ubah</a>
                                                		<form class="d-inline-block" action="{{ route('kategori.destroy', $data->id) }}"method="POST">
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
                                                <td align="center" colspan="4">Belum ada kategori</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                    <div class="d-flex justify-content-center">
                                        {!! $kategori->links() !!}
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
