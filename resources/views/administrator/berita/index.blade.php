@extends('layouts.app')

@section('title', 'Daftar Berita')
@section('description', 'Halaman daftar berita')

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

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createBeritaModal">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Berita
          </button>
        </x-button-group-flex>

        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Judul</th>
                <th scope="col">Isi</th>
                <th scope="col">Penulis</th>
                <th scope="col">Kategori</th>
                <th scope="col">Gambar</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($beritas as $berita)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $berita->judul }}</td>
                <td>{{ Str::limit($berita->isi, 50) }}</td>
                <td>{{ $berita->penulis }}</td>
                <td>{{ $berita->kategori ? $berita->kategori->nama : 'Tidak ada kategori' }}</td>
                <td>
                  @if($berita->gambar)
                  <img src="{{ Storage::url($berita->gambar) }}" alt="Gambar Berita" width="50">
                  @else
                  Tidak ada gambar
                  @endif
                </td>
                <td>
                  <div class="btn-group gap-1">
                    <button type="button" class="btn btn-sm btn-success editBeritaButton" data-bs-toggle="modal"
                      data-id="{{ $berita->id }}" data-bs-target="#editBeritaModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>

                    <form action="{{ route('administrators.beritas.destroy', $berita) }}" method="POST">
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
@include('administrator.berita.modal.create')
@include('administrator.berita.modal.edit')
@endpush

@push('script')
@include('administrator.berita.script')
@endpush

