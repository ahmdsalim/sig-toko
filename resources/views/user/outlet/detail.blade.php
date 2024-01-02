@extends('layouts.applanding')
@section('content')
	  <div class="container mt-3 mb-5">
	  	<div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card border">
                            <div class="card-body">
                                <center> <img src="{{ Storage::url('outlet-img1/'.$outlet->img1) }}" class="rounded" width="200">
                                    <h4 class="card-title mt-2">{{ $outlet->nama_outlet }}</h4>
                                    <h6 class="card-subtitle text-muted">{{ $outlet->kategori->nama_kategori }}</h6>
                                </center>
                            </div>
                            <hr>
                            <div class="card-body">
                            	<small class="text-muted">Deskripsi</small>
                                <h6>{{ $outlet->deskripsi }}</h6>
                            	<small class="text-muted">Alamat email</small>
                                <h6>{{ $outlet->user->email }}</h6> <small class="text-muted p-t-30 db">Telp</small>
                                <h6>{{ $outlet->telp }}</h6> <small class="text-muted p-t-30 db">Alamat Toko</small>
                                <h6>{{ $outlet->alamat }}</h6>
                                <div class="map-box">
                                    <div id="map" style="height: 150px;"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">
                            	<h4 class="fw-semibold">List Produk</h4>
                                <ol class="list-group @if(count($outlet->produks) > 0)list-group-numbered @endif">
                                @forelse($outlet->produks as $data)
								  <li class="list-group-item d-flex justify-content-between align-items-start">
								    <div class="ms-2 me-auto">
								      <div class="fw-bold">{{ $data->nama_produk }}</div>
								      Rp. {{ number_format($data->harga, 2, ',', '.'); }}
								    </div>
								    <span class="badge bg-primary rounded-pill">{{ $data->stok }} Pcs</span>
								  </li>
								@empty
								<li class="list-group-item d-flex justify-content-center align-items-center">
								    <div class="mx-auto">
								      Belum ada Produk
								    </div>
								</li>
								@endforelse
								</ol>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
	  </div>
@endsection

@push('css')
		<link rel="stylesheet" href="https://unpkg.com/leaflet/dist/leaflet.css" />
@endpush

@push('js')
		<script src="https://unpkg.com/leaflet/dist/leaflet.js"></script>
		<script>
		  // Inisialisasi peta dengan koordinat tertentu
		  const latlong = [{{$outlet->latitude}},{{$outlet->longitude}}]

		  var map = L.map('map').setView(latlong, 13);

		  // Tambahkan layer peta dari OpenStreetMap
		  L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
		    attribution: '© OpenStreetMap contributors'
		  }).addTo(map);

		  // Tambahkan marker ke peta
		  L.marker(latlong).addTo(map);
		</script>
@endpush