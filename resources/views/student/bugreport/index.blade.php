@extends('layouts.app')

@section('title', 'Bug Report')
@section('description', 'Laporkan Jika Anda Memiliki Bug Pada Sistem')

@section('content')
<section class="row">
  <div class="col-12">
    @include('utilities.alert')
    <div class="card">
      <div class="card-body">
        <form action="/student/bug-report" method="post">
            @csrf
            <div class="mb-3">
                <div class="form-group">
                    <label for="nama">Nama Kamu</label>
                    <input name="nama" id="nama" class="form-control">
                </div>
                <div class="form-group">
                    <label for="desc">Descripsi</label>
                    <textarea name="desc" id="desc" cols="30" rows="10" class="form-control"></textarea>
                </div> 
                <button class="btn btn-primary">Submit</button>
            </div>
        </form>
      </div>
  </div>
</section>
@endsection