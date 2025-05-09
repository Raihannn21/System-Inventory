@extends('layouts.app')

@section('title', 'Peminjaman Hari Ini')
@section('description', 'Halaman Daftar Peminjaman Hari Ini')

@section('content')
<section class="row">
  <div class="col-12">
    @include('utilities.alert')
    <div class="card">
        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Pelapor</th>
                <th scope="col">Deskripsi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($data as $cmdt)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $cmdt->reporter }}</td>
                <td>{{ $cmdt->description }}</td>
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
