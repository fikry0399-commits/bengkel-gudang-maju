<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ url('/dashboard') }}">BENGKEL GUDANG MAJU</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="/">BGM</a>
        </div>
        <ul class="sidebar-menu">
            <li class="{{ Request::is('dashboard*') ? 'active' : '' }}">
                <a class="nav-link" href="{{ url('/dashboard') }}"><i class="fas fa-fire"></i> <span>Dashboard</span></a>
            </li>

            {{-- MASTER DATA DROPDOWN --}}
            <li class="menu-header">Master Data</li>
            <li class="dropdown {{ Request::is('kriteria*', 'alternatif*', 'histori-truk*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-th-large"></i> <span>Master Data</span></a>
                <ul class="dropdown-menu">
                    {{-- Hanya Tampil untuk Admin --}}
                    @if(auth()->user()->role === 'admin' || auth()->user()->role->role_name === 'admin')
                        <li class="{{ Request::is('kriteria*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('kriteria.index') }}">Kriteria</a>
                        </li>
                        <li class="{{ Request::is('alternatif*') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('alternatif.index') }}">Alternatif</a>
                        </li>
                    @endif

                    {{-- Tampil untuk Admin & Pimpinan (User) --}}
                    <li class="{{ Request::is('histori-truk*') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('histori-truk.index') }}">Histori Truk</a>
                    </li>
                </ul>
            </li>

            {{-- TRANSACTION DROPDOWN --}}
            <li class="menu-header">Transaction</li>
            <li class="dropdown {{ Request::is('penilaian*') ? 'active' : '' }}">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-sync"></i> <span>Transaction</span></a>
                <ul class="dropdown-menu">
                    {{-- Hanya Tampil untuk Admin --}}
                    @if(auth()->user()->role === 'admin' || auth()->user()->role->role_name === 'admin')
                        <li class="{{ Request::is('penilaian') ? 'active' : '' }}">
                            <a class="nav-link" href="{{ route('penilaian.index') }}">Input Penilaian</a>
                        </li>
                    @endif

                    {{-- Tampil untuk Admin & Pimpinan (User) --}}
                    <li class="{{ Request::is('penilaian/hitung') ? 'active' : '' }}">
                        <a class="nav-link" href="{{ route('penilaian.hitung') }}">Hasil Perhitungan</a>
                    </li>
                </ul>
            </li>

            {{-- UTILITIES DROPDOWN (Khusus Admin) --}}
            @if(auth()->user()->role === 'admin' || auth()->user()->role->role_name === 'admin')
                <li class="menu-header">Utilities</li>
                <li class="dropdown">
                    <a href="#" class="nav-link has-dropdown"><i class="fas fa-ellipsis-h"></i> <span>Utilities</span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/user">User Management</a></li>
                        <li><a href="/role">Role Management</a></li>
                    </ul>
                </li>
            @endif
        </ul>
    </aside>
</div>