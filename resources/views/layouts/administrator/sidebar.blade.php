<div class="sidebar-menu">
  <ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ request()->routeIs('administrators.dashboard') ? 'active' : '' }}">
      <a href="{{ route('administrators.dashboard') }}" class="sidebar-link">
        <i class="bi bi-grid-fill"></i>
        <span>Beranda</span>
      </a>
    </li>

    <li class="sidebar-title">Data Master</li>

    <li class="sidebar-item {{ request()->routeIs('administrators.commodities.*') ? 'active' : '' }}">
      <a href="{{ route('administrators.commodities.index') }}" class="sidebar-link">
        <i class="bi bi-collection-fill"></i>
        <span>Komoditas Barang</span>
      </a>
    </li>
    <li class="sidebar-item {{ Route::is('administrator/stock-commodity') ? 'active' : '' }}">
      <a href="/administrator/stock-commodity" class="sidebar-link">
        <i class="bi bi-collection-fill"></i>
        <span>Stok Barang</span>
      </a>
    </li>

    <li class="sidebar-item {{ request()->routeIs('administrators.program-studies.*') ? 'active' : '' }}">
      <a href="{{ route('administrators.program-studies.index') }}" class="sidebar-link">
        <i class="bi bi-bookmarks-fill"></i>
        <span>Program Studi</span>
      </a>
    </li>

    <li class="sidebar-item {{ request()->routeIs('administrators.school-classes.*') ? 'active' : '' }}">
      <a href="{{ route('administrators.school-classes.index') }}" class="sidebar-link">
        <i class="bi bi-building-fill"></i>
        <span>Kelas</span>
      </a>
    </li>

    <li class="sidebar-item {{ request()->routeIs('administrators.subjects.*') ? 'active' : '' }}">
      <a href="{{ route('administrators.subjects.index') }}" class="sidebar-link">
        <i class="bi bi-book-half"></i>
        <span>Mata Kuliah</span>
      </a>
    </li>

    <li class="sidebar-item has-sub">
      <a href="#" class="sidebar-link">
        <i class="bi bi-newspaper"></i>
        <span>Berita</span>
      </a>
      <ul class="submenu {{ request()->routeIs('administrators.kategoris*') ? 'active' : '' }}">
        <li class="submenu-item {{ request()->routeIs('administrators.kategoris.index') ? 'active' : '' }}">
          <a href="{{ route('administrators.kategoris.index') }}">Kategori Berita</a>
        </li>
        <li class="submenu-item {{ request()->routeIs('administrators.beritas*') ? 'active' : '' }}">
          <a href="{{ route('administrators.beritas.index') }}">Berita</a>
        </li>
      </ul>
    </li>

    <li class="sidebar-item has-sub">
      <a href="#" class="sidebar-link">
        <i class="bi bi-stack"></i>
        <span>Peminjaman</span>
      </a>
      <ul class="submenu {{ request()->routeIs('administrators.borrowings*') ? 'active' : '' }}">
        <li class="submenu-item {{ request()->routeIs('administrators.borrowings.index') ? 'active' : '' }}">
          <a href="{{ route('administrators.borrowings.index') }}">Peminjaman Hari Ini</a>
        </li>
        <li class="submenu-item {{ request()->routeIs('administrators.borrowings-history.index') ? 'active' : '' }}">
          <a href="{{ route('administrators.borrowings-history.index') }}">Riwayat Peminjaman</a>
        </li>
        <li class="submenu-item {{ request()->routeIs('administrators.borrowings-report.index') ? 'active' : '' }}">
          <a href="{{ route('administrators.borrowings-report.index') }}">Laporan</a>
        </li>
      </ul>
    </li>

    <li class="sidebar-title">Manajemen Akun</li>

    <li class="sidebar-item {{ request()->routeIs('administrators.students.*') ? 'active' : '' }}">
      <a href="{{ route('administrators.students.index') }}" class="sidebar-link">
        <i class="bi bi-people-fill"></i>
        <span>Mahasiswa</span>
      </a>
    </li>

    <li class="sidebar-item {{ request()->routeIs('administrators.users.*') ? 'active' : '' }}">
      <a href="{{ route('administrators.users.index') }}" class="sidebar-link">
        <i class="bi bi-person-badge-fill"></i>
        <span>Dosen/Staf</span>
      </a>
    </li>
    <li class="sidebar-item {{ request()->routeIs('administrators.users.*') ? 'active' : '' }}">
      <a href="/administrator/activity" class="sidebar-link">
        <i class="bi bi-activity"></i>
        <span>Log Aktifitas</span>
      </a>
    </li>    
    <li class="sidebar-item {{ Route::is('administrator/bug-report') ? 'active' : '' }}">
      <a href="/administrator/bug-report" class="sidebar-link">
        <i class="bi bi-collection-fill"></i>
        <span>Bug Report</span>
      </a>
    </li>  
  </ul>
</div>
