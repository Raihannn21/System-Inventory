<div class="sidebar-menu">
  <ul class="menu">
    <li class="sidebar-title">Menu</li>

    <li class="sidebar-item {{ request()->routeIs('students.dashboard') ? 'active' : '' }}">
      <a href="{{ route('students.dashboard') }}" class="sidebar-link">
        <i class="bi bi-grid-fill"></i>
        <span>Beranda</span>
      </a>
    </li>

    <li class="sidebar-title">Daftar Menu</li>

    <li class="sidebar-item has-sub">
      <a href="#" class="sidebar-link">
        <i class="bi bi-stack"></i>
        <span>Peminjaman</span>
      </a>
      <ul class="submenu {{ request()->routeIs('students.borrowings*') ? 'active' : '' }}">
        <li class="submenu-item {{ request()->routeIs('students.borrowings.index') ? 'active' : '' }}">
          <a href="{{ route('students.borrowings.index') }}">Peminjaman Saya Hari Ini</a>
        </li>
        <li class="submenu-item {{ request()->routeIs('students.borrowings-history.index') ? 'active' : '' }}">
          <a href="{{ route('students.borrowings-history.index') }}">Riwayat Peminjaman</a>
        </li>
      </ul>
      <li class="sidebar-item {{ Route::is('student/stock-commodity') ? 'active' : '' }}">
        <a href="/student/stock-commodity" class="sidebar-link">
          <i class="bi bi-collection-fill"></i>
          <span>Stok Barang</span>
        </a>
      </li>
      <li class="sidebar-item {{ Route::is('student/bug-report') ? 'active' : '' }}">
        <a href="/student/bug-report" class="sidebar-link">
          <i class="bi bi-collection-fill"></i>
          <span>Bug Report</span>
        </a>
      </li>
    </li>
  </ul>
</div>
