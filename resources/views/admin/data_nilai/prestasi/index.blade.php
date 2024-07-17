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
        <title>Data Nilai Prestasi - Aplikasi PSB</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('template/dist/css/app.css') }}" />
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <style>
            /* Menyesuaikan lebar dropdown 'Show Entries' */
            .dataTables_length {
                width: 200px; /* Sesuaikan lebar sesuai dengan kebutuhan */
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
                    <li>
                        <a href="{{ route('dashboard') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="airplay"></i> </div>
                            <div class="menu__title"> Dashboard </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('masterguru') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="user-check"></i> </div>
                            <div class="menu__title"> Master Guru </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mastersiswa') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="menu__title"> Master Siswa </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('masterpelajaran') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="book-open"></i> </div>
                            <div class="menu__title"> Master Mapel </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('masterjurusan') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="menu__title"> Master Kelas </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mastertajar') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                            <div class="menu__title"> Data Tahun Ajar </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('masterkriteria') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="list"></i> </div>
                            <div class="menu__title"> Data Kriteria </div>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;" class="menu menu--active">
                            <div class="menu__icon"> <i data-lucide="book-open"></i> </div>
                            <div class="menu__title"> Data Nilai <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="{{ route('data_nilai.rapor') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="book"></i> </div>
                                    <div class="menu__title"> Rapor </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data_nilai.presensi') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="clipboard"></i> </div>
                                    <div class="menu__title"> Presensi </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data_nilai.sikap') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="thumbs-up"></i> </div>
                                    <div class="menu__title"> Sikap Siswa </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data_nilai.prestasi') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="menu__title"> Prestasi </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data_nilai.keterlambatan') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="calendar"></i> </div>
                                    <div class="menu__title"> Keterlambatan </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data_nilai.hafalan') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="album"></i> </div>
                                    <div class="menu__title"> Hafalan Qur'an </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="menu">
                            <div class="menu__icon"> <i data-lucide="book"></i> </div>
                            <div class="menu__title"> Penilaian <i data-lucide="chevron-down" class="menu__sub-icon "></i> </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="{{ route('penilaian.nilaikeseluruhan') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="grid"></i> </div>
                                    <div class="menu__title"> Nilai Keseluruhan </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('penilaian.nilainormalisasi') }}" class="menu">
                                    <div class="menu__icon"> <i data-lucide="trello"></i> </div>
                                    <div class="menu__title"> Nilai Normalisasi </div>
                                </a>
                            </li>
                            <li>
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
                    <li>
                        <a href="{{ route('dashboard') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="airplay"></i> </div>
                            <div class="side-menu__title"> Dashboard </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('masterguru') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="user-check"></i> </div>
                            <div class="side-menu__title"> Master Guru </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mastersiswa') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="users"></i> </div>
                            <div class="side-menu__title"> Master Siswa </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('masterjurusan') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="home"></i> </div>
                            <div class="side-menu__title"> Master Kelas </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('masterpelajaran') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="book-open"></i> </div>
                            <div class="side-menu__title"> Master Mapel </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('mastertajar') }}" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                            <div class="side-menu__title"> Data Tahun Ajar </div>
                        </a>
                    </li>
                    <li>
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
                            <li>
                                <a href="{{ route('data_nilai.rapor') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="book"></i> </div>
                                    <div class="side-menu__title"> Rapor </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data_nilai.presensi') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="clipboard"></i> </div>
                                    <div class="side-menu__title"> Presensi </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data_nilai.sikap') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="thumbs-up"></i> </div>
                                    <div class="side-menu__title"> Sikap Siswa </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data_nilai.prestasi') }}" class="side-menu side-menu--active">
                                    <div class="side-menu__icon"> <i data-lucide="activity"></i> </div>
                                    <div class="side-menu__title"> Prestasi </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data_nilai.keterlambatan') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="calendar"></i> </div>
                                    <div class="side-menu__title"> Keterlambatan </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('data_nilai.hafalan') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="album"></i> </div>
                                    <div class="side-menu__title"> Hafalan Qur'an </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:;" class="side-menu">
                            <div class="side-menu__icon"> <i data-lucide="book"></i> </div>
                            <div class="side-menu__title">
                                Penilaian
                                <div class="side-menu__sub-icon "> <i data-lucide="chevron-down"></i> </div>
                            </div>
                        </a>
                        <ul class="">
                            <li>
                                <a href="{{ route('penilaian.nilaikeseluruhan') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="grid"></i> </div>
                                    <div class="side-menu__title"> Nilai Keseluruhan </div>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('penilaian.nilainormalisasi') }}" class="side-menu">
                                    <div class="side-menu__icon"> <i data-lucide="trello"></i> </div>
                                    <div class="side-menu__title"> Nilai Normalisasi </div>
                                </a>
                            </li>
                            <li>
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
                            <li class="breadcrumb-item active" aria-current="page">Data Nilai Prestasi Siswa</li>
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
                        List Data Nilai Prestasi Siswa
                    </h2>
                    {{-- <div class="w-full sm:w-10 flex mt-4 sm:mt-0">
                        <div class="dropdown ml-auto sm:ml-0">
                            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="list"></i> </span>
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
                                    <th>Keterangan Prestasi</th>
                                    <th>Nilai</th>
                                    <th>Jurusan</th>
                                    <th>Semester</th>
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
            <!-- BEGIN: Modal Detail Content -->
            <div id="header-detail-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Detail Nilai Prestasi Siswa
                            </h2>
                            <a data-tw-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                            <div class="intro-y box p-5 mt-5">
                                <div class="overflow-x-auto scrollbar-hidden">
                                    <table id="data-table-detail" class="table table-striped" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Nama Siswa</th>
                                                <th>Keterangan Prestasi</th>
                                                <th>Nilai</th>
                                                <th>Jurusan</th>
                                                <th>Semester</th>
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
            <!-- BEGIN: Modal Content Update -->
            <div id="header-update-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Form Update Data Nilai Prestasi Siswa
                            </h2>
                            <a href="javascript:;" data-tw-dismiss="modal"><i data-feather="x" class="w-8 h-8 tex-gray-500"></i></a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nama Siswa</label>
                                <input type="hidden" class="form-control update-id">
                                <select class="form-select update-nama-siswa" required>
                                    <option disabled selected> --- Pilih Nama Siswa --- </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Keterangan Prestasi</label>
                                <select class="form-select update-ket-prestasi" required>
                                    <option disabled selected> --- Pilih Nama Siswa --- </option>
                                    <option value="Tingkat Internasional Juara 1">Tingkat Internasional Juara 1</option>
                                    <option value="Tingkat Internasional Juara 2">Tingkat Internasional Juara 2</option>
                                    <option value="Tingkat Internasional Juara 3">Tingkat Internasional Juara 3</option>
                                    <option value="Tingkat Nasional Juara 1">Tingkat Nasional Juara 1</option>
                                    <option value="Tingkat Nasional Juara 2">Tingkat Nasional Juara 2</option>
                                    <option value="Tingkat Nasional Juara 3">Tingkat Nasional Juara 3</option>
                                    <option value="Tingkat Provinsi Juara 1">Tingkat Provinsi Juara 1</option>
                                    <option value="Tingkat Provinsi Juara 2">Tingkat Provinsi Juara 2</option>
                                    <option value="Tingkat Provinsi Juara 3">Tingkat Provinsi Juara 3</option>
                                    <option value="Tingkat Kabupaten/Kota Juara 1">Tingkat Kabupaten/Kota Juara 1</option>
                                    <option value="Tingkat Kabupaten/Kota Juara 2">Tingkat Kabupaten/Kota Juara 2</option>
                                    <option value="Tingkat Kabupaten/Kota Juara 3">Tingkat Kabupaten/Kota Juara 3</option>
                                    <option value="Tidak Ada">Tidak Ada</option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-1" class="form-label">Nilai</label>
                                <input type="number" class="form-control update-nilai" placeholder="Masukkan Nilai Prestasi Siswa" required readonly>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nama Jurusan</label>
                                <select class="form-select update-jurusan" required>
                                    <option disabled selected> --- Pilih Nama Jurusan --- </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nama Semester</label>
                                <select class="form-select update-semester" required>
                                    <option disabled selected> --- Pilih Nama Semester --- </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nama Tahun Ajar</label>
                                <select class="form-select update-tahun-ajar" required>
                                    <option disabled selected> --- Pilih Nama Tahun Ajar --- </option>
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
            <!-- END: Modal Content Update -->
            <!-- BEGIN: Notification Content Sukses Update Prestasi -->
            <div id="success-update-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil update data nilai prestasi!</div>
                    <div class="text-slate-500 mt-1 update-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Content Sukses Update Prestasi -->
            <!-- BEGIN: Notification Content Gagal Update Prestasi -->
            <div id="failed-update-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="x-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal update data nilai prestasi!</div>
                    <div class="text-slate-500 mt-1 update-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Content Gagal Update Prestasi -->
            <!-- BEGIN: Modal Content Delete -->
            <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="p-5 text-center">
                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i>
                                <div class="text-3x1 mt-5">Apa kamu yakin ?</div>
                                <div class="text-slate-500 mt-2">
                                    Apa kamu yakin akan menghapus data nilai prestasi ini ?
                                    <br>
                                    Data nilai prestasi yang dihapus ini, tidak bisa dikembalikan.
                                </div>
                            </div>
                            <div class="px-5 pb-8 text-center">
                                <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-24 mr-1">Batalkan</button>
                                <button type="button" class="btn btn-danger w-24 btn-iya">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Modal Content Delete -->
            <!-- BEGIN: Notification Content Sukses hapus Prestasi -->
            <div id="success-hapus-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil hapus data nilai prestasi!</div>
                    <div class="text-slate-500 mt-1 hapus-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Content Sukses hapus Prestasi -->
            <!-- BEGIN: Notification Content Gagal hapus Prestasi -->
            <div id="failed-hapus-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="x-circle"></i>
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal hapus data nilai prestasi!</div>
                    <div class="text-slate-500 mt-1 hapus-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Content Gagal Update Prestasi -->
            <!-- BEGIN: Modal Content Import-->
            <div id="header-import-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Form Import Data Nilai Prestasi Siswa
                            </h2>
                            <a data-tw-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-1" class="form-label">Unduh Template</label>
                                <br/>
                                <button type="button" class="btn btn-primary w-20 btn-unduh">Unduh</button>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                            <label for="modal-form-6" class="form-label">Pilih Tahun Ajar</label>
                                <select id="modal-form-6" class="form-select tahun-ajar">
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
            <!-- BEGIN: Notification Sukses Import Data prestasi Siswa Content -->
            <div id="success-import-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil import data prestasi siswa!</div>
                    <div class="text-slate-500 mt-1 import-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Import Data prestasi Siswa Content -->
            <!-- BEGIN: Notification Gagal Import Data prestasi Siswa Content -->
            <div id="failed-import-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="x-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal import data prestasi siswa!</div>
                    <div class="text-slate-500 mt-1 import-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Gagal Import Data prestasi Siswa Content -->
        </div>
        <!-- BEGIN: JS Assets -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.29.1/dist/feather.min.js"></script>
        <script src="{{ asset('template/dist/js/app.js') }}"></script>
        <script src="{{ asset('template/src/toastify.js') }}"></script>
        <script>
            // Cek Package Jquery
            jQuery(document).ready(function() {
                // FUngsi untuk mengatur cookie
                function getCookie(name){
                    var cookieName = name + "=";
                    var decodedCookie = decodeURIComponent(document.cookie);
                    var cookieArray = decodedCookie.split(';');

                    for(var i = 0; i < cookieArray.length; i++){
                        var cookie = cookieArray[i];
                        while (cookie.charAt(0) === ' '){
                            cookie = cookie.substring(1);
                        }
                        if (cookie.indexOf(cookieName) === 0){
                            return cookie.substring(cookieName.length, cookie.length);
                        }
                    }
                }

                var token = getCookie('token');
                
                if (token)
                {
                    // Token ada dalam cookie, lakukan tindakan yang sesuai
                    console.log('Token', token);
                } else {
                    window.location.href = "{{ route('login') }}";
                }

                // Menampilkan Token pada Profil
                var url = 'http://127.0.0.1:8000/api/dashboard/home';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {

                    jQuery('.nama-akun').text(data.name);
                    jQuery('.role-akun').text(data.role_name);
                    
                }).catch(error => {
                    console.error('Error', error);
                });

                // Datatable List Nilai Prestasi
                function loadDataTable (jurusanId = '')
                {
                    jQuery('#data-table').dataTable({
                        "processing": true,
                        "serverSide": true,
                        "destroy": true,
                        "ajax": {
                            "url": "http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/list",
                            "dataType": "json",
                            "type": "POST",
                            "headers": {
                                'Authorization': 'Bearer ' + token
                            },
                            "data": function (d) {
                                if (jurusanId === '-1'){
                                    d.jurusan_id = ' ';
                                } else {
                                    d.jurusan_id = jurusanId;
                                }
                            }
                        },
                        "columns": [
                            { data: 'id', className: 'text-center' },
                            { data: 'nama_siswa', className: 'text-center' },
                            { data: 'ket_prestasi', className: 'text-center' },
                            { data: 'nilai', className: 'text-center' },
                            { data: 'jurusan', className: 'text-center' },
                            { data: 'semester', className: 'text-center' },
                            { data: 'tahun_ajar', className: 'text-center' },
                            {
                                data: null,
                                render: function(data, type, row){
                                    // Create Action Buttons
                                    var editBtn = '<button class="btn btn-primary btn-edit" data-id="' + data.id + '" data-id_siswa_nama="' + data.id_siswa_nama + '" data-ket_prestasi="' + data.ket_prestasi + '" data-nilai="' + data.nilai + '" data-id_jurusan_nama="' + data.id_jurusan_nama + '" data-id_tajar_semester="' + data.id_tajar_semester + '" data-id_tajar_periode="' + data.id_tajar_periode + '"><i data-feather="edit" class="w-4 h-4 mr-1"></i></button>';
                                    var deleteBtn = '<button class="btn btn-danger btn-delete" data-id="' + data.id + '"><i data-feather="trash-2" class="w-4 h-4 mr-1"></i></button>';

                                    // Combine the Buttons
                                    var action = editBtn + ' || ' + deleteBtn;
                                    return action;
                                }
                            }
                        ],
                        "drawCallback": function(settings){
                            feather.replace();
                        }
                    });
                }

                // Datatable Detail List Nilai Prestasi
                // jQuery('#data-table-detail').dataTable({
                //     "processing": true,
                //     "serverSide": true,
                //     "ajax": {
                //         "url": "http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/list-detail",
                //         "dataType": "json",
                //         "type": "POST",
                //         "headers": {
                //             'Authorization': 'Bearer ' + token
                //         }
                //     },
                //     "columns": [
                //         { data: 'id', className: 'text-center'},
                //         { data: 'nama_siswa', className: 'text-center'},
                //         { data: 'ket_prestasi', className: 'text-center'},
                //         { data: 'nilai', className: 'text-center'},
                //         { data: 'jurusan', className: 'text-center'},
                //         { data: 'semester', className: 'text-center'},
                //         { data: 'tahun_ajar', className: 'text-center'},
                //     ],
                //     "drawCalllback": function(settings){
                //         feather.replace();
                //     }
                // });
            
                // Hide Element
                jQuery('.template-element').hide();
                jQuery('.btn-import').hide();

                // Show the modal
                jQuery('.modal-detail').click(function(){
                    // Show the modal
                    const el = document.querySelector("#header-detail-footer-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();
                });
                
                jQuery('.modal-import').click(function(){
                    // Show the modal
                    const el = document.querySelector("#header-import-footer-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();
                });

                // Show Element
                jQuery('.tahun-ajar').change(function(){
                    jQuery('.template-element').show();
                    jQuery('.btn-import').show();
                });
                
                // Fungsi button sortBy
                loadDataTable();
                jQuery('#search-button').on('click', function() {
                    var jurusanId = $('#select-jurusan').val();
                    loadDataTable(jurusanId);
                });
                
                // Data Support Tahun Ajar
                var url = 'http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/data-support/tajar';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {

                    var select = jQuery('.tahun-ajar');
                    var selectUpdateSemester = jQuery('.update-semester');
                    var selectUpdatePeriode = jQuery('.update-tahun-ajar');

                    // Iterasi melalui data dan membuat objek untuk setiap entri
                    jQuery.each(data, function(index, item){
                        for (let i = 0; i < item.length; i++)
                        {
                            select.append('<option value="' + item[i].id + '">' + item[i].periode + '</option>');
                            selectUpdateSemester.append('<option value="' + item[i].id + '">' + item[i].semester + '</option>');
                            selectUpdatePeriode.append('<option value="' + item[i].id + '">' + item[i].periode + '</option>');
                        }
                    });
                }).catch(error => {
                    console.error('Error:', error);
                });

                // Data support jurusan
                var url = 'http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/data-support/jurusan';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                    // Panggil element select
                    var selectJurusan = jQuery('.form-jurusan');
                    var selectUpdateNama = jQuery('.update-jurusan');

                    // Iterasi melalui data dan membuat objek untuk setiap entri
                    jQuery.each(data, function(index, item) {
                        for (let i = 0; i < item.length; i++) {
                            // Isi data dengan nilai dalam database
                            selectUpdateNama.append('<option value="' + item[i].id + '">' + item[i].name + '</option>');
                            selectJurusan.append('<option value="' + item[i].id + '">' + item[i].name + '</option>');
                        }
                    });
                }).catch(error => {
                    console.error('Error:', error);
                });

                // Data Support Siswa
                var url = 'http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/data-support/siswa';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                    // panggil element select
                    var selectUpdateNama = jQuery('.update-nama-siswa');

                    // iterasi melalui data dan membuat objek untuk setiap entri
                    jQuery.each(data, function(index, item){
                        for (let i = 0; i < item.length; i++)
                        {
                            // isi data dengan nilai dalam database
                            selectUpdateNama.append('<option value="' + item[i].id + '"> ' + item[i].name + ' </option>')
                        }
                    });
                }).catch(error => {
                    console.error('Error: ', error);
                })

                jQuery('#data-table').on('click', '.btn-edit', function(){
                    // show the modal
                    const el = document.querySelector('#header-update-footer-modal-preview');
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();

                    var id = jQuery(this).attr("data-id");
                    var id_siswa_nama = jQuery(this).attr("data-id_siswa_nama");
                    var ket_prestasi = jQuery(this).attr("data-ket_prestasi");
                    var nilai = jQuery(this).attr("data-nilai");
                    var id_jurusan_nama = jQuery(this).attr("data-id_jurusan_nama");
                    var id_tajar_semester = jQuery(this).attr("data-id_tajar_semester");
                    var id_tajar_periode = jQuery(this).attr("data-id_tajar_periode");

                    jQuery('.update-id').val(id);
                    jQuery('.update-nama-siswa').val(id_siswa_nama);
                    jQuery('.update-ket-prestasi').val(ket_prestasi);
                    jQuery('.update-nilai').val(nilai);
                    jQuery('.update-jurusan').val(id_jurusan_nama);
                    jQuery('.update-semester').val(id_tajar_semester);
                    jQuery('.update-tahun-ajar').val(id_tajar_periode);
                    
                })

                // Mendapatkan nilai otomatis berdasarkan keterangan prestasi
                jQuery('.update-ket-prestasi').change(function(){
                    var ket_prestasi = jQuery(this).val();

                    // Kirim pembaruan ke API
                    jQuery.ajax({
                        url: 'http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/get-nilai',
                        type: 'POST',
                        beforeSend: function(xhr){
                            xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                        },
                        data: {
                            ket_prestasi: ket_prestasi,
                        },
                        success: function(response){
                            jQuery('.update-nilai').val(response.nilai);
                        },
                        error: function(xhr, status, error){
                            console.error('Gagal mendapatkan nilai otomatis', error);
                        }
                    });
                })
                
                jQuery('.btn-update').click(function(){
                    // ajax update
                    var id = jQuery('.update-id').val();
                    var nama_siswa_id = jQuery('.update-nama-siswa').val();
                    var ket_prestasi = jQuery('.update-ket-prestasi').val();
                    var nilai = jQuery('.update-nilai').val();
                    var nama_jurusan_id = jQuery('.update-jurusan').val();
                    var semester_tajar_id = jQuery('.update-semester').val();
                    var periode_tajar_id = jQuery('.update-tahun-ajar').val();

                    // kirim ppermintaan pembaruan produk ke API
                    jQuery.ajax({
                        url: 'http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/update-data/' + id,
                        type: 'PUT',
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                        },
                        data: {
                            siswa_id : nama_siswa_id,
                            ket_prestasi : ket_prestasi,
                            nilai : nilai,
                            jurusan_id : nama_jurusan_id,
                            tajar_id : semester_tajar_id,
                            tajar_id : periode_tajar_id,
                        },
                        success: function(response){
                            // show the modal
                            jQuery('.update-sukses').text(response.message);
                            Toastify({
                                node: $("#success-update-notification-content")
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
                        error: function(xhr, response, error){
                            // show the modal
                            jQuery('.update-gagal').text(response.message);
                            Toastify({
                                node: $("#failed-update-notification-content")
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
                })
                
                // Button Unduh Template
                jQuery('.btn-unduh').click(function(){
                    // Akses URL Export Data
                    var linkto = 'http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/export-data/download-template';
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
                            var filename = (matches != null && matches[1] ? matches[1] : 'Template-Prestasi-Siswa.xlsx');

                            // The actual download
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

                // Button Import
                jQuery('.btn-import').click(function() {
                    // Get Form Data
                    var inp = jQuery('#fileInput1')[0];
                    var foto = inp.files[0];
                    var selectedTahunAjar = jQuery('#modal-form-6').val();

                    var formData = new FormData();
                    formData.append('excel', foto);
                    formData.append('selected_tahun_ajar', selectedTahunAjar);

                    // Kirim permintaan pembaruan produk ke API
                    jQuery.ajax({
                        url: 'http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/import-data/import-xls',
                        type: 'POST',
                        headers: {
                            "Authorization": "Bearer " + token
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response){
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
                            }, 3000); // 4000 milli secods = 3 secods
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
                                location.reload();
                            }, 5000);
                        }
                    });
                });

                // Fungsi button delete
                jQuery('#data-table').on('click', '.btn-delete', function(){
                    var id = jQuery(this).attr("data-id");

                    // show the modal
                    const el = document.querySelector("#delete-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();

                    jQuery('.btn-iya').click(function(){
                        // ajax delete api
                        jQuery.ajax({
                            url: 'http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/hapus-data/' + id,
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
                            error: function(xhr, response, error) {
                                // show the modal
                                jQuery('.hapus-gagal').text(response.message);
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
                
                // Button Export
                jQuery('.btn-export').click(function() {
                    // Akses URL Export data
                    var linkto = 'http://127.0.0.1:8000/api/data-nilai/prestasi-siswa/export-data/export-xls';
                    jQuery.ajax({
                        xhrFields: {
                            responseType: 'blob',
                        },
                        headers: {
                            'Authorization': 'Bearer ' + token
                        },
                        type: 'GET',
                        url: linkto,
                        success: function(result, tahun_ajar, xhr){

                            var disposition = xhr.getResponseHeader('content-disposition');
                            var matches = /"([^"]*)"/.exec(disposition);
                            var filename = (matches != null && matches[1] ? matches[1] : 'Export-Prestasi-Siswa.xlsx');

                            // The actual download
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
                
            })
        </script>
        <!-- END: JS Assets -->
    </body>
</html>