@extends('authentication.layouts.app')

@section('title', 'Verifikasi Email')

@section('content')
<div class="row h-100">
  <div class="col-lg-5 col-12">
    <div id="auth-left">
      <h1 class="auth-title">Verifikasi Email</h1>
      <p class="auth-subtitle mb-5">Silakan verifikasi email Anda untuk melanjutkan.</p>
      @include('utilities.alert')
      <div class="mb-4">
        @if (session('resent'))
        <div class="alert alert-success" role="alert">
          Email verifikasi baru telah dikirim ke alamat email Anda.
        </div>
        @endif
        Sebelum melanjutkan, periksa email Anda untuk tautan verifikasi. Jika Anda tidak menerima email,
        <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
          @csrf
          <button type="submit" class="btn btn-link p-0 m-0 align-baseline">klik di sini untuk meminta yang lain</button>.
        </form>
      </div>
    </div>
  </div>
  <div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right"></div>
  </div>
</div>
@endsection
