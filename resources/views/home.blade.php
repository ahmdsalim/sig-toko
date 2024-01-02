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
                <div class="row">
                    <div class="col-12">
                      <div class="card">
                        <div class="card-body">
                          <div id="map-canvas" style="width: auto; height: 500px;"></div>
                        </div>
                      </div>
                    </div>
                </div>
@endsection
@push('css')
                <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAbXF62gVyhJOVkRiTHcVp_BkjPYDQfH5w"></script>
@endpush
@push('js')
                <script type="text/javascript">  
                    var map;
                    var markers = [];
                    var infoWindow; // Tambahkan definisi infoWindow di sini

                    function initialize() {
                        // Pengaturan peta Roadmap
                        var mapOptions = {
                            mapTypeId: google.maps.MapTypeId.ROADMAP
                        };

                        // Membuat peta
                        map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

                        // Inisialisasi infoWindow
                        infoWindow = new google.maps.InfoWindow();

                        // Mengambil data dari API
                        fetch('/api/outlets') // Ganti URL API sesuai dengan endpoint yang benar
                            .then(response => response.json())
                            .then(data => {
                                // Proses data API
                                data.forEach(location => {
                                    // Membuat informasi untuk setiap lokasi
                                    console.log(location)
                                    var infoWindowContent = `<div class="poi-info-window">
                                    <img class="mb-1" src="/storage/outlet-img1/${location.img1}" width="200px"><br>
                                    <div class="title full-width">${location.nama_outlet}</div>
                                    <div class="address">
                                      <div class="address-inline full-width">${location.alamat}</div>
                                      <div class="address-inline full-width">${location.kecamatan.nama_kec}</div>
                                    </div>
                                    <div class="view-link">
                                      <a target="_blank" href="" tabindex="0"> <span> View on Website </span> </a>
                                    </div>
                                    </div>`;

                                    // Menambah marker untuk setiap lokasi
                                    addMarker(location.latitude, location.longitude, infoWindowContent, location.kategori.icon);
                                });

                                // Zoom ke batas kordinat semua marker
                                var bounds = new google.maps.LatLngBounds();
                                markers.forEach(marker => {
                                    bounds.extend(marker.getPosition());
                                });
                                map.fitBounds(bounds);
                            })
                            .catch(error => console.error('Error fetching data:', error));
                    }

                    // Menambah marker ke peta
                    function addMarker(lat, lng, info, icon) {
                        var location = new google.maps.LatLng(lat, lng);

                        // Membuat marker
                        var marker = new google.maps.Marker({
                            map: map,
                            position: location,
                            icon: `/storage/icon-kategori/${icon}`
                        });

                        // Menambah marker ke array
                        markers.push(marker);

                        // Menampilkan informasi pada marker yang diklik
                        bindInfoWindow(marker, map, info);
                    }

                    // Menampilkan informasi pada masing-masing marker yang diklik
                    function bindInfoWindow(marker, map, info) {
                        google.maps.event.addListener(marker, 'click', function () {
                            infoWindow.setContent(info);
                            infoWindow.open(map, marker);
                        });
                    }

                    google.maps.event.addDomListener(window, 'load', initialize);



                </script>
@endpush
