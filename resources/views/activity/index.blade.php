@extends('layouts.app')

@section('title', 'Daftar Aktivitas')
@section('description', 'Halaman daftar aktivitas')

@section('content')
<section class="row">
  <div class="col-12">
    @include('utilities.alert')
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">@yield('title')</h4>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Nama</th>
                <th scope="col">Aktivtas</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Waktu</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($activitys as $act)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $act->name }}</td>
                <td>{{ $act->activity }}</td>
                <td>{{ $act->description }}</td>
                <td>{{ $act->created_at }}</td>
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
@include('administrator.school_class.modal.create')
@include('administrator.school_class.modal.edit')
@include('administrator.school_class.modal.import')
@endpush

@push('script')
@include('administrator.school_class.script')
@endpush
