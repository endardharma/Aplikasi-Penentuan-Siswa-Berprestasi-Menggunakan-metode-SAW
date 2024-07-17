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
        <title>Master Guru - Aplikasi PSB</title>
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
                    <li>
                        <a href="{{ route('dashboard') }}" class="menu">
                            <div class="menu__icon"> <i data-lucide="airplay"></i> </div>
                            <div class="menu__title"> Dashboard </div>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('masterguru') }}" class="menu menu--active">
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
                        <a href="javascript:;" class="menu">
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
                    <img alt="Midone - HTML Admin Template" class="w-6" src="{{ asset('template/dist/images/logo-taqmir.png') }}">
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
                        <a href="{{ route('masterguru') }}" class="side-menu side-menu--active">
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
                        <a href="javascript:;" class="side-menu">
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
                                <a href="{{ route('data_nilai.prestasi') }}" class="side-menu">
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
                            <li class="breadcrumb-item active" aria-current="page">Master Guru</li>
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
                        List Master Guru
                    </h2>
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
                <!-- BEGIN: HTML Table Data -->
                <div class="intro-y box p-5 mt-5">
                    <div class="overflow-x-auto scrollbar-hidden">
                        <table id="data-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NIP</th>
                                    <th>Nama</th>
                                    <th>Jenis Kelamin</th>
                                    <th>Status Pegawai</th>
                                    <th>Jabatan</th>
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
                                Form Buat Data Guru
                            </h2>
                            <a data-tw-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-1" class="form-label">NIP</label>
                                <input type="number" class="form-control form-nip" placeholder="NIP" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nama Lengkap</label>
                                <input type="text" class="form-control form-name" placeholder="Sukaryo Sulaksono" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-3" class="form-label">Email</label>
                                <input type="text" class="form-control form-email" placeholder="karyo@mail.com" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-4" class="form-label">Password</label>
                                <input type="password" class="form-control form-password" placeholder="********" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-6" class="form-label">Jenis Kelamin</label>
                                <select class="form-select form-jenkel" required>
                                    <option selected disabled> --- Pilih Jenis Kelamin --- </option>
                                    <option value="laki-laki"> Laki-laki </option>
                                    <option value="perempuan"> Perempuan </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-6" class="form-label">Status Pegawai</label>
                                <select class="form-select form-role-id" required>
                                    <option selected disabled> --- Pilih Status Pegawai --- </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-5" class="form-label">Jabatan</label>
                                <input type="text" class="form-control form-jabatan" placeholder="Guru Matematika" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-5" class="form-label">Nomer Telpon</label>
                                <input type="number" class="form-control form-telpon" placeholder="62821********" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="fileInput" class="form-label">Photo Profil</label>
                                <input type="file" class="form-control" id="fileInput" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-6" class="form-label">Status Akun</label>
                                <select class="form-select form-status" required>
                                    <option selected disabled> --- Pilih Status Akun --- </option>
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
            <!-- BEGIN: Notification Sukses Tambah Guru Content -->
            <div id="success-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil membuat data guru baru!</div>
                    <div class="text-slate-500 mt-1 pesan-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Tambah Guru Content -->
            <!-- BEGIN: Notification Gagal Tambah Guru Content -->
            <div id="failed-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="x-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal membuat data guru baru!</div>
                    <div class="text-slate-500 mt-1 pesan-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Gagal Tambah Guru Content -->
            <!-- BEGIN: Modal Content -->
            <div id="header-update-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Form Edit Data Guru
                            </h2>
                            <a data-tw-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-1" class="form-label">NIP</label>
                                <input type="hidden" class="form-control update-id" placeholder="NIP">
                                <input type="number" class="form-control update-nip" placeholder="NIP" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Nama</label>
                                <input type="text" class="form-control update-nama" placeholder="Suryodikaryo" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-3" class="form-label">Jenis Kelamin</label>
                                <select class="form-select update-jenkel" required>
                                    <option selected disabled> --- Pilih Jenis Kelamin --- </option>
                                    <option value="laki-laki"> Laki-laki </option>
                                    <option value="perempuan"> Perempuan </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-2" class="form-label">Status Pegawai</label>
                                <input type="text" class="form-control update-role-id" placeholder="Suryodikaryo" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-4" class="form-label">Jabatan</label>
                                <input type="text" class="form-control update-jabatan" placeholder="Guru Matematika" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-5" class="form-label">Telpon</label>
                                <input type="number" class="form-control update-telpon" placeholder="62821********" required>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                                <label for="modal-form-6" class="form-label">Status</label>
                                <select id="modal-form-6" class="form-select update-status" required>
                                    <option selected disabled> --- Pilih Status Akun --- </option>
                                    <option value="1"> Aktif </option>
                                    <option value="0"> Nonaktif</option>
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
            <!-- BEGIN: Notification Sukses Update Guru Content -->
            <div id="success-update-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil update data guru!</div>
                    <div class="text-slate-500 mt-1 update-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Update Guru Content -->
            <!-- BEGIN: Notification Gagal Update Guru Content -->
            <div id="failed-update-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="x-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal update data guru!</div>
                    <div class="text-slate-500 mt-1 update-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Gagal Update Guru Content -->
            <!-- BEGIN: Modal Content -->
            <div id="delete-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body p-0">
                            <div class="p-5 text-center">
                                <i data-lucide="x-circle" class="w-16 h-16 text-danger mx-auto mt-3"></i> 
                                <div class="text-3xl mt-5">Apa kamu yakin?</div>
                                <div class="text-slate-500 mt-2">
                                    Apa kamu yakin akan menghapus data guru ini? 
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
            <!-- BEGIN: Notification Sukses Hapus Guru Content -->
            <div id="success-hapus-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil hapus data guru!</div>
                    <div class="text-slate-500 mt-1 hapus-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Hapus Guru Content -->
            <!-- BEGIN: Notification Gagal Hapus Guru Content -->
            <div id="failed-hapus-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="x-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal hapus data guru!</div>
                    <div class="text-slate-500 mt-1 hapus-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Gagal Hapus Guru Content -->
            <!-- BEGIN: Modal Content -->
            <div id="header-import-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Form Import Data Guru
                            </h2>
                            <a data-tw-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-6">
                                <label for="modal-form-1" class="form-label">Unduh Template</label>
                                <br/>
                                <button type="button" class="btn btn-primary w-20 btn-unduh">Unduh</button>
                            </div>
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
            <!-- BEGIN: Notification Sukses Import Guru Content -->
            <div id="success-import-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="check-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Berhasil import data guru!</div>
                    <div class="text-slate-500 mt-1 import-sukses"></div>
                </div>
            </div>
            <!-- END: Notification Sukses Import Guru Content -->
            <!-- BEGIN: Notification Gagal Import Guru Content -->
            <div id="failed-import-notification-content" class="toastify-content hidden flex">
                <i class="text-success" data-lucide="x-circle"></i> 
                <div class="ml-4 mr-4">
                    <div class="font-medium">Gagal import data guru!</div>
                    <div class="text-slate-500 mt-1 import-gagal"></div>
                </div>
            </div>
            <!-- END: Notification Gagal Import Guru Content -->
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

                    jQuery('.nama-akun').text(data.name);
                    jQuery('.role-akun').text(data.role_name);

                }).catch(error => {
                    console.error('Error:', error);
                });

                jQuery('.btn-tambah').click(function() {
                    // Show Modal
                    const el = document.querySelector("#header-footer-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();
                });

                // Panggil data support role
                var url = 'http://127.0.0.1:8000/api/master-guru/data-support/role';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                    var select = jQuery('.form-role-id');

                    // Iterasi melalui data dan membuat objek untuk setiap entri
                    jQuery.each(data, function(index, item) {
                        for (let i = 0; i < item.length; i++) {
                            select.append('<option value="' + item[i].id + '">' + item[i].name + '</option>');
                        }
                    });
                }).catch(error => {
                    console.error('Error:', error);
                });

                jQuery('.btn-simpan').click(function() {
                    // Show the modal
                    event.preventDefault(); // Prevent default form submission

                    // Get form data
                    var nip = jQuery(".form-nip").val();
                    var name = jQuery(".form-name").val();
                    var email = jQuery(".form-email").val();
                    var password = jQuery(".form-password").val();
                    var jenkel = jQuery(".form-jenkel").val();
                    var role_id = jQuery(".form-role-id").val();
                    var jabatan = jQuery(".form-jabatan").val();
                    var telpon = jQuery(".form-telpon").val();
                    var status = jQuery(".form-status").val();
                    var inp = jQuery('#fileInput')[0];
                    var foto = inp.files[0];

                    if (foto) {
                        var formData = new FormData();
                        formData.append('nip', nip);
                        formData.append('name', name);
                        formData.append('email', email);
                        formData.append('password', password);
                        formData.append('jenkel', jenkel);
                        formData.append('role_id', role_id);
                        formData.append('jabatan', jabatan);
                        formData.append('telpon', telpon);
                        formData.append('status', status);
                        formData.append('photo', foto);

                        // Kirim permintaan pembaruan produk ke API
                        jQuery.ajax({
                            url: 'http://127.0.0.1:8000/api/master-guru/tambah-data',
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
                                    location.reload();
                                }, 5000); // 3000 milliseconds = 3 seconds
                            }
                        });
                    }else{
                        var formData = new FormData();
                        formData.append('nip', nip);
                        formData.append('name', name);
                        formData.append('email', email);
                        formData.append('password', password);
                        formData.append('jenkel', jenkel);
                        formData.append('role_id', role_id);
                        formData.append('jabatan', jabatan);
                        formData.append('telpon', telpon);
                        formData.append('status', status);
                        formData.append('photo', '');

                        // Kirim permintaan pembaruan produk ke API
                        jQuery.ajax({
                            url: 'http://127.0.0.1:8000/api/master-guru/tambah-data',
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
                                    location.reload();
                                }, 5000); // 3000 milliseconds = 3 seconds
                            }
                        });
                    }
                })

                // Datatable list Cabang
                jQuery('#data-table').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        "url": "http://127.0.0.1:8000/api/master-guru/list",
                        "dataType": "json",
                        "type": "POST",
                        "headers": {
                            'Authorization': 'Bearer ' + token
                        }
                    },
                    "columns": [
                        { data: 'id', className: 'text-center' },
                        { data: 'nip', className: 'text-center' },
                        { data: 'user_name', className: 'text-center' },
                        { data: 'jenkel', className: 'text-center' },
                        { data: 'role_name', className: 'text-center' },
                        { data: 'jabatan', className: 'text-center' },
                        { data: 'setatus', className: 'text-center' },
                        {
                            data: null,
                            render: function (data, type, row) {

                                // Create action buttons
                                var editBtn = '<button class="btn btn-primary btn-edit" data-id="' + data.id + '" data-user_name="' + data.user_name + '" data-nip="' + data.nip + '" data-jenkel="' + data.jenkel + '" data-role_name="' + data.role_name + '" data-jabatan="' + data.jabatan + '" data-status="' + data.status + '" data-telpon="' + data.telpon + '"><i data-feather="edit" class="w-4 h-4 mr-1"></i></button>';
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

                // Passing data list row ke dalam modal update
                jQuery('#data-table').on('click', '.btn-edit', function() {
                    // Show the modal
                    const el = document.querySelector("#header-update-footer-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();

                    var id = jQuery(this).attr("data-id");
                    var user_name = jQuery(this).attr("data-user_name");
                    var nip = jQuery(this).attr("data-nip");
                    var jenkel = jQuery(this).attr("data-jenkel");
                    var role_name = jQuery(this).attr("data-role_name");
                    var jabatan = jQuery(this).attr("data-jabatan");
                    var status = jQuery(this).attr("data-status");
                    var telpon = jQuery(this).attr("data-telpon");

                    // Handle edit action
                    jQuery('.update-id').val(id);
                    jQuery('.update-nip').val(nip);
                    jQuery('.update-nama').val(user_name).prop('disabled',true);
                    jQuery('.update-jenkel').val(jenkel);
                    jQuery('.update-role-id').val(role_name).prop('disabled',true);
                    jQuery('.update-jabatan').val(jabatan);
                    jQuery('.update-status').val(status);
                    jQuery('.update-telpon').val(telpon);
                });

                // Fungsi button update data
                jQuery('.btn-update').click(function() {
                    // Ajax update
                    var id = jQuery('.update-id').val();
                    var name = jQuery('.update-nama').val();
                    var nip = jQuery('.update-nip').val();
                    var jenkel = jQuery('.update-jenkel').val();
                    var jabatan = jQuery('.update-jabatan').val();
                    var status = jQuery('.update-status').val();
                    var telpon = jQuery('.update-telpon').val();

                    // Kirim permintaan pembaruan produk ke API
                    jQuery.ajax({
                        url: 'http://127.0.0.1:8000/api/master-guru/update-data/' + id,
                        type: "PUT",
                        beforeSend: function(xhr) {
                            xhr.setRequestHeader('Authorization', 'Bearer ' + token);
                        },
                        data: {
                            name: name,
                            nip: nip,
                            jenkel: jenkel,
                            jabatan: jabatan,
                            status: status,
                            telpon: telpon,
                        },
                        success: function(response) {
                            // Show the modal
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

                            setTimeout(function() {
                                location.reload();
                            }, 3000); // 3000 milliseconds = 3 seconds
                        },
                        error: function(xhr, status, error) {
                            // Show the modal
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

                            setTimeout(function() {
                                location.reload();
                            }, 5000); // 3000 milliseconds = 3 seconds
                        }
                    });
                });

                // Fungsi Tombol hapus
                jQuery('#data-table').on('click', '.btn-delete', function() {
                    var id = jQuery(this).attr("data-id");

                    // Show the modal
                    const el = document.querySelector("#delete-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();

                    jQuery('.btn-iya').click(function() {
                        // Ajax delete Api
                        jQuery.ajax({
                            url: '{{ env('BASE_URL') }}api/master-guru/hapus-data/' + id,
                            type: 'DELETE',
                            headers: {
                                'Authorization': 'Bearer ' + token
                            },
                            success: function(response) {
                                // Show the modal
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

                                setTimeout(function() {
                                    location.reload();
                                }, 3000); // 3000 milliseconds = 3 seconds
                            },
                            error: function(xhr, status, error) {
                                // Show the modal
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

                                setTimeout(function() {
                                    location.reload();
                                }, 5000); // 3000 milliseconds = 3 seconds
                            }
                        });
                    });
                });

                // Fungsi button export
                jQuery('.btn-export').click(function() {
                    // Akses URL Export data
                    var linkto = 'http://127.0.0.1:8000/api/master-guru/export-data';
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
                            var filename = (matches != null && matches[1] ? matches[1] : 'Export-Master-Guru.xlsx');

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

                // Menampilkan modal export
                jQuery('.modal-import').click(function() {
                    // Show the modal
                    const el = document.querySelector("#header-import-footer-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show(); 
                });

                jQuery('.btn-unduh').click(function() {
                    // Akses URL Export data
                    var linkto = 'http://127.0.0.1:8000/api/master-guru/download-template';
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
                            var filename = (matches != null && matches[1] ? matches[1] : 'Template-Master-Guru.xlsx');

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

                // Fungsi button import
                jQuery('.btn-import').click(function() {
                    // Get form data
                    var inp = jQuery('#fileInput1')[0];
                    var foto = inp.files[0];

                    var formData = new FormData();
                    formData.append('excel', foto);

                    // Kirim permintaan pembaruan produk ke API
                    jQuery.ajax({
                        url: 'http://127.0.0.1:8000/api/master-guru/import-data',
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
                        error: function(xhr, status, error) {
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

                function logout(name) {
                    document.cookie = name + "=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;";
                    window.location.href = "{{ route('login') }}";
                }
            });
        </script>
        <!-- END: JS Assets-->
    </body>
</html>