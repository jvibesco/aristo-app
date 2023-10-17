<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/" class="brand-link">
        <img src="{{ asset('dist/img/aristo2.png') }}" alt="Aristo Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light"><b>ASMI</b></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        @auth
            <div class="user-panel mt-3 d-flex">
                <div class="image d-flex align-items-center">
                    <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ Auth::user()->nama }}</a>
                    <p class="text-muted m-0">{{ Auth::user()->role->role }}</p>
                </div>
            </div>
        @endauth
        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                <li class="nav-item">
                    <a href="/" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>

                @canany(['admin', 'marketing'])
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-copy"></i>
                            <p>
                                Master
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        @canany(['admin', 'marketing'])
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ Route('customer.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Customer</p>
                                    </a>
                                </li>
                            </ul>
                        @endcanany

                        @can('admin')
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ Route('material.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Material</p>
                                    </a>
                                </li>
                            </ul>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('proses.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Proses</p>
                                    </a>
                                </li>
                            </ul>
                        @endcan
                    </li>
                @endcanany

                @canany(['admin', 'marketing', 'engineering', 'ppic'])
                    <li class="nav-item">
                        <a href="{{ route('joborder.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-tasks"></i>
                            <p>
                                Order
                            </p>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'engineering'])
                    <li class="nav-item">
                        <a href="{{ route('flowproses.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-stream"></i>
                            <p>Flow Proses</p>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'ppic'])
                    <li class="nav-item">
                        <a href="{{ route('schedule.index') }}" class="nav-link">
                            <i class="nav-icon far fa-calendar-alt"></i>
                            <p>Schedule Flow Proses</p>
                        </a>
                    </li>
                @endcanany

                @canany(['leaderProduksi', 'admin'])
                    <li class="nav-item">
                        <a href="{{ route('laporanflowproses.index') }}" class="nav-link">
                            <i class="fas fa-search nav-icon"></i>
                            <p>Proses Job Order</p>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'leaderProduksi', 'operator'])
                    <li class="nav-item">
                        <a href="{{ route('actual.index') }}" class="nav-link">
                            <i class="fab fa-wpforms nav-icon"></i>
                            <p>Actual Produksi</p>
                        </a>
                    </li>
                @endcanany

                @canany(['admin', 'marketing', 'engineering', 'leaderProduksi', 'ppic'])
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-table"></i>
                            <p>
                                Laporan
                                <i class="fas fa-angle-left right"></i>
                            </p>
                        </a>

                        <ul class="nav nav-treeview">
                            @canany(['admin', 'marketing', 'ppic', 'leaderProduksi'])
                                <li class="nav-item">
                                    <a href="{{ route('laporanorder.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Status Order</p>
                                    </a>
                                </li>
                            @endcanany

                            @canany(['admin', 'leaderProduksi', 'engineering', 'ppic'])
                                <li class="nav-item">
                                    <a href="{{ route('laporanproduksi.index') }}" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Produksi</p>
                                    </a>
                                </li>
                            @endcanany
                        </ul>
                    </li>
                @endcanany

                @can('admin')
                    <li class="nav-item">
                        <a href="{{ route('user.index') }}" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item">
                    <form id="logout-form" action="{{ route('logout') }}" method="post">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="nav-link">
                        <i class="fas fa-sign-out-alt nav-icon"></i>
                        <p>Logout</p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
