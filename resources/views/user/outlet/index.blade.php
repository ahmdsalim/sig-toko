@extends('layouts.applanding')
@section('content')
	  <div class="container mt-3 mb-5">
	  	<h4 class="text-center">List Toko</h4>
	    <div class="d-flex justify-content-center row">
	        <div class="col-md-10">
	        	<div class="row bg-white mb-3 rounded">
	        		<form class="form-inline d-flex align-items-center p-2" action="{{ route('toko.index') }}" method="GET">
						    <div class="form-floating me-2 flex-grow-1">
						        <input type="text" class="form-control" id="search" name="search" placeholder="Nama Toko" value="{{ $search }}">
						        <label for="search">Nama Toko</label>
						    </div>

						    <div class="form-floating mx-2 flex-grow-1">
						        <select class="form-select" id="kategori" name="kategori">
						            <option value="">Semua</option>
						            @foreach($kategoris as $data)
                                        <option value="{{ $data->id }}" @selected($data->id == $kategori)>{{ $data->nama_kategori }}</option>
                                    @endforeach
						        </select>
						        <label for="kategori">Kategori</label>
						    </div>

						    <div class="form-floating ms-2 flex-shrink">
						    	<button type="submit" class="btn btn-primary">Search</button>
						    </div>
						</form>
	        	</div>
	        	@foreach($outlet as $data)
	            <div class="row p-2 mb-3 bg-white border rounded">
	                <div class="col-md-3 mt-1"><img class="img-fluid img-responsive rounded toko-image" src="{{ Storage::url('outlet-img1/'.$data->img1) }}"></div>
	                <div class="col-md-6 mt-1">
	                    <h5>{{$data->nama_outlet}}</h5>
	                    <div class="mt-1 mb-1 kat-1"><span>{{$data->kategori->nama_kategori}}</span></div>
	                    <p class="text-justify text-truncate para mb-0">{{$data->deskripsi}}<br><br></p>
	                </div>
	                <div class="align-items-center align-content-center col-md-3 border-left mt-1">
	                    <div class="d-flex flex-row align-items-center">
	                        <h4 class="mr-1">{{ $data->produks->count() }}</h4>
	                    </div>
	                    <h6 class="text-success">Produk</h6>
	                    <div class="d-flex flex-column mt-4"><a class="btn btn-primary btn-sm" href="{{ route('toko.detail',$data->id) }}">Cek Toko</a><a class="btn btn-outline-primary btn-sm mt-2" target="_blank" href="https://www.google.com/maps?q={{ $data->latitude }},{{ $data->longitude }}">Lihat Lokasi</a></div>
	                </div>
	            </div>
	            @endforeach
	            <div class="row">
	            	<div class="d-flex justify-content-center">
                        {!! $outlet->links() !!}
                    </div>
	            </div>
	        </div>
	    </div>
	</div>
@endsection

@push('css')
	<style type="text/css">
		.toko-image{width: 100%}.kat-1{color: #938787;font-size: 15px}h5{font-weight: 400}.para{font-size: 16px}.produk-text{margin-left: .3rem;}
	</style>
@endpush