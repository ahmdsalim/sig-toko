@extends('layouts.appflexy')
@section('breadcrumb')
                    <div class="col-6">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0 d-flex align-items-center">
                              <li class="breadcrumb-item"><a href="/" class="link"><i class="mdi mdi-home-outline fs-4"></i></a></li>
                              <li class="breadcrumb-item"><a href="{{ route('home') }}" class="link">Dashboard</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Barang Masuk & Keluar</li>
                            </ol>
                          </nav>
                        <h1 class="mb-0 fw-bold">Barang Masuk & Keluar</h1> 
                    </div>
                    <div class="col-6">
                        <div class="text-end upgrade-btn">
                            <a href="{{ route('iteminout.create') }}" class="btn btn-info text-white">
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
                                <h4 class="card-title">List Barang</h4>
                                <h6 class="card-subtitle">Daftar barang masuk & keluar.</h6>
                                <div class="table-responsive">
                                    @forelse($iteminout as $data)
                                        @if ($loop->first || $data->produk->id !== $currentProductId)
                                            @php $currentProductId = $data->produk->id; $currentProductName = $data->produk->nama_produk; @endphp
                                            @if (!$loop->first)
                                                </tbody>
                                            </table>
                                            @endif
                                            <h5 class="mt-3">{{ $currentProductName }}</h5>
                                            <table class="table table-hover">
                                                @if($loop->first)
                                                <thead>
                                                    <tr>
                                                        <th>Tgl.</th>
                                                        <th>Jml</th>
                                                        <th>Status</th>
                                                        <th>Ket.</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                @endif
                                                <tbody>
                                        @endif
                                        <tr>
                                            <td width="150">{{ $data->created_at->format('d-m-Y') }}</td>
                                            <td width="150">{{ $data->jumlah }}</td>
                                            <td width="150">{{ ucfirst($data->status) }}</td>
                                            <td width="150">{{ $data->keterangan }}</td>
                                            <td width="150">
                                                <div class="">
                                                    <a class="btn btn-info text-white btn-sm" href="{{ route('iteminout.edit', $data->id) }}">Ubah</a>
                                                    <form class="d-inline-block" action="{{ route('iteminout.destroy', $data->id) }}" method="POST">
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
                                            <td align="center" colspan="7">Belum ada barang masuk & keluar</td>
                                        </tr>
                                    @endforelse
                                    @if (!$iteminout->isEmpty())
                                        </tbody>
                                    </table>
                                    @endif
                                    <div class="d-flex justify-content-center">
                                        {!! $iteminout->links() !!}
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