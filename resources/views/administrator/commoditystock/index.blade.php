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
                <th scope="col">Kode Barang</th>
                <th scope="col">Nama Barang</th>
                <th scope="col">Stok Barang</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($commoditystock as $cmdt)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <th scope="row"> <div class="badge text-bg-primary">{{ $cmdt->commodity_code }}</div> </th>
                <td>{{ $cmdt->name }}</td>
                <td>{{ $cmdt->quantity }}</td>
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
@include('administrator.borrowing.main.modal.show')
@endpush

@push('script')
@include('administrator.borrowing.script')
@endpush
