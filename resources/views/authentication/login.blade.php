@extends('authentication.layouts.app')

@section('title', 'Masuk')

@section('content')
<div class="row h-100">
  <div class="col-lg-5 col-12">
    <div id="auth-left">
      <h1 class="auth-title">Siintaris</h1>
      <p class="auth-subtitle mb-5">Masuk untuk melanjutkan.</p>
      @include('utilities.alert')
      <form action="{{ route('login') }}" method="POST">
        @csrf
        <div class="form-group position-relative has-icon-left mb-4">
          <input type="email" name="email" class="form-control form-control-xl" placeholder="Email"
            value="{{ old('email') }}" autofocus required />
          <div class="form-control-icon">
            <i class="bi bi-person"></i>
          </div>
          @error('email')
          <div class="d-block invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        <div class="form-group position-relative has-icon-left mb-4">
          <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" required />
          <div class="form-control-icon">
            <i class="bi bi-shield-lock"></i>
          </div>
          @error('password')
          <div class="d-block invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div>
        {{-- <div class="form-group position-relative has-icon-left mb-4">
          {!! captcha_img('math') !!}
          <input type="text" name="captcha" class="form-control form-control-xl" placeholder="Captcha" required />
          <div class="form-control-icon">
            <i class="bi bi-question-circle"></i>
          </div>
          @error('captcha')
          <div class="d-block invalid-feedback">
            {{ $message }}
          </div>
          @enderror
        </div> --}}
        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-2">Log in</button>
      </form>
      <div class="text-center mt-3 text-lg fs-4">
        <p class="text-gray-600">Mahasiswa belum punya akun? <a href="{{ route('register') }}" class="font-bold">Daftar disini</a>.</p>
      </div>
    </div>
  </div>
  <div class="col-lg-7 d-none d-lg-block">
    <div id="auth-right"></div>
  </div>
</div>
@endsection
