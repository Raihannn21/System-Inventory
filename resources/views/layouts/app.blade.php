<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title') - {{ config('app.name') }}</title>
    <link rel="stylesheet" href="{{ asset('css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/main/app-dark.css') }}" />
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.svg') }}" type="image/x-icon" />
    <link rel="shortcut icon" href="{{ asset('images/logo/favicon.png') }}" type="image/png" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <link rel="stylesheet" href="{{ asset('css/shared/iconly.css') }}" />
    @vite([])

    <style>
        .header {
            display: flex;
            justify-content: right;
            align-items: center;
        }

        .header-right {
            display: flex;
            align-items: center;
        }

        .dropdown {
            position: relative;
            display: inline-block;
        }

        .dropbtn {
            background-color: #3f5491;
            color: white;
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .dropbtn .avatar {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .dropbtn span {
            margin-right: 5px;
        }

        .dropdown-content {
            display: none;
            position: absolute;
            right: 0;
            min-width: 200px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border-radius: 5px;
            overflow: hidden;
        }

        .dropdown-content .dropdown-item {
            color: #333;
            padding: 12px 16px;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .dropdown-content .dropdown-item i {
            margin-right: 10px;
        }

        .dropdown-content .dropdown-item:hover {
            background-color: #f1f1f1;
        }

        .dropdown:hover .dropdown-content {
            display: block;
        }
    </style>
</head>

<body>
    <script src="{{ asset('js/initTheme.js') }}"></script>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header position-relative">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="logo">
                            <a href="" >
                                <img src="{{ asset('images/logo/2.png') }}" alt="Logo Image" style="max-width: 200px; height: auto;">
                            </a>
                        </div>
                        
                    </div>
                </div>
                @auth('administrator')
                    @include('layouts.administrator.sidebar')
                @endauth

                @auth('officer')
                    @include('layouts.officer.sidebar')
                @endauth

                @auth('student')
                    @include('layouts.student.sidebar')
                @endauth
            </div>
        </div>
        <div id="main">
            <header class="mb-3 header">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
                {{-- @dd(auth()->user()) --}}
                <div class="header-right">
                    <div class="dropdown">
                        <button class="dropbtn">
                            <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=4e73df&color=ffffff&size=100" alt="User Avatar" class="avatar">
                            <span>{{ Auth::user()->name }}</span>
                            <i class="bi bi-caret-down-fill"></i>
                        </button>
                        <!-- resources/views/layouts/app.blade.php -->

<div class="dropdown-content">

  @auth('officer')
      <a href="{{ route('officers.profile-settings.index') }}" class="dropdown-item">
          <i class="bi bi-gear-fill"></i> Pengaturan Profil
      </a>
  @endauth

  @auth('student')
      <a href="{{ route('students.profile-settings.index') }}" class="dropdown-item">
          <i class="bi bi-gear-fill"></i> Pengaturan Profil
      </a>
  @endauth

  <form action="{{ route('logout') }}" method="POST" id="logout-form">
      @csrf
      <button type="submit" class="dropdown-item">
          <i class="bi bi-box-arrow-right"></i> Keluar
      </button>
  </form>
</div>

                    </div>
                </div>
            </header>

            <div class="page-heading">
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>@yield('title', 'Default title')</h3>
                            <p class="text-subtitle text-muted">@yield('description', 'Default description')</p>
                        </div>
                    </div>
                </div>
                @yield('content')
            </div>
        </div>
    </div>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    @stack('modal')
    @stack('script')

    <script>
        $(function() {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));

            $('.datatable').DataTable({
                pageLength: 5,
                lengthMenu: [
                    [5, 10, 15, 20, 25, 50, -1],
                    [5, 10, 15, 20, 25, 50, "All"]
                ],
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.3/i18n/id.json',
                },
            });

            $('input[type=date]').flatpickr({
                allowInput: true,
            });

            $('.btn-delete').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Yakin?',
                    text: "Data tersebut akan dihapus",
                    icon: 'warning',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().submit();
                    }
                });
            });

            $('.btn-returned').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Kembalikan?',
                    text: "Status peminjaman tersebut akan berubah menjadi sudah kembali",
                    icon: 'warning',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().parent().submit();
                    }
                });
            });

            $('.btn-validate').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Validasi?',
                    text: "Status validasi peminjaman tersebut akan terisi Anda",
                    icon: 'warning',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().submit();
                    }
                });
            });

            $('#logout').click(function(e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Keluar?',
                    text: "Anda akan keluar dari aplikasi",
                    icon: 'warning',
                    showCancelButton: true,
                    reverseButtons: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya!',
                    cancelButtonText: 'Tidak',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent().submit();
                    }
                });
            });
        });
    </script>
</body>
</html>
