@extends('authentication.layouts.app')

@section('title', 'Register')

@section('content')

    @include('utilities.alert')
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <h1 class="auth-title">Daftar</h1>
                    <p class="auth-subtitle mb-3">Silahkan daftarkan dirimu dibawah ini</p>

                    <form method="post" action="{{ route('register.post') }}">
                        @csrf

                        <div class="form-group position-relative has-icon-left mb-2">
                            <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror form-control-xl" placeholder="Username" value="{{ old('name') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                            @error('name')
                            <small class="btn btn-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-2">
                            <input type="text" id="identification_number" name="identification_number" class="form-control @error('identification_number') is-invalid @enderror form-control-xl" placeholder="Masukan NIM" value="{{ old('identification_number') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-card-text"></i>
                            </div>
                            @error('identification_number')
                            <small class="btn btn-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-2">
                            <input type="text" id="email" name="email" class="form-control @error('email') is-invalid @enderror form-control-xl" placeholder="Email" value="{{ old('email') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            @error('email')
                            <small class="btn btn-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group position-relative has-icon-left mb-2">
                            <select id="program_study_id" name="program_study_id" class="form-control @error('program_study_id') is-invalid @enderror form-control-xl">
                                <option value="">--Pilih Program Studi--</option>
                                @foreach($programStudies as $programStudy)
                                    <option value="{{ $programStudy->id }}" {{ old('program_study_id') == $programStudy->id ? 'selected' : '' }}>{{ $programStudy->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-book"></i>
                            </div>
                            @error('program_study_id')
                            <small class="btn btn-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group position-relative has-icon-left mb-2">
                            <select id="school_class_id" name="school_class_id" class="form-control @error('school_class_id') is-invalid @enderror form-control-xl">
                                <option value="">--Pilih Kelas--</option>
                                @foreach($schoolClasses as $schoolClass)
                                    <option value="{{ $schoolClass->id }}" {{ old('school_class_id') == $schoolClass->id ? 'selected' : '' }}>{{ $schoolClass->name }}</option>
                                @endforeach
                            </select>
                            <div class="form-control-icon">
                                <i class="bi bi-building"></i>
                            </div>
                            @error('school_class_id')
                            <small class="btn btn-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        {{-- <div class="form-group position-relative has-icon-left mb-2">
                            <input type="text" id="phone_number" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror form-control-xl" placeholder="Phone Number" value="{{ old('phone_number') }}">
                            <div class="form-control-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                            @error('phone_number')
                            <small class="btn btn-danger">{{ $message }}</small>
                            @enderror
                        </div> --}}

                        <div class="form-group position-relative has-icon-left mb-2">
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror form-control-xl" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                            <small class="btn btn-danger">{{ $message }}</small>
                            @enderror
                        </div>
                        
                        <div class="form-group position-relative has-icon-left mb-2">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-xl" placeholder="Confirm Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
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
                          
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-3">Sign Up</button>
                    </form>
                    <div class="text-center mt-3 text-lg fs-4">
                        <p class='text-gray-600'>Sudah mempunyai akun? <a href="{{ route('login') }}" class="font-bold">Masuk</a>.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <!-- Optionally, you can add content here -->
                </div>
            </div>
        </div>

    </div>
@endsection
