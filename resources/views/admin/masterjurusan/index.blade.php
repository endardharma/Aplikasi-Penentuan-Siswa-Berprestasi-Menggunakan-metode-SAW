<!DOCTYPE html>
<!--
Template Name: Tinker - HTML Admin Dashboard Template
Author: Left4code
Website: http://www.left4code.com/
Contact: muhammadrizki@left4code.com
Purchase: https://themeforest.net/user/left4code/portfolio
Renew Support: https://themeforest.net/user/left4code/portfolio
License: You must have a valid license purchased only from themeforest(the above link) in order to legally use the theme for your project.
-->
<html lang="en" class="light">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('template/dist/images/logo.svg') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Tinker admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Tinker Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Master Siswa - Aplikasi PSB</title>
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
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('template/dist/images/logo-taqmir.png') }}">
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
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('template/dist/images/logo-taqmir.png') }}">
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
                        <a href="{{ route('masterjurusan') }}" class="side-menu side-menu--active">
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
                    <li class="desktop-datanilai">
                        <a href="javascript:;" class="side-menu">
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
                                <a href="{{ route('data_nilai.presensi') }}" class="side-menu">
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
                            <li class="breadcrumb-item active" aria-current="page">Master Kelas</li>
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
                        List Master Kelas
                    </h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <button class="btn btn-primary shadow-md mr-2 btn-tambah">Tambah Data</button>
                    </div>
                </div>
                <!-- BEGIN: HTML Table Data -->
                <div class="intro-y box p-5 mt-5">
                    <div class="overflow-x-auto scrollbar-hidden">
                        <table id="data-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Jurusan</th>
                                    <th>Kode</th>
                                    <th>Name</th>
                                    <th>Jumlah Siswa</th>
                                    <th>Status</th>
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
            <div id="header-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Form Buat Data Kelas
                            </h2>
                            <a data-tw-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-3" class="form-label">Jurusan</label>
                                <select class="form-select form-jurusan" required>
                                    <option selected disabled> --- Pilih Jurusan --- </option>
                                    {{-- <option value="MIPA">MIPA</option>
                                    <option value="IIS">IIS</option> --}}
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-1" class="form-label">Kode Kelas</label>
                                <input type="text" class="form-control form-kode" placeholder="MIPA001" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control form-name" placeholder="MIPA 10" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-3" class="form-label">Status</label>
                                <select class="form-select form-is_active" required>
                                    <option selected disabled> --- Pilih Status Kelas --- </option>
                                    <option value="1"> Aktif </option>
                                    <option value="0"> Nonaktif </option>
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
            <!-- END: Modal Content -->
            <!-- BEGIN: Notification Sukses Tambah Kelas Content -->
            <div id="success-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil membuat data kelas baru!</div>
                    <div class="text-slate-500 mt-1 pesan-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Tambah Kelas Content -->
            <!-- BEGIN: Notification Gagal Tambah Kelas Content -->
            <div id="failed-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="x-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal membuat data kelas baru!</div>
                    <div class="text-slate-500 mt-1 pesan-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Gagal Tambah Kelas Content -->
            <!-- BEGIN: Modal Content -->
            <div id="header-update-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Form Edit Data Kelas
                            </h2>
                            <a data-tw-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-1" class="form-label">Jurusan</label>
                                <input type="hidden" class="form-control update-id">
                                <select class="form-select update-jurusan" required>
                                    <option selected disabled> --- Pilih Jurusan --- </option>
                                    {{-- <option value="MIPA"> MIPA </option>
                                    <option value="IIS"> IIS </option> --}}
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-3" class="form-label">Kode Kelas</label>
                                <input type="text" class="form-control update-kode" placeholder="MIPA010" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nama Kelas</label>
                                <input type="text" class="form-control update-nama" placeholder="MIPA 10" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-3" class="form-label">Status</label>
                                <select class="form-select update-status" required>
                                    <option selected disabled> --- Pilih Status Kelas --- </option>
                                    <option value="1"> Aktif </option>
                                    <option value="0"> Nonaktif </option>
                                </select>
                            </div>
                        </div>
                        <!-- END: Modal Body -->
                        <!-- BEGIN: Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Batal</button>
                            <button type="button" class="btn btn-primary w-20 btn-update">Update</button>
                        </div>
                        <!-- END: Modal Footer -->
                    </div>
                </div>
            </div>
            <!-- END: Modal Content -->
            <!-- BEGIN: Notification Sukses Update Kelas Content -->
            <div id="success-update-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil update data kelas!</div>
                    <div class="text-slate-500 mt-1 update-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Update Kelas Content -->
            <!-- BEGIN: Notification Gagal Update Kelas Content -->
            <div id="failed-update-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="x-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal update data kelas!</div>
                    <div class="text-slate-500 mt-1 update-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Gagal Update Kelas Content -->
            <!-- BEGIN: Modal Content -->
            <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="p-5 text-center">
                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                                <div class="text-3xl mt-5">Apa kamu yakin?</div>
                                <div class="text-slate-500 mt-2">
                                    Apa kamu yakin akan menghapus data kelas ini? 
                                    <br>
                                    Data yang terhapus tidak bisa dikembalikan.
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
            <!-- END: Modal Content -->
            <!-- BEGIN: Notification Sukses Hapus Kelas Content -->
            <div id="success-hapus-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil hapus data kelas!</div>
                    <div class="text-slate-500 mt-1 hapus-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Hapus Kelas Content -->
            <!-- BEGIN: Notification Gagal Hapus Kelas Content -->
            <div id="failed-hapus-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="x-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal hapus data kelas!</div>
                    <div class="text-slate-500 mt-1 hapus-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Gagal Hapus Kelas Content -->
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
                function getCookie(name) {
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

                if (token) {
                    // Token ada dalam cookie, lakukan tindakan yang sesuai
                    console.log('Token:', token);
                } else {
                    window.location.href = "{{ route('login') }}";
                }

                // Fungsi button logout
                jQuery('.btn-logout').click(function() {
                    logout(token);
                });

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

                // data support jurusan
                var url = 'http://127.0.0.1:8000/api/master-jurusan/data-support/jurusan';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                    
                    var selectCreate = jQuery('.form-jurusan');
                    var selectUpdate = jQuery('.update-jurusan');

                    jQuery.each(data, function(index, item) {
                        for (let i = 0; i < item.length; i++)
                        {
                            selectCreate.append('<option value ="' + item[i].id + '">' + item[i].name + '</option>' );
                            selectUpdate.append('<option value ="' + item[i].id + '">' + item[i].name + '</option>' );
                        }
                    });
                }).catch(error => {
                    console.error ('Error: ', error);
                });
                
                jQuery('.btn-tambah').click(function() {
                    // Show Modal
                    const el = document.querySelector("#header-footer-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();
                });

                jQuery('.btn-simpan').click(function() {
                    // Show the modal
                    event.preventDefault(); // Prevent default form submission

                    // Get form data
                    var jurusan_id = jQuery(".form-jurusan").val();
                    var kode = jQuery(".form-kode").val();
                    var name = jQuery(".form-name").val();
                    var is_active = jQuery(".form-is_active").val();

                    var formData = new FormData();
                    formData.append('jurusan_id', jurusan_id);
                    formData.append('kode', kode);
                    formData.append('name', name);
                    formData.append('is_active', is_active);

                    // Kirim permintaan pembaruan produk ke API
                    jQuery.ajax({
                        url: 'http://127.0.0.1:8000/api/master-jurusan/tambah-data',
                        type: 'POST',
                        headers: {
                            "Authorization": "Bearer " + token
                        },
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            // Show the modal
                            jQuery('.pesan-sukses').text(response.message);
                            Toastify({
                                node: $("#success-notification-content")
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
                        error: function(xhr, status, error) {
                            // Show the modal
                            jQuery('.pesan-gagal').text(error);
                            Toastify({
                                node: $("#failed-notification-content")
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

                // Panggil List Data Kelas
                var url = 'http://127.0.0.1:8000/api/master-jurusan/list';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                        // Panggil fungsi untuk mengisi data ke dalam tbody DataTable
                        populateDataTable(data);
                }).catch(error => {
                    console.log(error);
                });

                function populateDataTable(data) {
                    var tableBody = jQuery("#data-body");

                    // Bersihkan isi tbody sebelum mengisi dengan data baru
                    tableBody.empty();

                    var rowDataArray = []; // Variabel untuk menyimpan objek baris

                    // Perulangan menggunakan jQuery.each()
                    jQuery.each(data, function(index, item) {
                        for (let i = 0; i < item.length; i++) {
                            // // Create an object with the desired properties
                            var rowData = {
                                id: item[i].id,
                                jurusan_name: item[i].jurusan_name,
                                kode: item[i].kode,
                                name: item[i].name,
                                jumlah: item[i].jumlah,
                                status: item[i].status,
                                is_active: item[i].is_active,
                            };

                            // Push the object to the data array
                            rowDataArray.push(rowData);
                        }
                    });

                    var dataTable = jQuery('#data-table').DataTable();
                    if (dataTable) {
                        // Destroy DataTable
                        dataTable.destroy();
                    }

                    // Initialize DataTable
                    var table = jQuery('#data-table').DataTable({
                        data: rowDataArray,
                        columns: [
                            { data: 'id', className: 'text-center' },
                            { data: 'jurusan_name', className: 'text-center' },
                            { data: 'kode', className: 'text-center' },
                            { data: 'name', className: 'text-center' },
                            { data: 'jumlah', className: 'text-center' },
                            { data: 'status', className: 'text-center' },
                            {
                                data: null,
                                render: function (data, type, row) {

                                    // Create action buttons
                                    var editBtn = '<button class="btn btn-primary btn-edit" data-id="' + data.id + '" data-jurusan_id="' + data.jurusan_id + '" data-kode="' + data.kode + '" data-name="' + data.name + '" data-is_active="' + data.is_active + '"><i data-feather="edit" class="w-4 h-4"></i></button>';
                                    var deleteBtn = '<button class="btn btn-danger btn-delete" data-id="' + data.id + '"><i data-feather="trash-2" class="w-4 h-4"></i></button>';

                                    // Combine the buttons
                                    var actions = editBtn + ' || ' + deleteBtn;
                                    return actions;
                                }
                            }
                        ],
                        "drawCallback": function( settings ) {
                            feather.replace();
                        }
                    });

                    // Handle button click events
                    jQuery('#data-table').on('click', '.btn-edit', function() {
                        // Show Modal
                        const el = document.querySelector("#header-update-footer-modal-preview");
                        const modal = tailwind.Modal.getOrCreateInstance(el);
                        modal.show();

                        var id = jQuery(this).attr("data-id");
                        var jurusan_id = jQuery(this).attr("data-jurusan_id");
                        var kode = jQuery(this).attr("data-kode");
                        var name = jQuery(this).attr("data-name");
                        var is_active = jQuery(this).attr("data-is_active");

                        // Handle edit action
                        jQuery('.update-id').val(id);
                        jQuery('.update-jurusan').val(jurusan_id);
                        jQuery('.update-kode').val(kode);
                        jQuery('.update-nama').val(name);
                        jQuery('.update-status').val(is_active);
                    });

                    // Tombol Update Admin
                    jQuery(".btn-update").click(function() {
                        // Ajax update
                        var id = jQuery('.update-id').val();
                        var jurusan_id = jQuery('.update-jurusan').val();
                        var kode = jQuery('.update-kode').val();
                        var name = jQuery('.update-nama').val();
                        var is_active = jQuery('.update-status').val();

                        // Kirim permintaan pembaruan produk ke API
                        jQuery.ajax({
                            url: 'http://127.0.0.1:8000/api/master-jurusan/update-data/' + id,
                            type: "PUT",
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                            },
                            data: {
                                jurusan_id: jurusan_id,
                                kode: kode,
                                name: name,
                                is_active: is_active,
                            },
                            success: function(response) {
                                jQuery('.update-sukses').text(response.message);
                                Toastify({
                                    node: $("#success-update-notification-content")
                                        .clone()
                                        .removeClass("hidden")[0],
                                    duration: 2000,
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
                            error: function(xhr, status, error) {
                                jQuery('.update-gagal').text(error);
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
                            }
                        });
                    });

                    jQuery('#data-table').on('click', '.btn-delete', function() {
                        var id = jQuery(this).attr("data-id");

                        // Show Modal
                        const el = document.querySelector("#delete-modal-preview");
                        const modal = tailwind.Modal.getOrCreateInstance(el);
                        modal.show();
                       
                        jQuery('.hapus-btn').click(function() {
                            // Ajax delete Api
                            jQuery.ajax({
                                url: 'http://127.0.0.1:8000/api/master-jurusan/hapus-data/' + id,
                                type: 'DELETE',
                                headers: {
                                    'Authorization': 'Bearer ' + token
                                },
                                success: function(response) {
                                    jQuery('.hapus-sukses').text(response.message);
                                    Toastify({
                                        node: $("#success-hapus-notification-content")
                                            .clone()
                                            .removeClass("hidden")[0],
                                        duration: 2000,
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
                                error: function(xhr, status, error) {
                                    jQuery('.hapus-gagal').text(error);
                                    Toastify({
                                        node: $("failed-hapus-notification-content")
                                            .clone()
                                            .removeClass("hidden")[0],
                                        duration: 5000,
                                        newWindow: true,
                                        close: true,
                                        gravity: "top",
                                        position: "right",
                                        stopOnFocus: true,
                                    }).showToast();
                                }
                            });
                        });
                    });
                }

                function logout(name) {
                    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    window.location.href = "{{ route('login') }}";
                }
            });
        </script>
        <!-- END: JS Assets-->
    </body>
</html>