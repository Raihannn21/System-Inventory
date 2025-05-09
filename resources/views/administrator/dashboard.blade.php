@extends('layouts.app')

@section('title', 'Beranda')
@section('description', 'Halaman Beranda')

@section('content')
<section class="row">
  <div class="col-12 col-lg-9">
    <div class="row">
      @foreach([
        ['route' => 'administrators.users.index', 'icon' => 'iconly-boldProfile', 'label' => 'Total Dosen/Staff', 'count' => $counts['administrator'], 'color' => 'primary'],
        ['route' => 'administrators.students.index', 'icon' => 'iconly-boldProfile', 'label' => 'Total Mahasiswa', 'count' => $counts['student'], 'color' => 'success'],
        ['route' => 'administrators.commodities.index', 'icon' => 'iconly-boldBookmark', 'label' => 'Total Komoditas Barang', 'count' => $counts['commodity'], 'color' => 'danger']
      ] as $item)
      <div class="col-6 col-lg-4 col-md-6 mb-4">
        <div class="card shadow-sm">
          <a href="{{ route($item['route']) }}" class="text-decoration-none">
            <div class="card-body">
              <div class="d-flex align-items-center">
                <div class="stats-icon bg-{{ $item['color'] }} text-white rounded-circle d-flex align-items-center justify-content-center me-3">
                  <i class="{{ $item['icon'] }}"></i>
                </div>
                <div>
                  <h6 class="text-muted">{{ $item['label'] }}</h6>
                  <h4 class="mb-0">{{ $item['count'] }}</h4>
                </div>
              </div>
            </div>
          </a>
        </div>
      </div>
      @endforeach
    </div>

    <div class="row">
      <div class="col-12 mb-4">
        <div class="card shadow-sm">
          <div class="card-header">
            <h4>Peminjaman Tahun Ini</h4>
            <div class="mb-3">
              <label for="year" class="form-label">Isi Tahun:</label>
              <input type="number" id="year" placeholder="Masukan tahun.." value="{{ date('Y') }}" class="form-control">
              <div class="form-text">Tekan tombol `Enter` untuk menampilkan grafik berdasarkan tahun yang dipilih.</div>
            </div>
          </div>
          <div class="card-body">
            <div id="chart-borrowing-by-year"></div>
          </div>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <div class="card shadow-sm">
          <div class="card-header">
            <h4>Komoditas Barang Yang Belum Dikembalikan</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-hover table-bordered">
                <thead>
                  <tr>
                    <th>Nama Mahasiswa</th>
                    <th>Komoditas Barang</th>
                    <th>Tanggal Peminjaman</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($borrowingsNotReturned as $borrowing)
                  <tr>
                    <td>
                      <span class="badge bg-primary" data-bs-toggle="tooltip" title="{{ $borrowing->student->identification_number ?? 'N/A' }} - {{ $borrowing->student->phone_number ?? 'N/A' }}">
                        {{ $borrowing->student->name ?? 'Unknown' }}
                      </span>
                    </td>
                    <td>{{ $borrowing->commodity->name ?? 'Unknown' }}</td>
                    <td>{{ $borrowing->date }}</td>
                  </tr>
                  @endforeach
                </tbody>                
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="col-12 col-lg-3">
    <div class="card mb-4 shadow-sm">
      <div class="card-body text-center">
        <div class="d-flex flex-column align-items-center">
          <h5>{{ auth('administrator')->user()->name }}</h5>
          <p class="text-muted">{{ auth('administrator')->user()->email }}</p>
        </div>
      </div>
    </div>

    <div class="card shadow-sm">
      <div class="card-header">
        <h4>Mahasiswa Yang Baru Terdaftar</h4>
      </div>
      <div class="card-body">
        @foreach ($latestRegisteredStudents as $student)
        <div class="recent-message d-flex px-4 py-3 border-bottom">
          <div class="name ms-4">
            <h5 class="mb-1">{{ $student->name }}</h5>
            <p class="text-muted mb-0">{{ $student->email }}</p>
          </div>
        </div>
        @endforeach
        <div class="px-4 mt-3">
          <a href="{{ route('administrators.students.index') }}" class="btn btn-outline-primary w-100">
            Daftar Mahasiswa
          </a>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('script')
@include('administrator.script')
@endpush
