@extends('layouts.app')
@section('title', 'Laporan Peminjaman')
@section('description', 'Halaman Laporan Peminjaman')
@section('content')
<section class="row">
  <div class="col-12">
    @include('utilities.alert')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
      </div>
      <div class="card-body">
        <form action="" method="GET">
          <div class="row">
            <div class="col-md-6">
              <div class="my-3">
                <label for="start_date">Tanggal Awal:</label>
              </div>
              <div class="input-group">
                <span class="input-group-text">
                  <div><i class="bi bi-calendar-date-fill"></i></div>
                </span>
                <input type="date" class="form-control" name="start_date" id="start_date"
                  value="{{ request('start_date') }}" placeholder="Pilih tanggal awal..">
              </div>
            </div>

            <div class="col-md-6">
              <div class="my-3">
                <label for="end_date">Tanggal Akhir</label>
              </div>
              <div class="input-group">
                <span class="input-group-text">
                  <div><i class="bi bi-calendar-date-fill"></i></div>
                </span>
                <input type="date" class="form-control" name="end_date" id="end_date" value="{{ request('end_date') }}"
                  placeholder="Pilih tanggal akhir..">
              </div>
            </div>
          </div>
          <div class="d-flex pt-3 pb-3">
            <button type="submit" class="btn btn-primary flex-fill">Cari</button>
          </div>
        </form>
        @if(request('start_date') && request('end_date') !== NULL)
        <div class="d-flex flex-row-reverse pb-3">
          <a href="{{ route('officers.borrowings-report.export', [request('start_date'), request('end_date')]) }}"
            class="btn btn-success" data-bs-toggle="tooltip" data-bs-title="Export excel">
            <i class="bi bi-file-earmark-excel-fill"></i>
          </a>
        </div>
        @endif
        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">Jam Pinjam</th>
                <th scope="col">Jam Kembali</th>
                <th scope="col">Petugas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($borrowings as $borrowing)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <th>
                  <span class="badge text-bg-primary" data-bs-toggle="tooltip" data-bs-placement="top"
                    data-bs-title="{{ $borrowing->student->identification_number ?? 'N/A' }}">
                    {{ $borrowing->student->name ?? 'Unknown' }}
                  </span>
                </th>
                <td>{{ $borrowing->commodity->name ?? 'Unknown' }}</td>
                <td>{{ $borrowing->date }}</td>
                <td>
                  <span class="badge text-bg-secondary">
                    <i class="bi bi-clock-fill"></i>
                    {{ $borrowing->time_start }}
                  </span>
                </td>
                <td>
                  @if($borrowing->time_end === NULL)
                  <span class="badge text-bg-info" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Sedang dipinjam">
                    <i class="bi bi-clock"></i>
                  </span>
                  @else
                  <span class="badge text-bg-secondary">
                    {{ $borrowing->time_end }}
                  </span>
                  @endif
                </td>
                <td>{{ $borrowing->officer->name ?? 'Unknown' }}</td>
                <td>
                  <!-- Aksi buttons go here -->
                </td>
              </tr>
              @endforeach
            </tbody>            
          </table>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection

@push('modal')
@include('officer.borrowing.report.modal.show')
@endpush

@push('script')
@include('officer.borrowing.script')
@endpush
