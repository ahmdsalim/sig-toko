        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('home') }}" aria-expanded="false"><i class="mdi mdi-view-dashboard"></i><span
                                    class="hide-menu">Dashboard</span></a></li>
                        @if(auth()->user()->role == 'admin')
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('outlet.index') }}" aria-expanded="false"><i
                                    class="mdi mdi-store"></i><span class="hide-menu">Outlet</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('kategori.index') }}" aria-expanded="false"><i class="mdi mdi-format-list-bulleted"></i><span
                                    class="hide-menu">Kategori</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('kecamatan.index') }}" aria-expanded="false"><i class="mdi mdi-map-marker"></i><span
                                    class="hide-menu">Kecamatan</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('produk.index.admin') }}" aria-expanded="false"><i class="mdi mdi-cube"></i><span
                                    class="hide-menu">Produk</span></a></li>
                        @else
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('user.index') }}" aria-expanded="false"><i class="mdi mdi-account"></i><span
                                    class="hide-menu">Profile</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('produk.index') }}" aria-expanded="false"><i class="mdi mdi-cube"></i><span
                                    class="hide-menu">Produk</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="{{ route('iteminout.index') }}" aria-expanded="false"><i class="mdi mdi-box-shadow"></i><span
                                    class="hide-menu">Barang Masuk & Keluar</span></a></li>
                        @endif
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>