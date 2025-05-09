@extends('layouts.app')

@section('title', 'Daftar Kategori Berita')
@section('description', 'Halaman daftar kategori berita')

@section('content')
<section class="row">
  <div class="col-12">
    @include('utilities.alert')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
      </div>
      <div class="card-body">
        <x-button-group-flex>

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createKategoriModal">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Kategori Berita
          </button>
        </x-button-group-flex>

        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama Kategori</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($kategoris as $kategori)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $kategori->nama }}</td>
                <td>
                  <div class="btn-group gap-1">
                    <button type="button" class="btn btn-sm btn-success editKategoriButton" data-bs-toggle="modal"
                      data-id="{{ $kategori->id }}" data-bs-target="#editKategoriModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>

                    <form action="{{ route('administrators.kategoris.destroy', $kategori) }}" method="POST">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger btn-delete"><i
                          class="bi bi-trash-fill"></i></button>
                    </form>
                  </div>
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
@include('administrator.kategori.modal.create')
@include('administrator.kategori.modal.edit')
@endpush

@push('script')
@include('administrator.kategori.script')
@endpush
