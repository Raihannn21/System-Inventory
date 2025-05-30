@extends('layouts.app')

@section('title', 'Daftar Mahasiswa')
@section('description', 'Halaman daftar mahasiswa')

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
          <form action="{{ route('administrators.exportStudent') }}" method="GET">
              <button type="submit" class="btn btn-success">
                  <i class="bi bi-file-excel"></i>
                  Export Excel
              </button>
          </form>

          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createStudentModal">
            <i class="bi bi-plus-circle-fill"></i>
            Tambah Mahasiswa
          </button>
        </x-button-group-flex>

        <form action="" method="GET">
          <div class="accordion pb-3">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelFilter"
                  aria-expanded="true" aria-controls="panelFilter">
                  <span class="me-3"><i class="bi bi-filter"></i></span>Filter (klik atau sentuh untuk membuka/menutup
                  menu filter)
                </button>
              </h2>
              <div id="panelFilter" class="accordion-collapse collapse show">
                <div class="accordion-body">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="program_study_id" class="form-label">Program Studi:</label>
                        <select name="program_study_id" id="program_study_id" class="form-select">
                          <option value="">Pilih program studi..</option>
                          @foreach ($programStudies as $programStudy)
                          <option value="{{ $programStudy->id }}" @selected(request('program_study_id')==$programStudy->
                            id)>{{ $programStudy->name }}
                          </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="mb-3">
                        <label for="school_class_id" class="form-label">Kelas:</label>
                        <select name="school_class_id" id="school_class_id" class="form-select">
                          <option value="">Pilih kelas..</option>
                          @foreach ($schoolClasses as $schoolClass)
                          <option value="{{ $schoolClass->id }}" @selected(request('school_class_id')==$schoolClass->
                            id)>{{ $schoolClass->name }}
                          </option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                  </div>

                  <div class="d-flex pt-3 pb-3">
                    <button type="submit" class="btn btn-primary flex-fill">Cari</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>

        <div class="table-responsive">
          <table class="table datatable">
            <thead>
              <tr>
                <th scope="col">No</th>
                <th scope="col">NIM</th>
                <th scope="col">Nama</th>
                <th scope="col">Program Studi</th>
                <th scope="col">Kelas</th>
                <th scope="col">Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($students as $student)
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                  <span class="badge rounded-pill text-bg-primary">{{ $student->identification_number }}</span>
                </td>
                <td>{{ $student->name }}</td>
                <td>{{ $student->programStudy->name }}</td>
                <td>{{ $student->schoolClass->name }}</td>
                <td>
                  <div class="btn-group gap-1">
                    <button type="button" class="btn btn-sm btn-primary showStudentButton" data-bs-toggle="modal"
                      data-id="{{ $student->id }}" data-bs-target="#detailStudentModal">
                      <i class="bi bi-eye-fill"></i>
                    </button>

                    <button type="button" class="btn btn-sm btn-success editStudentButton" data-bs-toggle="modal"
                      data-id="{{ $student->id }}" data-bs-target="#editStudentModal">
                      <i class="bi bi-pencil-fill"></i>
                    </button>

                    <form action="{{ route('administrators.students.destroy', $student) }}" method="POST">
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
@include('administrator.student.modal.create')
@include('administrator.student.modal.show')
@include('administrator.student.modal.edit')
@endpush

@push('script')
@include('administrator.student.script')
@endpush
