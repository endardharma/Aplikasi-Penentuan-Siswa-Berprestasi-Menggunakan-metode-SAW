<!DOCTYPE html>
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('template/dist/images/logo.svg') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Tinker admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Tinker Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Data Nilai Presensi - Aplikasi PSB</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('template/dist/css/app.css') }}" />
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <style>
            /* Menyesuaikan lebar dropdown "Show entries" */
            .dataTables_length {
                width: 200px; /* Sesuaikan lebar sesuai kebutuhan Anda */
            }

            /* Menyesuaikan lebar opsi dropdown */
            .dataTables_length select {
                width: 30%; /* Menggunakan lebar penuh */
                box-sizing: border-box; /* Menambahkan padding dan border ke dalam lebar */
            }
        </style>
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="py-5 md:py-0 bg-black/[0.15] dark:bg-transparent">
        <!-- BEGIN: Mobile Menu -->
        <div class="mobile-menu md:hidden">
            <div class="mobile-menu-bar">
                <a href="" class="flex mr-auto">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('template/dist/images/logo.svg') }}">
                </a>
                <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="bar-chart-2" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
            </div>
            <div class="scrollable">
                <a href="javascript:;" class="mobile-menu-toggler"> <i data-lucide="x-circle" class="w-8 h-8 text-white transform -rotate-90"></i> </a>
                <ul class="scrollable__content py-2">
                    <li class="mobile-dashboard">
                        <a href="{{ route('dashboard') }}" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="airplay"></i> </div>
                            <div class="menu__title"> Dashboard </div>
                        </a>
                    </li>
                    <li class="mobile-masterguru">
                        <a href="{{ route('masterguru') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="user-check"></i> </div>
                            <div class="menu__title"> Master Guru </div>
                        </a>
                    </li>
                    <li class="mobile-mastersiswa">
                        <a href="{{ route('mastersiswa') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="menu__title"> Master Siswa </div>
                        </a>
                    </li>
                    <li class="mobile-masterkelas">
                        <a href="{{ route('masterjurusan') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="menu__title"> Master Kelas </div>
                        </a>
                    </li>
                    <li class="mobile-mastermapel">
                        <a href="{{ route('masterpelajaran') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="book-open"></i> </div>
                            <div class="menu__title"> Master Mapel </div>
                        </a>
                    </li>
                    <li class="mobile-datatajar">
                        <a href="{{ route('mastertajar') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                            <div class="menu__title"> Data Tahun Ajar </div>
                        </a>
                    </li>
                    <li class="mobile-kriteria">
                        <a href="{{ route('masterkriteria') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="list"></i> </div>
                            <div class="menu__title"> Data Kriteria </div>
                        </a>
                    </li>
                    <li class="mobile-datanilai">
                        <a href="javascript:;" class="menu">
                            <div class="menu__icon"> <i data-lucide="book-open"></i> </div>
                            <div class="menu__title"> Data Nilai <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
                        </a>
                        <ul class="">
                            <li class="mobile-rapor">
                                <a href="{{ route('data_nilai.rapor') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="book"></i> </div>
                                    <div class="menu__title"> Rapor </div>
                                </a>
                            </li>
                            <li class="mobile-presensi">
                                <a href="{{ route('data_nilai.presensi') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="clipboard"></i> </div>
                                    <div class="menu__title"> Presensi </div>
                                </a>
                            </li>
                            <li class="mobile-sikapsiswa">
                                <a href="{{ route('data_nilai.sikap') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="thumbs-up"></i> </div>
                                    <div class="menu__title"> Sikap Siswa </div>
                                </a>
                            </li>
                            <li class="mobile-prestasi">
                                <a href="{{ route('data_nilai.prestasi') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Prestasi </div>
                                </a>
                            </li>
                            <li class="mobile-keterlambatan">
                                <a href="{{ route('data_nilai.keterlambatan') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                                    <div class="menu__title"> Keterlambatan </div>
                                </a>
                            </li>
                            <li class="mobile-hafalan">
                                <a href="{{ route('data_nilai.hafalan') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="album"></i> </div>
                                    <div class="menu__title"> Hafalan Qur'an </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="mobile-penilaian">
                        <a href="javascript:;" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="book"></i> </div>
                            <div class="menu__title"> Penilaian <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
                        </a>
                        <ul class="">
                            <li class="mobile-nilaikes">
                                <a href="{{ route('penilaian.nilaikeseluruhan') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="award"></i> </div>
                                    <div class="menu__title"> Nilai Keseluruhan </div>
                                </a>
                            </li>
                            <li class="mobile-normalisasi">
                                <a href="{{ route('penilaian.nilainormalisasi') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="trello"></i> </div>
                                    <div class="menu__title"> Nilai Normalisasi </div>
                                </a>
                            </li>
                            <li class="mobile-perangkingan">
                                <a href="{{ route('penilaian.nilaiperangkingan') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="award"></i> </div>
                                    <div class="menu__title"> Perangkingan </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- END: Mobile Menu -->
        <div class="flex mt-[4.7rem] md:mt-0 overflow-hidden">
            <!-- BEGIN: Side Menu -->
            <nav class="side-nav">
                <a href="" class="intro-x flex items-center pl-5 pt-4 mt-3">
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('template/dist/images/logo.svg') }}">
                    <span class="hidden xl:block text-white text-lg ml-3"> Aplikasi PSB </span> 
                </a>
                <div class="side-nav__devider my-6"></div>
                <ul>
                    <li class="desktop-dashboard">
                        <a href="{{ route('dashboard') }}" class="side-menu ">
                            <div class="side-menu__icon"> <i data-lucide="airplay"></i> </div>
                            <div class="side-menu__title"> Dashboard </div>
                        </a>
                    </li>
                    <li class="desktop-masterguru">
                        <a href="{{ route('masterguru') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="user-check"></i> </div>
                            <div class="side-menu__title"> Master Guru </div>
                        </a>
                    </li>
                    <li class="desktop-mastersiswa">
                        <a href="{{ route('mastersiswa') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="side-menu__title"> Master Siswa </div>
                        </a>
                    </li>
                    <li class="desktop-masterkelas">
                        <a href="{{ route('masterjurusan') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="side-menu__title"> Master Kelas </div>
                        </a>
                    </li>
                    <li class="desktop-mastermapel">
                        <a href="{{ route('masterpelajaran') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="book-open"></i> </div>
                            <div class="side-menu__title"> Master Mapel </div>
                        </a>
                    </li>
                    <li class="desktop-datatajar">
                        <a href="{{ route('mastertajar') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                            <div class="side-menu__title"> Data Tahun Ajar </div>
                        </a>
                    </li>
                    <li class="desktop-kriteria">
                        <a href="{{ route('masterkriteria') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="list"></i> </div>
                            <div class="side-menu__title"> Data Kriteria </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="side-menu side-menu--active">
                            <div class="side-menu__icon"> <i data-lucide="book-open"></i> </div>
                            <div class="side-menu__title">
                                Data Nilai 
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li class="desktop-rapor">
                                <a href="{{ route('data_nilai.rapor') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="book"></i> </div>
                                    <div class="side-menu__title"> Rapor </div>
                                </a>
                            </li>
                            <li class="desktop-presensi">
                                <a href="{{ route('data_nilai.presensi') }}" class="side-menu side-menu--active">
                                    <div class="side-menu__icon"> <i data-lucide="clipboard"></i> </div>
                                    <div class="side-menu__title"> Presensi </div>
                                </a>
                            </li>
                            <li class="desktop-sikapsiswa">
                                <a href="{{ route('data_nilai.sikap') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="thumbs-up"></i> </div>
                                    <div class="side-menu__title"> Sikap Siswa </div>
                                </a>
                            </li>
                            <li class="desktop-prestasi">
                                <a href="{{ route('data_nilai.prestasi') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="side-menu__title"> Prestasi </div>
                                </a>
                            </li>
                            <li class="desktop-keterlambatan">
                                <a href="{{ route('data_nilai.keterlambatan') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                    <div class="side-menu__title"> Keterlambatan </div>
                                </a>
                            </li>
                            <li class="desktop-hafalan">
                                <a href="{{ route('data_nilai.hafalan') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="album"></i> </div>
                                    <div class="side-menu__title"> Hafalan Qur'an </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="desktop-penilaian">
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="book"></i> </div>
                            <div class="side-menu__title">
                                Penilaian
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li class="desktop-nilaikes">
                                <a href="{{ route('penilaian.nilaikeseluruhan') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="grid"></i> </div>
                                    <div class="side-menu__title"> Nilai Keseluruhan </div>
                                </a>
                            </li>
                            <li class="desktop-nilainormalisasi">
                                <a href="{{ route('penilaian.nilainormalisasi') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="trello"></i> </div>
                                    <div class="side-menu__title"> Nilai Normalisasi </div>
                                </a>
                            </li>
                            <li class="desktop-perangkingan">
                                <a href="{{ route('penilaian.nilaiperangkingan') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="award"></i> </div>
                                    <div class="side-menu__title"> Perangkingan </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </nav>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <div class="top-bar -mx-4 px-4 md:mx-0 md:px-0">
                    <!-- BEGIN: Breadcrumb -->
                    <nav aria-label="breadcrumb" class="-intro-x mr-auto hidden sm:flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Aplikasi</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Nilai Presensi Siswa</li>
                        </ol>
                    </nav>
                    <!-- END: Breadcrumb -->
                    <!-- BEGIN: Notifications -->
                    <div class="intro-x dropdown mr-auto sm:mr-6">
                        <div class="dropdown-toggle notification notification--bullet cursor-pointer" role="button" aria-expanded="false" data-tw-toggle="dropdown"> <i data-lucide="bell" class="notification__icon dark:text-slate-500"></i> </div>
                        <div class="notification-content pt-2 dropdown-menu">
                            <div class="notification-content__box dropdown-content">
                                <div class="notification-content__title">Notifications</div>
                                <div class="cursor-pointer relative flex items-center ">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('template/dist/images/profile-15.jpg') }}">
                                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Angelina Jolie</a> 
                                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">01:10 PM</div>
                                        </div>
                                        <div class="w-full truncate text-slate-500 mt-0.5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500</div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('template/dist/images/profile-10.jpg') }}">
                                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Christian Bale</a> 
                                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">01:10 PM</div>
                                        </div>
                                        <div class="w-full truncate text-slate-500 mt-0.5">There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomi</div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('template/dist/images/profile-8.jpg') }}">
                                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Tom Cruise</a> 
                                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">05:09 AM</div>
                                        </div>
                                        <div class="w-full truncate text-slate-500 mt-0.5">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('template/dist/images/profile-11.jpg') }}">
                                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Russell Crowe</a> 
                                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">06:05 AM</div>
                                        </div>
                                        <div class="w-full truncate text-slate-500 mt-0.5">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem </div>
                                    </div>
                                </div>
                                <div class="cursor-pointer relative flex items-center mt-5">
                                    <div class="w-12 h-12 flex-none image-fit mr-1">
                                        <img alt="Midone - HTML Admin Template" class="rounded-full" src="{{ asset('template/dist/images/profile-11.jpg') }}">
                                        <div class="w-3 h-3 bg-success absolute right-0 bottom-0 rounded-full border-2 border-white dark:border-darkmode-600"></div>
                                    </div>
                                    <div class="ml-2 overflow-hidden">
                                        <div class="flex items-center">
                                            <a href="javascript:;" class="font-medium truncate mr-5">Kate Winslet</a> 
                                            <div class="text-xs text-slate-400 ml-auto whitespace-nowrap">03:20 PM</div>
                                        </div>
                                        <div class="w-full truncate text-slate-500 mt-0.5">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the 1500</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END: Notifications -->
                    <!-- BEGIN: Account Menu -->
                    <div class="intro-x dropdown w-8 h-8">
                        <div class="dropdown-toggle w-8 h-8 rounded-full overflow-hidden shadow-lg image-fit zoom-in" role="button" aria-expanded="false" data-tw-toggle="dropdown">
                            <img alt="Midone - HTML Admin Template" src="{{ asset('template/dist/images/profile-3.jpg') }}">
                        </div>
                        <div class="dropdown-menu w-56">
                            <ul class="dropdown-content bg-primary text-white">
                                <li class="p-2">
                                    <div class="font-medium nama-akun"></div>
                                    <div class="text-xs text-white/70 mt-0.5 dark:text-slate-500 role-akun"></div>
                                </li>
                                <li>
                                    <hr class="dropdown-divider border-white/[0.08]">
                                </li>
                                <li>
                                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="user" class="w-4 h-4 mr-2"></i> Profile </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="edit" class="w-4 h-4 mr-2"></i> Add Account </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="lock" class="w-4 h-4 mr-2"></i> Reset Password </a>
                                </li>
                                <li>
                                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="help-circle" class="w-4 h-4 mr-2"></i> Help </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider border-white/[0.08]">
                                </li>
                                <li>
                                    <a href="" class="dropdown-item hover:bg-white/5"> <i data-lucide="toggle-right" class="w-4 h-4 mr-2"></i> Logout </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END: Account Menu -->
                </div>
                <!-- END: Top Bar -->
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        List Data Nilai Presensi Siswa
                    </h2>
                    {{-- <div class="w-full sm:w-10 flex mt-4 sm:mt-0">
                        <div class="dropdown ml-auto sm:ml-0">
                            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="list"></i></span>
                            </button>
                            <div class="dropdown-menu w-40">
                                <ul class="dropdown-content">
                                    <li>
                                        <a href="#" class="dropdown-item modal-detail"> <i data-lucide="table" class="w-4 h-4 mr-2"></i> Detail Nilai </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <button class="btn btn-primary shadow-md mr-2 btn-tambah">Tambah Data</button>
                        <div class="dropdown ml-auto sm:ml-0">
                            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                            </button>
                            <div class="dropdown-menu w-40">
                                <ul class="dropdown-content">
                                    <li>
                                        <a href="#" class="dropdown-item modal-import"> <i data-lucide="file-plus" class="w-4 h-4 mr-2"></i> Import Data </a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item btn-export"> <i data-lucide="file-text" class="w-4 h-4 mr-2"></i> Export Excel </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN : SortBy Jurusan -->
                <div class="intro-y flex flex-col sm:flex-row items-center mt-1">
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <button type="submit" class="btn btn-primary shadow-md mr-2 btn-cari" id="search-button">Cari</button>
                    </div>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <label for="jurusan" class="form-label"></label>
                        <select class="form-select form-jurusan" name="jurusan" id="select-jurusan" required>
                            <option disabled selected> -- Pilih Jurusan -- </option>
                            <option value="-1">Semua Jurusan</option>
                        </select>
                    </div>
                </div>
                <!-- END : SortBy Jurusan -->
                <!-- BEGIN: HTML Table Data -->
                <div class="intro-y box p-5 mt-5">
                    <div class="overflow-x-auto scrollbar-hidden">
                        <table id="data-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Siswa</th>
                                    <th>Keterangan Ketidakhadiran</th>
                                    <th>Jumlah Hari</th>
                                    <th>Nilai</th>
                                    <th>Jurusan</th>
                                    <th>Tahun Ajar</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END: HTML Table Data -->
            </div>
            <!-- END: Content -->
            <!-- BEGIN: Modal Content -->
            <div id="header-import-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Form Import Data Nilai Ketidakhadiran Siswa
                            </h2>
                            <a href="javascript:;" data-tw-dismiss="modal"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-1" class="form-label">Unduh Template</label>
                                <br/>
                                <button type="button" class="btn btn-primary w-50 btn-unduh-mipa">Unduh MIPA</button>
                                <button type="button" class="btn btn-primary w-50 btn-unduh-iis">Unduh IIS</button>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-6" class="form-label">Pilih Jurusan</label>
                                <select id="jurusan-import" class="form-select import-jurusan">
                                    <option selected disabled> --- Pilih Jurusan Siswa --- </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-6" class="form-label">Pilih Tahun Ajar</label>
                                <select id="tajar-import" class="form-select import-tajar">
                                    <option selected disabled> --- Pilih Tahun Ajar --- </option>
                                </select>
                            </div>
                            <input type="hidden" id="selected-tahun-ajar" name="selected_tahun_ajar">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="fileInput" class="form-label">File Excel</label>
                                <input type="file" class="form-control" id="fileInput1" required>
                            </div>
                        </div>
                        <!-- END: Modal Body -->
                        <!-- BEGIN: Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Batal</button>
                            <button type="button" class="btn btn-primary w-20 btn-import">Import</button>
                        </div>
                        <!-- END: Modal Footer -->
                    </div>
                </div>
            </div>
            <!-- END: Modal Content -->
            <!-- BEGIN: Modal Detail Content -->
            <div id="header-detail-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Detail Nilai Presensi Siswa
                            </h2>
                            <a href="javascript:;" data-tw-dismiss="modal"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="intro-y box p-5 mt-5">
                            <div class="overflow-x-auto scrollbar-hidden">
                                <table id="data-table-detail" class="table table-striped" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nama Siswa</th>
                                            <th>Jurusan</th>
                                            <th>Tahun Ajar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- END: Modal Body -->
                    </div>
                </div>
            </div>
            <!-- END: Modal Detail Content -->
            <!-- BEGIN: Notification Sukses Import Data Ketidakhadiran Siswa -->
            <div id="success-import-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil import data ketidakhadiran siswa!</div>
                    <div class="text-slate-500 mt-1 import-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Import Data Ketidakhadiran Siswa -->
            <!-- BEGIN: Notification Gagal Import Data Ketidakhadiran Siswa -->
            <div id="failed-import-notification-content" class="toastify-content hidden flex">
                <i class="text-danger" data-lucide="x-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal import data ketidakhadiran siswa!</div>
                    <div class="text-slate-500 mt-1 import-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Gagal Import Data Ketidakhadiran Siswa -->
            <!-- BEGIN: Modal Tambah Data Content -->
            <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">Form Tambah Data Presensi</h2>
                            <a href="javascript:;" data-tw-dismiss="modal"><i data-feather="x" class="w-8 h-8 text-gray-500"></i></a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nama Siswa</label>
                                <input type="hidden" class="form-control">
                                <select class="form-select create-nama-siswa" required>
                                    <option disabled selected> --- Pilih Nama Siswa --- </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Keterangan Ketidakhadiran</label>
                                <select class="form-select create-ket-ketidakhadiran" required>
                                    <option disabled selected> --- Pilih Keterangan Ketidakhadiran --- </option>
                                </select>
                            </div>
                            {{-- <div class="col-span-12 sm:col-span-12 create-hari">
                                <label for="modal-form-2" class="form-label">Jumlah Hari</label>
                                <select class="form-select create-jumlah-hari" required>
                                    <option disabled selected> --- Pilih Jumlah Hari --- </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12 create-lainnya">
                                <label for="modal-form-2" class="form-label">Jumlah hari Lainnya</label>
                                <select class="form-select create-jumlah-hari-lainnya" required>
                                    <option disabled selected> --- Pilih Jumlah Hari Lainnya --- </option>
                                </select>
                            </div> --}}
                            {{-- <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nilai</label>
                                <input type="number" class="form-control create-nilai" placeholder="Masukkan Nilai Ketidakhadiran Siswa" required readonly>
                            </div> --}}
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Jurusan</label>
                                <select class="form-select create-jurusan" required>
                                    <option disabled selected> --- Pilih Jurusan --- </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Tahun Ajar</label>
                                <select class="form-select create-tahun-ajar" required>
                                    <option disabled selected> --- Pilih Tahun Ajar --- </option>
                                </select>
                            </div>
                        </div>
                        <!-- END: Modal Body -->
                        <!-- BEGIN: Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Batalkan</button>
                            <button type="button" class="btn btn-primary w-20 btn-simpan">Simpan</button>
                        </div>
                        <!-- END: Modal Footer -->
                    </div>
                </div>
            </div>
            <!-- END: Modal Tambah Data Content -->
            <!-- BEGIN: Notification Sukses Create Presensi Content -->
            <div id="success-create-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil menambahkan data presensi siswa!</div>
                    <div class="text-slate-500 mt-1 create-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Create Presensi Content -->
            <!-- BEGIN: Notification gagal Create Presensi Content -->
            <div id="failed-create-notification-content" class="toastify-content hidden flex">
                <i class="text-danger" data-lucide="x-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal menambahkan data presensi siswa!</div>
                    <div class="text-slate-500 mt-1 create-gagal"></div>
                </div>
            </div>
            <!-- END: Notification gagal Create Presensi Content -->
            <!-- BEGIN: Modal Content Update -->
            <div id="header-update-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Form Update Data Nilai Presensi Siswa
                            </h2>
                            <a href="javascript:;" data-tw-dismiss="modal"><i data-feather="x" class="w-8 h-8 text-gray-500"></i></a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nama Siswa</label>
                                <input type="hidden" class="form-control update-id">
                                <select class="form-select update-nama-siswa" required>
                                    <option disabled selected> --- Pilih Nama Siswa ---</option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Keterangan Ketidakhadiran</label>
                                <select class="form-select update-ket-ketidakhadiran" required>
                                    <option disabled selected> --- Pilih Keterangan Ketidakhadiran --- </option>
                                </select>
                            </div>
                            {{-- <div class="col-span-12 sm:col-span-12 update-hari">
                                <label for="modal-form-2" class="form-label">Jumlah Hari</label>
                                <select class="form-select update-jumlah-hari" required> 
                                    <option disabled selected> -- Pilih Jumlah Hari -- </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12 update-lainnya">
                                <label for="modal-form-2" class="form-label">Jumlah Hari Lainnya</label>
                                <select class="form-select update-jumlah-hari-lainnya" required>
                                    <option disabled selected> --- Pilih Jumlah Hari Lainnya --- </option>
                                </select>
                            </div> --}}
                            {{-- <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nilai</label>
                                <input type="number" class="form-control update-nilai" placeholder="Masukkan Nilai Ketidakhadiran Siswa" required readonly>
                            </div> --}}
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Jurusan</label>
                                <select class="form-select update-jurusan" required>
                                    <option disabled selected> --- Pilih Jurusan ---</option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Tahun Ajar</label>
                                <select class="form-select update-tahun-ajar" required>
                                    <option disabled selected> --- Pilih Tahun Ajar ---</option>
                                </select>
                            </div>
                        </div>
                        <!-- END: Modal Body -->
                        <!-- BEGIN: Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Batalkan</button>
                            <button type="button" class="btn btn-primary w-20 btn-update">Update</button>
                        </div>
                        <!-- END: Modal Footer -->
                    </div>
                </div>
            </div>
            <!-- END: END Modal Content Update -->
            <!-- BEGIN: Notification Sukses Update Presensi Content -->
            <div id="success-update-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil update data presensi siswa!</div>
                    <div class="text-slate-500 mt-1 update-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Update Presensi Content -->
            <!-- BEGIN: Notification Gaga Update Presensi Content -->
            <div id="failed-update-notification-content" class="toastify-content hidden flex">
                <i class="text-danger" data-lucide="check-circle"></i>
                <div class="font-medium">Gagal update data presensi siswa!</div>
                <div class="text-slate-500 mt-1 update-gagal"></div>
            </div>
            <!-- END: Notification Gaga Update Presensi Content -->
            <!-- BEGIN: Modal Delete Content -->
            <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="p-5 text-center">
                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                <div class="text-3xl mt-5">Apa kamu yakin ?</div>
                                <div class="text-slate-500 mt-2">
                                    Apa kamu yakin akan menghapus data presensi siswa ini ?
                                    <br>
                                    Data presensi siswa yang dihapus ini, tidak bisa dikembalikan.
                                </div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Batal</button>
                                <button type="button" class="btn btn-danger w-24 btn-iya">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Modal Delete Content -->
            <!-- BEGIN: Notification Sukses Hapus Data Presensi Content -->
            <div id="success-hapus-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil hapus data presensi siswa!</div>
                    <div class="text-slate-500 mt-1 hapus-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Hapus Data Presensi Content -->
            <!-- BEGIN: Notification Gagal Hapus Data Presensi Content -->
            <div id="failed-hapus-notification-content" class="toastify-content hidden flex">
                <i class="text-danger" data-lucide="x-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal hapus data presensi siswa!</div>
                    <div class="text-slate-500 mt-1 hapus-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Gagal Hapus Data Presensi Content -->
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.29.1/dist/feather.min.js"></script>
        <script src="{{ asset('template/dist/js/app.js') }}"></script>
        <script src="{{ asset('template/src/toastify.js') }}"></script>
        <script>
            // cek package jquery
            jQuery(document).ready(function(){
                // Fungsi untuk mendapatkan nilai cookie
                function getCookie(name){
                    var cookieName = name + "=";
                    var decodedCookie = decodeURIComponent(document.cookie);
                    var cookieArray = decodedCookie.split(';');

                    for (var i = 0; i < cookieArray.length; i++) {
                        var cookie = cookieArray[i];
                        while (cookie.charAt(0) === ' ') {
                            cookie = cookie.substring(1);
                        }
                        if (cookie.indexOf(cookieName) === 0) {
                            return cookie.substring(cookieName.length, cookie.length);
                        }
                    }
                }

                var token = getCookie('token');

                if(token) {
                    // token ada dalam cookie, lakukan tindakan yang sesuai
                    console.log('Token:', token);
                }else{
                    window.location.href = "{{ route('login') }}";
                }

                var url = 'http://127.0.0.1:8000/api/dashboard/home';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                    // Pisahkan role sesuai user_id
                    if(data.role_id == 2)
                    {
                        // Desktop
                        jQuery('.desktop-presensi').show();
                        jQuery('.desktop-keterlambatan').show();
                        
                        jQuery('.desktop-admin').hide();
                        jQuery('.desktop-masterguru').hide();
                        jQuery('.desktop-mastersiswa').hide();
                        jQuery('.desktop-masterkelas').hide();
                        jQuery('.desktop-mastermapel').hide();
                        jQuery('.desktop-datatajar').hide();
                        jQuery('.desktop-kriteria').hide();
                        jQuery('.desktop-rapor').hide();
                        jQuery('.desktop-sikapsiswa').hide();
                        jQuery('.desktop-prestasi').hide();
                        jQuery('.desktop-hafalan').hide();
                        jQuery('.desktop-penilaian').hide();
                        jQuery('.desktop-nilaikes').hide();
                        jQuery('.desktop-nilainormalisasi').hide();
                        jQuery('.desktop-perangkingan').hide();

                        // Desktop
                        jQuery('.mobile-presensi').show();
                        jQuery('.mobile-keterlambatan').show();
                        
                        jQuery('.mobile-admin').hide();
                        jQuery('.mobile-masterguru').hide();
                        jQuery('.mobile-mastersiswa').hide();
                        jQuery('.mobile-masterkelas').hide();
                        jQuery('.mobile-mastermapel').hide();
                        jQuery('.mobile-datatajar').hide();
                        jQuery('.mobile-kriteria').hide();
                        jQuery('.mobile-rapor').hide();
                        jQuery('.mobile-sikapsiswa').hide();
                        jQuery('.mobile-prestasi').hide();
                        jQuery('.mobile-hafalan').hide();
                        jQuery('.mobile-penilaian').hide();
                        jQuery('.mobile-nilaikes').hide();
                        jQuery('.mobile-nilainormalisasi').hide();
                        jQuery('.mobile-perangkingan').hide();
                        
                    }else if(data.role_id == 3) {
                        // Desktop
                        jQuery('.desktop-presensi').hide();
                        jQuery('.desktop-keterlambatan').hide();
                        jQuery('.desktop-admin').hide();
                        jQuery('.desktop-masterguru').hide();
                        jQuery('.desktop-mastersiswa').hide();
                        jQuery('.desktop-masterkelas').hide();
                        jQuery('.desktop-mastermapel').hide();
                        jQuery('.desktop-datatajar').hide();

                        jQuery('.desktop-kriteria').show();

                        jQuery('.desktop-rapor').hide();
                        jQuery('.desktop-sikap').hide();
                        jQuery('.desktop-prestasi').hide();
                        jQuery('.desktop-hafalan').hide();

                        jQuery('.desktop-nilaikes').show();
                        jQuery('.desktop-nilainormalisasi').show();
                        jQuery('.desktop-perangkingan').show();

                        // Mobile
                        jQuery('.mobile-presensi').hide();
                        jQuery('.mobile-keterlambatan').hide();
                        jQuery('.mobile-admin').hide();
                        jQuery('.mobile-masterguru').hide();
                        jQuery('.mobile-mastersiswa').hide();
                        jQuery('.mobile-masterkelas').hide();
                        jQuery('.mobile-mastermapel').hide();
                        jQuery('.mobile-datatajar').hide();

                        jQuery('.mobile-kriteria').show();

                        jQuery('.mobile-rapor').hide();
                        jQuery('.mobile-sikap').hide();
                        jQuery('.mobile-prestasi').hide();
                        jQuery('.mobile-hafalan').hide();

                        jQuery('.mobile-nilaikes').show();
                        jQuery('.mobile-nilainormalisasi').show();
                        jQuery('.mobile-perangkingan').show();
                    }else if(data.role_id == 4) {
                        // Desktop
                        jQuery('.desktop-presensi').hide();
                        jQuery('.desktop-keterlambatan').hide();
                        jQuery('.desktop-admin').hide();
                        jQuery('.desktop-masterguru').hide();
                        jQuery('.desktop-mastersiswa').hide();
                        jQuery('.desktop-masterkelas').hide();

                        jQuery('.desktop-mastermapel').show();
                        
                        jQuery('.desktop-datatajar').hide();
                        jQuery('.desktop-kriteria').hide();
                        jQuery('.desktop-rapor').hide();
                        jQuery('.desktop-sikap').hide();
                        jQuery('.desktop-prestasi').hide();
                        jQuery('.desktop-hafalan').hide();

                        jQuery('.desktop-nilaikes').show();
                        jQuery('.desktop-nilainormalisasi').show();
                        jQuery('.desktop-perangkingan').show();

                        // Mobile
                        jQuery('.mobile-presensi').hide();
                        jQuery('.mobile-keterlambatan').hide();
                        jQuery('.mobile-admin').hide();
                        jQuery('.mobile-masterguru').hide();
                        jQuery('.mobile-mastersiswa').hide();
                        jQuery('.mobile-masterkelas').hide();

                        jQuery('.mobile-mastermapel').show();
                        
                        jQuery('.mobile-datatajar').hide();
                        jQuery('.mobile-kriteria').hide();
                        jQuery('.mobile-rapor').hide();
                        jQuery('.mobile-sikap').hide();
                        jQuery('.mobile-prestasi').hide();
                        jQuery('.mobile-hafalan').hide();

                        jQuery('.mobile-nilaikes').show();
                        jQuery('.mobile-nilainormalisasi').show();
                        jQuery('.mobile-perangkingan').show();
                    }else if(data.role_id == 5){
                        // Desktop
                        jQuery('.desktop-presensi').hide();
                        jQuery('.desktop-keterlambatan').hide();
                        jQuery('.desktop-admin').hide();

                        jQuery('.desktop-masterguru').show();
                        jQuery('.desktop-mastersiswa').show();

                        jQuery('.desktop-masterkelas').hide();
                        jQuery('.desktop-mastermapel').hide();
                        jQuery('.desktop-datatajar').hide();
                        jQuery('.desktop-kriteria').hide();
                        jQuery('.desktop-rapor').hide();
                        jQuery('.desktop-sikap').hide();

                        jQuery('.desktop-prestasi').show();

                        jQuery('.desktop-hafalan').hide();
                        jQuery('.desktop-nilaikes').hide();
                        jQuery('.desktop-nilainormalisasi').hide();
                        jQuery('.desktop-perangkingan').hide();

                        // Mobile
                        jQuery('.desktop-presensi').hide();
                        jQuery('.desktop-keterlambatan').hide();
                        jQuery('.desktop-admin').hide();

                        jQuery('.desktop-masterguru').show();
                        jQuery('.desktop-mastersiswa').show();

                        jQuery('.desktop-masterkelas').hide();
                        jQuery('.desktop-mastermapel').hide();
                        jQuery('.desktop-datatajar').hide();
                        jQuery('.desktop-kriteria').hide();
                        jQuery('.desktop-rapor').hide();
                        jQuery('.desktop-sikap').hide();

                        jQuery('.desktop-prestasi').show();

                        jQuery('.desktop-hafalan').hide();
                        jQuery('.desktop-nilaikes').hide();
                        jQuery('.desktop-nilainormalisasi').hide();
                        jQuery('.desktop-perangkingan').hide();

                    }else if(data.role_id == 6){
                        // Desktop
                        jQuery('.desktop-presensi').hide();
                        jQuery('.desktop-keterlambatan').hide();
                        jQuery('.desktop-admin').hide();
                        jQuery('.desktop-masterguru').hide();
                        jQuery('.desktop-mastersiswa').hide();
                        jQuery('.desktop-masterkelas').hide();
                        jQuery('.desktop-mastermapel').hide();
                        jQuery('.desktop-datatajar').hide();
                        jQuery('.desktop-kriteria').hide();
                        jQuery('.desktop-rapor').hide();
                        jQuery('.desktop-sikap').hide();
                        jQuery('.desktop-prestasi').hide();
                        
                        jQuery('.desktop-hafalan').show();

                        jQuery('.desktop-nilaikes').hide();
                        jQuery('.desktop-nilainormalisasi').hide();
                        jQuery('.desktop-perangkingan').hide();

                        // Mobile
                        jQuery('.mobile-presensi').hide();
                        jQuery('.mobile-keterlambatan').hide();
                        jQuery('.mobile-admin').hide();
                        jQuery('.mobile-masterguru').hide();
                        jQuery('.mobile-mastersiswa').hide();
                        jQuery('.mobile-masterkelas').hide();
                        jQuery('.mobile-mastermapel').hide();
                        jQuery('.mobile-datatajar').hide();
                        jQuery('.mobile-kriteria').hide();
                        jQuery('.mobile-rapor').hide();
                        jQuery('.mobile-sikap').hide();
                        jQuery('.mobile-prestasi').hide();
                        
                        jQuery('.mobile-hafalan').show();
                        
                        jQuery('.mobile-nilaikes').hide();
                        jQuery('.mobile-nilainormalisasi').hide();
                        jQuery('.mobile-perangkingan').hide();
                    }else if(data.role_id == 7){
                        // Desktop
                        jQuery('.desktop-presensi').hide();
                        jQuery('.desktop-keterlambatan').hide();
                        jQuery('.desktop-admin').hide();
                        jQuery('.desktop-masterguru').hide();
                        jQuery('.desktop-mastersiswa').hide();
                        jQuery('.desktop-masterkelas').hide();
                        jQuery('.desktop-mastermapel').hide();
                        jQuery('.desktop-datatajar').hide();
                        jQuery('.desktop-kriteria').hide();

                        jQuery('.desktop-rapor').show();
                        jQuery('.desktop-sikap').show();

                        jQuery('.desktop-prestasi').hide();
                        jQuery('.desktop-hafalan').hide();
                        jQuery('.desktop-nilaikes').hide();
                        jQuery('.desktop-nilainormalisasi').hide();
                        jQuery('.desktop-perangkingan').hide();

                        // Mobile
                        jQuery('.mobile-presensi').hide();
                        jQuery('.mobile-keterlambatan').hide();
                        jQuery('.mobile-admin').hide();
                        jQuery('.mobile-masterguru').hide();
                        jQuery('.mobile-mastersiswa').hide();
                        jQuery('.mobile-masterkelas').hide();
                        jQuery('.mobile-mastermapel').hide();
                        jQuery('.mobile-datatajar').hide();
                        jQuery('.mobile-kriteria').hide();

                        jQuery('.mobile-rapor').show();
                        jQuery('.mobile-sikap').show();

                        jQuery('.mobile-prestasi').hide();
                        jQuery('.mobile-hafalan').hide();
                        jQuery('.mobile-nilaikes').hide();
                        jQuery('.mobile-nilainormalisasi').hide();
                        jQuery('.mobile-perangkingan').hide();
                    } else
                    {
                        // role khusus admin / Team IT
                        // Desktop
                        jQuery('.desktop-presensi').show();
                        jQuery('.desktop-keterlambatan').show();

                        jQuery('.desktop-admin').show();
                        jQuery('.desktop-masterguru').show();
                        jQuery('.desktop-mastersiswa').show();
                        jQuery('.desktop-masterkelas').show();
                        jQuery('.desktop-mastermapel').show();
                        jQuery('.desktop-datatajar').show();
                        jQuery('.desktop-kriteria').show();
                        jQuery('.desktop-rapor').show();
                        jQuery('.desktop-sikap').show();
                        jQuery('.desktop-prestasi').show();
                        jQuery('.desktop-hafalan').show();
                        jQuery('.desktop-nilaikes').show();
                        jQuery('.desktop-nilainormalisasi').show();
                        jQuery('.desktop-perangkingan').show();

                        // Mobile
                        jQuery('.mobile-presensi').show();
                        jQuery('.mobile-keterlambatan').show();
                        jQuery('.mobile-admin').show();
                        jQuery('.mobile-masterguru').show();
                        jQuery('.mobile-mastersiswa').show();
                        jQuery('.mobile-masterkelas').show();
                        jQuery('.mobile-mastermapel').show();
                        jQuery('.mobile-datatajar').show();
                        jQuery('.mobile-kriteria').show();
                        jQuery('.mobile-rapor').show();
                        jQuery('.mobile-sikap').show();
                        jQuery('.mobile-prestasi').show();
                        jQuery('.mobile-hafalan').show();
                        jQuery('.mobile-nilaikes').show();
                        jQuery('.mobile-nilainormalisasi').show();
                        jQuery('.mobile-perangkingan').show();
                    }
                    
                    jQuery('.nama-akun').text(data.name);
                    jQuery('.role-akun').text(data.role_name);
                }).catch(error => {
                    console.error('Error:', error);
                });

                // Data support tahun ajar
                var url = 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/data-support/tajar';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {

                    var selectImportTajar = jQuery('.import-tajar');
                    var selectUpdatePeriode = jQuery('.update-tahun-ajar');
                    var selectCreatePeriode = jQuery('.create-tahun-ajar');

                    // Iterasi melalui data dan membuat objek untuk setiap entri
                    jQuery.each(data, function(index, item) {
                        for (let i = 0; i < item.length; i++) {
                            selectImportTajar.append('<option value="' + item[i].id + '">' + item[i].periode + '</option>');
                            selectUpdatePeriode.append('<option value="' + item[i].id + '">' + item[i].periode + '</option>');
                            selectCreatePeriode.append('<option value="' + item[i].id + '">' + item[i].periode + '</option>');
                        }
                    });

                }).catch(error => {
                    console.error('Error:', error);
                });

                // Data support Siswa
                var url = 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/data-support/siswa';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                    // panggil element select
                    var selectUpdateNama = jQuery('.update-nama-siswa');
                    var selectCreateNama = jQuery('.create-nama-siswa');

                    // iterasi melalui data dan membuat objek untuk setiap entri
                    jQuery.each(data, function(index, item) {
                        for (let i = 0; i < item.length; i++)
                        {
                            // isi data dengan nilai dalam database
                            selectUpdateNama.append('<option value="' + item[i].id + '">' + item[i].name + '</option>');
                            selectCreateNama.append('<option value="' + item[i].id + '">' + item[i].name + '</option>');
                        }
                    });
                }).catch(error => {
                    console.error('Error:', error);
                });

                // Data support jurusan
                var url = 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/data-support/jurusan';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                    var selectImportJurusan = jQuery('.import-jurusan');
                    var selectJurusan = jQuery('.form-jurusan');
                    var selectUpdateJurusan = jQuery('.update-jurusan');
                    var selectCreateJurusan = jQuery('.create-jurusan');

                    jQuery.each(data, function(index, item) {
                        for (let i = 0; i < item.length; i++)
                        {
                            selectImportJurusan.append('<option value="' + item[i].id + '">' + item[i].name + '</option>');
                            selectJurusan.append('<option value="' + item[i].id + '">' + item[i].name + '</option>');
                            selectUpdateJurusan.append('<option value="' + item[i].id + '">' + item[i].name + '</option>');
                            selectCreateJurusan.append('<option value="' + item[i].id + '">' + item[i].name + '</option>');
                        }
                    });
                }).catch(error => {
                    console.error('Error:', error);
                });

                // Data support nilai konversi ketidakhadiran
                var url = 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/data-support/konversi-ketidakhadiran';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                    var selectCreateKetidakhadiran = jQuery('.create-ket-ketidakhadiran');
                    var selectCreateJumlahHari = jQuery('.create-jumlah-hari');
                    var selectCreateJumlahHariLainnya = jQuery('.create-jumlah-hari-lainnya');
                    var selectCreateNilai = jQuery('.create-nilai');
                    var selectUpdateKetidakhadiran = jQuery('.update-ket-ketidakhadiran');
                    var selectUpdateJumlahHari = jQuery('.update-jumlah-hari');
                    var selectUpdateJumlahHariLainnya = jQuery('.update-jumlah-hari-lainnya');
                    var selectUpdateNilai = jQuery('.update-nilai')

                    jQuery.each(data, function(index, item) {
                        for (let i = 0; i < item.length; i++)
                        {
                            selectCreateKetidakhadiran.append('<option value="' + item[i].id + '">' + item[i].ket_ketidakhadiran + ' - ' + item[i].jumlah_hari + ' - ' + item[i].nilai_konversi + '</option>');
                            selectCreateJumlahHari.append('<option value="' + item[i].id + '">' + item[i].jumlah_hari + '</option>');
                            selectCreateJumlahHariLainnya.append('<option value="' + item[i].id + '">' + item[i].jumlah_hari_lainnya + '</option>');
                            selectUpdateKetidakhadiran.append('<option value="' + item[i].id + '">' + item[i].ket_ketidakhadiran + ' - ' + item[i].jumlah_hari + ' - ' + item[i].nilai_konversi + '</option>');
                            selectUpdateJumlahHari.append('<option value="' + item[i].id + '">' + item[i].jumlah_hari + '</option>');
                            selectUpdateJumlahHariLainnya.append('<option value="' + item[i].id + '">' + item[i].jumlah_hari_lainnya + '</option>');
                            selectCreateNilai.append('<option value="' + item[i].id + '">' + item[i].nilai + '</option>');
                            selectUpdateNilai.append('<option value="' + item[i].id + '">' + item[i].nilai + '</option>');
                        }
                    });
                }).catch(error => {
                    console.error('Error:', error);
                });
                
                // Datatable list nilai presensi siswa
                function loadDataTable (jurusanId = '')
                {
                    jQuery('#data-table').dataTable({
                        "processing": true,
                        "serverSide": true,
                        "destroy": true,
                        "ajax": {
                            "url": "http://127.0.0.1:8000/api/data-nilai/presensi-siswa/list",
                            "dataType": "json",
                            "type": "POST",
                            "headers": {
                                'Authorization': 'Bearer ' + token
                            },
                            "data": function (d) {
                                if (jurusanId === '-1')
                                {
                                    d.jurusan_id = ' ';
                                }
                                else
                                {
                                    d.jurusan_id = jurusanId;
                                }
                            }
                        },
                        "columns": [
                            { data: 'id', className: 'text-center' },
                            { data: 'nama_siswa', className: 'text-center'},
                            { data: 'ket_ketidakhadiran', className: 'text-center'},
                            { data: 'jumlah_hari', className: 'text-center'},
                            { data: 'nilai', className: 'text-center'},
                            { data: 'jurusan', className: 'text-center'},
                            { data: 'tahun_ajar', className: 'text-center'},
                            {
                                data: null,
                                render: function (data, type, row){
                                    // Create action buttons
                                    var editBtn = '<button class="btn btn-primary btn-edit" data-id="' + data.id +'" data-id_siswa_nama="' + data.id_siswa_nama + '" data-id_konversi_ketidakhadiran_keterangan="' +data.id_konversi_ketidakhadiran_keterangan +'" data-id_konversi_ketidakhadiran_jumlah_hari="' +data.id_konversi_ketidakhadiran_jumlah_hari +'" data-id_konversi_ketidakhadiran_nilai="' +data.id_konversi_ketidakhadiran_nilai +'" data-id_jurusan_nama="' +data.id_jurusan_nama + '" data-id_tajar_periode="' +data.id_tajar_periode +'"><i data-feather="edit" class="w-4 h-4 mr-1"></i></button>';
                                    var deleteBtn = '<button class="btn btn-danger btn-delete" data-id="' + data.id + '"><i data-feather="trash-2" class="w-4 h-4 mr-1"></i></button>';


                                    // Combine the buttons
                                    var actions = editBtn + ' || ' + deleteBtn;
                                    return actions;
                                }
                            }
                        ],
                        "drawCallback": function(settings) {
                            feather.replace();
                        }
                    });
                }

                // DataTable Detail List Presensi Siswa
                // jQuery('#data-table-detail').DataTable({
                //     "processing": true,
                //     "serverSide": true,
                //     "ajax": {
                //         "url": "http://127.0.0.1:8000/api/data-nilai/presensi-siswa/list-detail",
                //         "dataType": "json",
                //         "type": "POST",
                //         "headers": {
                //             'Authorization': 'Bearer ' + token
                //         }
                //     },
                //     "columns": [
                //         { data: 'id', className: 'text-center'},
                //         { data: 'nama_siswa', className: 'text-center'},
                //         // { data: 'ket_ketidakhadiran', className: 'text-center'},
                //         // { data: 'jumlah_hari', className: 'text-center'},
                //         // { data: 'jumlah_hari_lainnya', className: 'text-center'},
                //         // { data: 'nilai', className: 'text-center'},
                //         { data: 'jurusan', className: 'text-center'},
                //         { data: 'tahun_ajar', className: 'text-center'},
                //     ],
                //     "drawCallback": function(settings){
                //         feather.replace();
                //     }
                // });

                //SortBy Button
                loadDataTable();
                jQuery('#search-button').on('click', function() {
                    var jurusanId = $('#select-jurusan').val();
                    loadDataTable(jurusanId);
                });
                
                jQuery('.modal-import').click(function() {
                    // Show the modal
                    const el = document.querySelector("#header-import-footer-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();
                });

                jQuery('.modal-detail').click(function() {
                    // Show the modal
                    const el = document.querySelector("#header-detail-footer-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();
                });

                // Show Element
                jQuery('.import-tajar').change(function() {
                    jQuery('.template-element').show();
                    jQuery('.btn-import').show();
                });

                // Hide element
                jQuery('.template-element').hide();
                jQuery('.btn-import').hide();
                jQuery('.update-lainnya').hide();
                jQuery('.update-hari').hide();
                jQuery('.create-lainnya').hide();
                jQuery('.create-hari').hide();

                // Fungsi button logout
                jQuery('.btn-logout').click(function(){
                    logout(token);
                });

                jQuery('.btn-tambah').click(function() {
                    // show modal
                    const el = document.querySelector('#header-footer-modal-preview');
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();
                });

                // Fungsi Button Unduh Template Mipa
                jQuery('.btn-unduh-mipa').click(function() {
                    // Akses URL Export Data Template
                    var linkto = 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/export-data/download-template-mipa';
                    jQuery.ajax({
                        xhrFields: {
                            responseType: 'blob',
                        },
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        type:'GET',
                        url: linkto,
                        success: function(result, status, xhr) {
            
                            var disposition = xhr.getResponseHeader('content-disposition');
                            var matches = /"([^"]*)"/.exec(disposition);
                            var filename = (matches != null && matches[1] ? matches[1] : 'Template-Presensi-Siswa-Mipa.xlsx');
            
                            // The Actual Download
                            var blob = new Blob([result], {
                                type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                            });
                            var link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = filename;
            
                            document.body.appendChild(link);
            
                            link.click();
                            document.body.removeChild(link);
                        }
                    });
                });

                // Fungsi Button Unduh Template IIS
                jQuery('.btn-unduh-iis').click(function(){
                    
                    var linkto = 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/export-data/download-template-iis';
                    jQuery.ajax({
                        xhrFields: {
                            responseType: 'blob',
                        },
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        type: 'GET',
                        url: linkto,
                        success: function(result, status, xhr){

                        var disposition = xhr.getResponseHeader('content-disposition');
                        var matches = /"([^"]*)"/.exec(disposition);
                        var filename = (matches != null && matches[1] ? matches[1] : 'Template-Presensi-Siswa-Iis.xlsx');

                        // the actual download
                        var blob = new Blob([result], {
                            type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                        });

                        var link = document.createElement('a');
                        link.href = window.URL.createObjectURL(blob);
                        link.download = filename;
                        document.body.appendChild(link);

                        link.click();
                        document.body.removeChild(link);

                        }
                    });
                })
            
                jQuery('.btn-import').click(function() {
                    // Get form data
                    var inp = jQuery('#fileInput1')[0];
                    var foto = inp.files[0];
                    var selectedTahunAjar = jQuery('#tajar-import').val();
                    var selectedJurusan = jQuery('#jurusan-import').val();

                    var formData = new FormData();
                    formData.append('excel', foto);
                    formData.append('selected_tahun_ajar', selectedTahunAjar);
                    formData.append('selected_jurusan', selectedJurusan);

                    // Kirim permintaan pembaruan produk ke API
                    jQuery.ajax({
                        url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/import-data/import-xls',
                        type: 'POST',
                        headers: {
                            "Authorization": "Bearer " + token
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Show the modal
                            jQuery('.import-sukses').text(response.message);
                            Toastify({
                                node: $("#success-import-notification-content")
                                    .clone()
                                    .removeClass("hidden")[0],
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                            }).showToast();

                            setTimeout(function() {
                                location.reload();
                            }, 3000); // 3000 milliseconds = 3 seconds
                        },
                        error: function(xhr, tahun_ajar, error) {
                            // Show the modal
                            jQuery('.import-gagal').text(error);
                            Toastify({
                                node: $("#failed-import-notification-content")
                                    .clone()
                                    .removeClass("hidden")[0],
                                duration: 5000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                            }).showToast();

                            setTimeout(function() {
                                // location.reload();
                            }, 5000); // 3000 milliseconds = 3 seconds
                        }
                    }); 
                })

                // Button Simpan
                // jQuery('.btn-simpan').click(function(){
                //     // show the modal
                //     event.preventDefault(); // Prevent default form submission

                //     // Get form data
                //     var siswa_id_nama = jQuery('.create-nama-siswa').val();
                //     var id_konversi_ketidakhadiran_keterangan = jQuery('.create-ket-ketidakhadiran').val();
                //     var id_konversi_ketidakhadiran_jumlah_hari = jQuery('.create-jumlah-hari').val();
                //     var id_konversi_ketidakhadiran_nilai = jQuery('.create-nilai').val();
                //     var jurusan_id_nama = jQuery('.create-jurusan').val();
                //     var tajar_id_periode = jQuery('.create-tahun-ajar').val();

                //     // if (jumlah_hari === 'lainnya')
                //     // {
                //     //     jumlah_hari = jumlah_hari_lainnya
                //     // }

                //     var formData = new FormData();
                //     formData.append('siswa_id', siswa_id_nama);
                //     formData.append('ket_ketidakhadiran', id_konversi_ketidakhadiran_keterangan);
                //     formData.append('jumlah_hari', id_konversi_ketidakhadiran_jumlah_hari);
                //     formData.append('nilai', id_konversi_ketidakhadiran_nilai);
                //     formData.append('jurusan_id', jurusan_id_nama);
                //     formData.append('tajar_id', tajar_id_periode);

                //     // Kirim permintaan ke API
                //     jQuery.ajax({
                //         url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/tambah-data',
                //         type: 'POST',
                //         headers: {
                //             'Authorization': 'Bearer ' + token,
                //         },
                //         data: formData,
                //         processData: false,
                //         contentType: false,
                //         success: function(response){
                //             // show the modal
                //             jQuery('.create-sukses').text(response.message);
                //             Toastify({
                //                 node: $('#success-create-notification-content')
                //                     .clone()
                //                     .removeClass("hidden")[0],
                //                 duration: 3000,
                //                 newWindow: true,
                //                 close: true,
                //                 gravity: "top",
                //                 position: "right",
                //                 stopOnFocus: true,
                //             }).showToast();

                //             setTimeout(function(){
                //                 location.reload();
                //             }, 3000);
                //         },
                //         error: function(xhr, status, error) {
                //             jQuery('.create-gagal').text(error);
                //             Toastify({
                //                 node: $('#failed-create-notification-content')
                //                     .clone()
                //                     .removeClass("hidden")[0],
                //                 duration: 5000,
                //                 newWindow: true,
                //                 close: true,
                //                 gravity: "top",
                //                 position: "right",
                //                 stopOnFocus: true,
                //             }).showToast();

                //             setTimeout(function(){
                //                 // location.reload();
                //             }, 5000);
                //         }
                //     });
                // });
                
                // REVISI
                jQuery('.btn-simpan').click(function(){
                    // show the modal
                    event.preventDefault(); // Prevent default form submission

                    // Get form data
                    var siswa_id_nama = jQuery('.create-nama-siswa').val();
                    var konversi_ketidakhadiran_id_keterangan = jQuery('.create-ket-ketidakhadiran').val();
                    // var id_konversi_ketidakhadiran_nilai = jQuery('.create-nilai').val();
                    var jurusan_id_nama = jQuery('.create-jurusan').val();
                    var tajar_id_periode = jQuery('.create-tahun-ajar').val();

                    var formData = new FormData();
                    formData.append('siswa_id', siswa_id_nama);
                    formData.append('konversi_ketidakhadiran_id', konversi_ketidakhadiran_id_keterangan);
                    // formData.append('nilai', id_konversi_ketidakhadiran_nilai);
                    formData.append('jurusan_id', jurusan_id_nama);
                    formData.append('tajar_id', tajar_id_periode);

                    // Kirim permintaan ke API
                    jQuery.ajax({
                        url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/tambah-data',
                        type: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token,
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response){
                            // show the modal
                            jQuery('.create-sukses').text(response.message);
                            Toastify({
                                node: $('#success-create-notification-content')
                                    .clone()
                                    .removeClass("hidden")[0],
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                            }).showToast();

                            setTimeout(function(){
                                location.reload();
                            }, 3000);
                        },
                        error: function(xhr, status, error) {
                            jQuery('.create-gagal').text(error);
                            Toastify({
                                node: $('#failed-create-notification-content')
                                    .clone()
                                    .removeClass("hidden")[0],
                                duration: 5000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                            }).showToast();

                            setTimeout(function(){
                                // location.reload();
                            }, 5000);
                        }
                    });
                });
                
                // Proses Menampilkan Nilai Otomatis untuk ket_ketidakhadirana
                // jQuery('.create-ket-ketidakhadiran').change(function() {
                //     var id_konversi_ketidakhadiran_keterangan = jQuery(this).val();

                //     // if (id_konversi_ketidakhadiran_keterangan !== 'Tidak Ada')
                //     // {
                //     //     jQuery('.create-hari').show();
                //     // } else {
                //     //     jQuery('.create-hari').hide();
                //     //     jQuery('.create-lainnya').hide();
                //     // }
                    
                //     if (id_konversi_ketidakhadiran_keterangan === 'Tidak Ada')
                //     {
                //         jQuery.ajax({
                //             url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/get-nilai',
                //             type: 'POST',
                //             beforeSend: function(xhr){
                //                 xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                //             },
                //             data: {
                //                 id_konversi_ketidakhadiran_keterangan: id_konversi_ketidakhadiran_keterangan,
                //             },
                //             success: function(response) {
                //                 jQuery('.create-nilai').val(response.nilai);
                //             },
                //             error: function(xhr, status, error){
                //                 console.error('Gagal mendapatkan nilai otomatis', error);
                //             }
                //         });
                //     }
                // });

                // jQuery('.create-jumlah-hari').change(function() {
                //     var id_konversi_ketidakhadiran_jumlah_hari = jQuery(this).val();
                //     var id_konversi_ketidakhadiran_jumlah_hari_lainnya = jQuery(this).val();

                //     if (id_konversi_ketidakhadiran_jumlah_hari === 'Lainnya')
                //     {
                //         jQuery('.create-lainnya').show();   
                //     } else {
                //         jQuery('.create-lainnya').hide();
                //     }

                //     // Kirim request nilai ke API getNilai
                //     if (id_konversi_ketidakhadiran_jumlah_hari !== 'Lainnya')
                //     {
                //         jQuery.ajax({
                //             url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/get-nilai',
                //             type: 'POST',
                //             beforeSend: function(xhr){
                //                 xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                //             },
                //             data: {
                //                 id_konversi_ketidakhadiran_jumlah_hari: id_konversi_ketidakhadiran_jumlah_hari,
                //                 id_konversi_ketidakhadiran_jumlah_hari_lainnya: id_konversi_ketidakhadiran_jumlah_hari_lainnya,
                //             },
                //             success: function(response) {
                //                 jQuery('.create-nilai').val(response.nilai);
                //             },
                //             error: function(xhr, status, error){
                //                 console.error('Gagal mendapatkan nilai otomatis', error);
                //             }
                //         });
                //     } else {
                //         jQuery.ajax({
                //             url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/get-nilai',
                //             type: 'POST',
                //             beforeSend: function(xhr) {
                //                 xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                //             },
                //             data: {
                //                 id_konversi_ketidakhadiran_jumlah_hari: id_konversi_ketidakhadiran_jumlah_hari,
                //             },
                //             success: function(response){
                //                 jQuery('.create-nilai').val(response.nilai);
                //             },
                //             error: function(xhr, status, error){
                //                 console.error('Gagal mendapatkan nilai otomatis', error);
                //             }
                //         });
                //     }

                // });
                
                // Button Update
                jQuery('#data-table').on('click', '.btn-edit', function(){
                    // show the modal
                    const el = document.querySelector('#header-update-footer-modal-preview');
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();

                    var id = jQuery(this).attr("data-id");
                    var id_siswa_nama = jQuery(this).attr("data-id_siswa_nama");
                    var id_konversi_ketidakhadiran_keterangan = jQuery(this).attr("data-id_konversi_ketidakhadiran_keterangan");
                    var id_jurusan_nama = jQuery(this).attr("data-id_jurusan_nama");
                    var id_tajar_periode = jQuery(this).attr("data-id_tajar_periode");

                    // handle edit action
                    jQuery('.update-id').val(id);
                    jQuery('.update-nama-siswa').val(id_siswa_nama);
                    jQuery('.update-ket-ketidakhadiran').val(id_konversi_ketidakhadiran_keterangan);
                    jQuery('.update-jurusan').val(id_jurusan_nama);
                    jQuery('.update-tahun-ajar').val(id_tajar_periode);

                    // Conditional logic for hiding or showing forms
                    // if (ket_ketidakhadiran === 'Tidak Ada') 
                    // {
                    //     // hide the forms if "Tidak Ada"
                    //     jQuery('.update-hari').hide();
                    //     jQuery('.update-lainnya').hide();
                    // } else if (ket_ketidakhadiran === 'Sakit' || ket_ketidakhadiran === 'Izin' || ket_ketidakhadiran === 'Tanpa Keterangan')
                    // {
                    //     jQuery('.update-hari').show();
                    // } else {
                    //     // show the forms if it has value other than "Tidak Ada"
                    //     jQuery('.update-hari').show();
                    //     jQuery('.update-lainnya').show();
                    // }
                })

                // fungsi button update
                jQuery('.btn-update').click(function(){
                    // ajax update
                    var id = jQuery('.update-id').val();
                    var nama_siswa_id = jQuery('.update-nama-siswa').val();
                    var keterangan_konversi_ketidakhadiran_id = jQuery('.update-ket-ketidakhadiran').val();
                    var nama_jurusan_id = jQuery('.update-jurusan').val();
                    var periode_tajar_id = jQuery('.update-tahun-ajar').val();

                    // Jika opsi 'lainnya' dipilih, gunakan nilai dari form input teks tambahan
                    // if (jumlah_hari_id === 'lainnya')
                    // {
                    //     jumlah_hari_id = jumlah_hari_lainnya_id
                    // }                    
                    
                    // kirim permintaan pembaruan produk ke API
                    jQuery.ajax({
                        url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/update-data/' + id,
                        type: 'PUT',
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                        },
                        data: {
                            siswa_id: nama_siswa_id,
                            konversi_ketidakhadiran_id: keterangan_konversi_ketidakhadiran_id,
                            jurusan_id: nama_jurusan_id,
                            tajar_id: periode_tajar_id,
                        },
                        success: function(response){
                            // show the modal
                            jQuery('.update-sukses').text(response.message);
                            Toastify({
                                node: $('#success-update-notification-content')
                                    .clone()
                                    .removeClass("hidden")[0],
                                duration: 3000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                            }).showToast();

                            setTimeout(function(){
                                location.reload();
                            }, 3000);
                        },
                        error: function(xhr, status, error) {
                            jQuery('.update-gagal').text(response.message);
                            Toastify({
                                node: $('#failed-update-notification-content')
                                    .clone()
                                    .removeClass("hidden")[0],
                                duration: 5000,
                                newWindow: true,
                                close: true,
                                gravity: "top",
                                position: "right",
                                stopOnFocus: true,
                            }).showToast();

                            setTimeout(function(){
                                location.reload();
                            }, 5000);
                        }
                    });
                })

                // jQuery('.update-ket-ketidakhadiran').change(function(){
                //     var id_konversi_ketidakhadiran_keterangan = jQuery(this).val();
                    
                //     if (id_konversi_ketidakhadiran_keterangan !== 'Tidak Ada')
                //     {
                //         jQuery('.update-hari').show();
                //     } else {
                //         jQuery('.update-hari').hide();
                //         jQuery('.update-lainnya').hide();
                //     }

                //     if (id_konversi_ketidakhadiran_keterangan === 'Tidak Ada')
                //     {
                //         jQuery.ajax({
                //             url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/get-nilai',
                //             type: 'POST',
                //             beforeSend: function(xhr){
                //                 xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                //             },
                //             data: {
                //                 id_konversi_ketidakhadiran_keterangan: id_konversi_ketidakhadiran_keterangan,
                //             },
                //             success: function(response) {
                //                 jQuery('.update-nilai').val(response.nilai);
                //             },
                //             error: function(xhr, status, error){
                //                 console.error('Gagal mendapatkan nilai otomatis', error);
                //             }
                //         });
                //     }
                // });

                // jQuery('#data-table').on('click', '.btn-edit', function(){
                //     jQuery('.update-hari').show();
                //     jQuery('.update-lainnya').show();
                // })
                
                // jQuery('.update-jumlah-hari').change(function(){
                //     var id_konversi_ketidakhadiran_jumlah_hari = jQuery(this).val();
                //     var id_konversi_ketidakhadiran_jumlah_hari_lainnya = jQuery(this).val();
                //     // var previouslySelected = '';
                    
                //     if (jumlah_hari === 'Lainnya')
                //     {
                //         // Tampilkan form input nilai tambahan jika opsi >4 Hari
                //         jQuery('.update-lainnya').show();
                //     }
                //     else
                //     {
                //         // Sembunyikan form input teks tambahan
                //         jQuery('.update-lainnya').hide();
                //     }
                    
                //     if (jumlah_hari !== 'Lainnya')
                //     {
                //         jQuery.ajax({
                //             url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/get-nilai',
                //             type: 'POST',
                //             beforeSend: function(xhr){
                //                 xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                //             },
                //             data: {
                //                 id_konversi_ketidakhadiran_jumlah_hari: id_konversi_ketidakhadiran_jumlah_hari,
                //                 id_konversi_ketidakhadiran_jumlah_hari_lainnya: id_konversi_ketidakhadiran_jumlah_hari_lainnya,
                //             },
                //             success: function(response){
                //                 jQuery('.update-nilai').val(response.nilai);
                //             },
                //             error: function(xhr, status, error){
                //                 console.error('Gagal mendapatkan nilai otomatis', error);
                //             }
                //         });
                //     }
                //     else
                //     {
                //         jQuery.ajax({
                //             url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/get-nilai',
                //             type: 'POST',
                //             beforeSend: function(xhr){
                //                 xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                //             },
                //             data: {
                //                 id_konversi_ketidakhadiran_jumlah_hari: id_konversi_ketidakhadiran_jumlah_hari,
                //             },
                //             success: function(response){
                //                 jQuery('.update-nilai').val(response.nilai);
                //             },
                //             error: function(xhr, status, error){
                //                 console.error('Gagal mendapatkan nilai otomatis', error);
                //             }
                //         });

                //         // jQuery('.update-nilai').val();

                //     }
                // })

                // fungsi button delete
                jQuery('#data-table').on('click', '.btn-delete', function(){
                    var id = jQuery(this).attr("data-id");

                    // show the modal
                    const el = document.querySelector("#delete-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();

                    jQuery('.btn-iya').click(function(){
                        // ajax delete API
                        jQuery.ajax({
                            url: 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/hapus-data/' + id,
                            type: 'DELETE',
                            headers: {
                                'Authorization': 'Bearer ' + token
                            },
                            success: function(response){
                                // show the modal
                                jQuery('.hapus-sukses').text(response.message);
                                Toastify({
                                    node: $("#success-hapus-notification-content")
                                        .clone()
                                        .removeClass("hidden")[0],
                                    duration: 3000,
                                    newWindow: true,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    stopOnFocus: true,
                                }).showToast();

                                setTimeout(function(){
                                    location.reload();
                                }, 3000);
                            },
                            error: function(xhr, status, error){
                                // show the modal
                                jQuery('.hapus-gagal').text(error);
                                Toastify({
                                    node: $("#failed-hapus-notification-content")
                                        .clone()
                                        .removeClass("hidden")[0],
                                    duration: 5000,
                                    newWindow: true,
                                    close: true,
                                    gravity: "top",
                                    position: "right",
                                    stopOnFocus: true,
                                }).showToast();

                                setTimeout(function(){
                                    // location.reload();
                                }, 5000);
                            }
                        })
                    })
                })
                
                jQuery('.btn-export').click(function() {
                    // Akses URL Export Data
                    var linkto = 'http://127.0.0.1:8000/api/data-nilai/presensi-siswa/export-data/export-xls';
                    jQuery.ajax({
                        xhrFields: {
                            responseType: 'blob',
                        },
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        type: 'GET',
                        url: linkto,
                        success: function(result, status, xhr) {
                            var disposition = xhr.getResponseHeader('content-disposition');
                            var matches = /"([^"]*)"/.exec(disposition);
                            var filename = (matches != null && matches[1] ? matches[1] : 'Export-Presensi-Siswa.xlsx');

                            // The actual download
                            var blob = new Blob([result], {
                                type: 'application/vnbm.openxmlformats-officedocument.spreadsheetml.sheet'
                            });
                            var link = document.createElement('a');
                            link.href = window.URL.createObjectURL(blob);
                            link.download = filename;

                            document.body.appendChild(link);

                            link.click();
                            document.body.removeChild(link);
                        }
                    });
                })

                function logout(name) {
                    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    window.location.href = "{{ route('login') }}";
                }
            });
        </script>
        <!-- END: JS Assets -->
    </body>
</html>