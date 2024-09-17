<!DOCTYPE html>
<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="{{ asset('template/dist/images/logo.svg') }}" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Tinker admin is super flexible, powerful, clean & modern responsive tailwind admin template with unlimited possibilities.">
        <meta name="keywords" content="admin template, Tinker Admin Template, dashboard template, flat admin template, responsive admin template, web app">
        <meta name="author" content="LEFT4CODE">
        <title>Nilai Perangkingan - Aplikasi PSB</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="{{ asset('template/dist/css/app.css') }}" />
        <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
        <style>
            /* Menyesuaikan lebar dropdown 'Show Entries'*/
            .dataTables_length {
                width: 200px; /* Sesuaikan lebar sesuai dengan kebutuhan */
            }
            
            /* Menyesuaikan lebar opsi dropdown'*/
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
                        <a href="javascript:;" class="side-menu side-menu--active">
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
                                <a href="{{ route('penilaian.nilaiperangkingan') }}" class="side-menu side-menu--active">
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
                            <li class="breadcrumb-item active" aria-current="page">Nilai Perangkingan</li>
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
                        List Nilai Perangkingan Jurusan MIPA
                    </h2>
                    {{-- <div class="w-full sm:w-10 flex mt-4 sm:mt-0">
                        <div class="dropdown ml-auto sm:ml-0">
                            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="list"></i> </span>
                            </button>
                            <div class="dropdown-menu w-40">
                                <ul class="dropdown-content">
                                    <li>
                                        <a href="{{ route ('tablenormalisasi')}}" class="dropdown-item modal-detail"> <i data-lucide="table" class="w-4 h-4 mr-2"></i> Tabel Normalisasi </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        {{-- <button class="btn btn-primary shadow-md mr-2 btn-export-data">Export Data</button> --}}
                        <div class="dropdown ml-auto sm:ml-0">
                            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                                <span class="w-5 h-5 flex items-center justify-center"> <i class="w-4 h-4" data-lucide="plus"></i> </span>
                            </button>
                            <div class="dropdown-menu w-40">
                                <ul class="dropdown-content">
                                    <li>
                                        <a href="#" class="dropdown-item btn-export-mipa"> <i data-lucide="file-text" class="w-5 h-5 mr-2"></i> Export Data MIPA </a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item btn-export-mipa-best-3"> <i data-lucide="file-text" class="w-5 h-5 mr-2"></i> Export 3 Terbaik MIPA</a>
                                    </li>
                                    <li>
                                        <a href="#" id="export-mipa-pdf" class="dropdown-item btn-export-pdf">
                                            <i data-lucide="file-text" class="w-5 h-5 mr-2"></i> Export Data MIPA PDF
                                        </a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item btn-export-mipa-pdf-best-3"> <i data-lucide="file-text" class="w-5 h-5 mr-2"></i> Export 3 Terbaik MIPA PDF</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="intro-y flex flex-col sm:flex-row items-center mt-1 mr-auto">
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0 items-center">
                        <label for="showTop3Mipa" class="form-label flex items-center space-x-2">
                            <input type="checkbox" id="showTop3Mipa" />
                            <span>Tampilkan 3 Siswa Teratas</span>
                        </label>
                    </div>
                </div>
                <!-- BEGIN : SortBy Jurusan -->
                <div class="intro-y flex flex-col sm:flex-row items-center mt-1">
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <button type="submit" class="btn btn-primary shadow-md mr-2 btn-cari-mipa" id="search-button-mipa">Cari</button>
                    </div>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <label for="periode" class="form-label"></label>
                        <select class="form-select form-periode" name="periode" id="select-periode" required>
                            <option disabled selected> -- Pilih Periode -- </option>
                            <option value="-1">Semua Periode</option>
                        </select>
                    </div>
                </div>
                
                <!-- END : SortBy Jurusan -->
                <!-- BEGIN: HTML Table Data -->
                <div class="intro-y box p-5 mt-5">
                    <div class="overflow-x-auto scrollbar-hidden">
                        <table id="data-table-mipa" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Siswa</th>
                                    <th>Nilai Akhir</th>
                                    <th>Jurusan</th>
                                    {{-- <th>Semester</th> --}}
                                    <th>Tahun Ajar</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END: HTML Table Data -->
                <!-- BEGIN: Modal Content -->
            <div id="header-export-footer-modal-preview" class="modal" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- BEGIN: Modal Header -->
                        <div class="modal-header">
                            <h2 class="font-medium text-base mr-auto">
                                Form Export Data Nilai Perangkingan
                            </h2>
                            <a data-tw-dismiss="modal" href="javascript:;"> <i data-feather="x" class="w-8 h-8 text-gray-500"></i> </a>
                        </div>
                        <!-- END: Modal Header -->
                        <!-- BEGIN: Modal Body -->
                        <div class="modal-body grid grid-cols-12 gap-4 gap-y-3">
                            <div class="col-span-12 sm:col-span-12">
                            <label for="modal-form-6" class="form-label">Pilih Tahun Ajar</label>
                                <select id="tajar-import" class="form-select form-export-periode">
                                    <option selected disabled> --- Pilih Tahun Ajar --- </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                            <label for="modal-form-6" class="form-label">Pilih Export Data</label>
                                <select id="tajar-import" class="form-select form-export-data">
                                    <option selected disabled> --- Pilih Export Data --- </option>
                                    <option value="Semua Data"> Semua Data </option>
                                    <option value="Tiga Siswa Terbaik"> Tiga Siswa Terbaik </option>
                                </select>
                            </div>
                            <div class="col-span-12 sm:col-span-12">
                            <label for="modal-form-6" class="form-label">Pilih Jenis Export Data</label>
                                <select id="tajar-import" class="form-select form-export-jenis-data">
                                    <option selected disabled> --- Pilih Jenis Export Data --- </option>
                                    <option value="PDF"> PDF </option>
                                    <option value="Excel"> Excel </option>
                                </select>
                            </div>
                        </div>
                        <!-- END: Modal Body -->
                        <!-- BEGIN: Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" data-tw-dismiss="modal" class="btn btn-outline-secondary w-20 mr-1">Batal</button>
                            <button type="button" class="btn btn-primary w-20 btn-export">Export</button>
                        </div>
                        <!-- END: Modal Footer -->
                    </div>
                </div>
            </div>
            <!-- END: Modal Content -->
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">
                        List Nilai Perangkingan Jurusan IIS
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
                                    {{-- <li>
                                        <a href="#" class="dropdown-item modal-import"> <i data-lucide="file-plus" class="w-4 h-4 mr-2"></i> Import Data </a>
                                    </li> --}}
                                    <li>
                                        <a href="#" class="dropdown-item btn-export-iis"> <i data-lucide="file-text" class="w-5 h-5 mr-2"></i> Export Data IIS </a>
                                    </li>
                                    <li>
                                        <a href="#" class="dropdown-item btn-export-iis-best-3"> <i data-lucide="file-text" class="w-5 h-5 mr-2"></i> Export 3 Terbaik IIS</a>
                                    </li>
                                    <li>
                                        <a href="#" id="export-iis-pdf" class="dropdown-item btn-export-pdf">
                                            <i data-lucide="file-text" class="w-5 h-5 mr-2"></i> Export Data IIS PDF
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="intro-y flex flex-col sm:flex-row items-center mt-1 mr-auto">
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0 items-center">
                        <label for="showTop3Iis" class="form-label flex items-center space-x-2">
                            <input type="checkbox" id="showTop3Iis" />
                            <span>Tampilkan 3 Siswa Teratas</span>
                        </label>
                    </div>
                </div>
                <!-- BEGIN : SortBy Jurusan -->
                <div class="intro-y flex flex-col sm:flex-row items-center mt-1">
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <button type="submit" class="btn btn-primary shadow-md mr-2 btn-cari-iis" id="search-button-iis">Cari</button>
                    </div>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <label for="periode" class="form-label"></label>
                        <select class="form-select form-periode-iis" name="periode" id="select-periode-iis" required>
                            <option disabled selected> -- Pilih Periode -- </option>
                            <option value="-1">Semua Periode</option>
                        </select>
                    </div>
                </div>
                <!-- END : SortBy Jurusan -->
                <!-- BEGIN: HTML Table Data -->
                <div class="intro-y box p-5 mt-5">
                    <div class="overflow-x-auto scrollbar-hidden">
                        <table id="data-table-iis" class="table table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nama Siswa</th>
                                    <th>Nilai Akhir</th>
                                    <th>Jurusan</th>
                                    {{-- <th>Semester</th> --}}
                                    <th>Tahun Ajar</th>
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
        </div>
        <!-- BEGIN: JS Assets -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.29.1/dist/feather.min.js"></script>
        <script src="{{ asset('template/dist/js/app.js') }}"></script>
        <script src="{{ asset('template/src/toastify.js') }}"></script>

        <!----------------------------------------------------------------------------------------->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.5.0-beta4/html2canvas.min.js"></script>

        <script>
            // Cek package jQuery
            jQuery(document).ready(function(){
                // Fungsi untuk mendapatkan nilai cookie
                function getCookie(name){
                    var cookieName = name + "=";
                    var decodedCookie = decodeURIComponent(document.cookie);
                    var cookieArray = decodedCookie.split(';');

                    for (var i = 0; i < cookieArray.length; i++)
                    {
                        var cookie = cookieArray[i];
                        while (cookie.charAt(0) === ' ')
                        {
                            cookie = cookie.substring(1);
                        }
                        if (cookie.indexOf(cookieName) === 0)
                        {
                            return cookie.substring(cookieName.length, cookie.length);
                        }
                    }
                }

                var token = getCookie('token');

                if (token)
                {
                    // Token ada dalam cookie, lakukan tindakan yang sesuai
                    console.log('Token: ', token);
                }
                else
                {
                    window.location.href = "{{ route('login') }}";
                }

                var url = 'http://127.0.0.1:8000/api/dashboard/home';
                fetch (url, {
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
                    console.error('Error: ', error);
                });

                // Data Support Tahun Ajar Mipa
                var url = 'http://127.0.0.1:8000/api/data-penilaian/nilai-perangkingan/data-support/tajar-mipa';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                    var selectSortByTajar = jQuery('.form-periode');
                    var selectExportPeriode = jQuery('.form-export-periode');

                    jQuery.each(data, function (index, item) {
                        for (let i = 0; i < item.length; i++)
                        {
                            selectSortByTajar.append('<option value="' + item[i].id + '">' + item[i].periode + '</option>');
                            selectExportPeriode.append('<option value="' + item[i].id + '">' + item[i].periode + '</option>');
                        }
                    });
                }).catch(error => {
                    console.error('Error:', error);
                });

                // Data Support Tahun Ajar Iis
                var url = 'http://127.0.0.1:8000/api/data-penilaian/nilai-perangkingan/data-support/tajar-iis';
                fetch(url, {
                    method: 'GET',
                    headers: {
                        'Authorization': 'Bearer ' + token
                    }
                }).then(response => response.json()).then(data => {
                    var selectSortByTajar = jQuery('.form-periode-iis');

                    jQuery.each(data, function (index, item) {
                        for (let i = 0; i < item.length; i++)
                        {
                            selectSortByTajar.append('<option value="' + item[i].id + '">' + item[i].periode + '</option>');
                        }
                    });
                }).catch(error => {
                    console.error('Error:', error);
                });

                // var table;
                // function loadDataTableMipa (tajarIdMipa = '')
                // {
                //     // Data table list nilai perangkingan MIPA
                //     table = jQuery('#data-table-mipa').dataTable({
                //         "processing": true,
                //         "serverSide": true,
                //         "destroy": true,
                //         "ajax": {
                //             "url": "http://127.0.0.1:8000/api/data-penilaian/nilai-perangkingan/listMipa",
                //             "dataType": "json",
                //             "type": "POST",
                //             "headers": {
                //                 'Authorization': 'Bearer ' + token
                //             },
                //             "data": function (d) {
                //                 d.tajar_id = (tajarIdMipa === '-1') ? ' ' : tajarIdMipa;
                //                 d.show_top_3 = jQuery('#showTop3').is(':checked') ? 1 : 0;
                //                 d.order = d.order[0] || {}; // Pastikan d.order memiliki nilai default
                //                 d.order.column = d.order.column || 0; // Kolom default jika tidak ada
                //                 d.order.dir = d.order.dir && ['asc', 'desc'].includes(d.order.dir) ? d.order.dir : 'asc'; // Nilai default untuk dir
                //             }
                //         },
                //         "columns": [
                //             { data: 'id', className: 'text-center' },
                //             { data: 'nama_siswa', className: 'text-center' },
                //             { data: 'nilai_akhir', className: 'text-center' },
                //             { data: 'jurusan', className: 'text-center' },
                //             // { data: 'semester', className: 'text-center' },
                //             { data: 'tahun_ajar', className: 'text-center' },
                //         ],
                //         "order": [[2, 'desc']],
                //         "drawCallback": function (settings) {
                //             feather.replace(); // Asumsikan feather adalah plugin ikon yang digunakan
                //         }
                //     });

                //     // Event listener untuk checkbox
                //     jQuery('#showTop3').change(function() {
                //         table.ajax.reload(); // Reload data table dengan parameter baru
                //     });
                // }

                // Fungsi button sortBy
                loadDataTableMipa();
                jQuery('#search-button-mipa').on('click', function() {
                    var tajarIdMipa = $('#select-periode').val();
                    loadDataTableMipa(tajarIdMipa);
                })

                var tableMipa; // Deklarasi variabel global
                function loadDataTableMipa(tajarIdMipa = '') 
                {
                    tableMipa = jQuery('#data-table-mipa').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "destroy": true,
                        "ajax": {
                            "url": "http://127.0.0.1:8000/api/data-penilaian/nilai-perangkingan/listMipa",
                            "dataType": "json",
                            "type": "POST",
                            "headers": {
                                'Authorization': 'Bearer ' + token
                            },
                            "data": function (d) {
                                d.tajar_id = (tajarIdMipa === '-1') ? '' : tajarIdMipa; // Kirim nilai periode yang dipilih atau kosong jika 'Semua Periode' dipilih
                                d.show_top_3_mipa = jQuery('#showTop3Mipa').is(':checked') ? 1 : 0;
                                d.order = d.order[0] || {}; // Pastikan d.order memiliki nilai default
                                d.order.column = d.order.column || 0; // Kolom default jika tidak ada
                                d.order.dir = d.order.dir && ['asc', 'desc'].includes(d.order.dir) ? d.order.dir : 'asc'; // Nilai default untuk dir
                            }
                        },
                        "columns": [
                            { data: 'id', className: 'text-center' },
                            { data: 'nama_siswa', className: 'text-center' },
                            { data: 'nilai_akhir', className: 'text-center' },
                            { data: 'jurusan', className: 'text-center' },
                            { data: 'tahun_ajar', className: 'text-center' },
                        ],
                        "order": [[2, 'desc']], // Default sorting by 'nilai_akhir' in descending order
                        "drawCallback": function (settings) {
                            feather.replace(); // Asumsikan feather adalah plugin ikon yang digunakan
                        }
                    });

                    // Event listener untuk checkbox
                    jQuery('#showTop3Mipa').change(function() {
                        if (tableMipa) {
                            tableMipa.ajax.reload(); // Reload data table dengan parameter baru
                        }
                    });
                }
                
                // Panggil fungsi untuk inisialisasi DataTable
                loadDataTableMipa();

                // EXPORT PDF MIPA
                document.getElementById('export-mipa-pdf').addEventListener('click', function() {
                    // Menggunakan jsPDF dari window.jspdf untuk versi terbaru
                    const { jsPDF } = window.jspdf;

                    html2canvas(document.querySelector("#data-table-mipa")).then(canvas => {
                        const imgData = canvas.toDataURL('image/png');
                        const pdf = new jsPDF('p', 'mm', 'a4');
                        const imgWidth = 210; // A4 size width in mm
                        const pageHeight = 295; // A4 size height in mm
                        const imgHeight = canvas.height * imgWidth / canvas.width;
                        let heightLeft = imgHeight;

                        let position = 0;

                        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;

                        while (heightLeft >= 0) {
                            position = heightLeft - imgHeight;
                            pdf.addPage();
                            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                            heightLeft -= pageHeight;
                        }

                        pdf.save('data-mipa.pdf');
                    }).catch(err => {
                        console.error('Error capturing the table:', err);
                    });
                });

                // EXPORT PDF MIPA
                document.getElementById('export-iis-pdf').addEventListener('click', function() {
                    // Menggunakan jsPDF dari window.jspdf untuk versi terbaru
                    const { jsPDF } = window.jspdf;

                    html2canvas(document.querySelector("#data-table-iis")).then(canvas => {
                        const imgData = canvas.toDataURL('image/png');
                        const pdf = new jsPDF('p', 'mm', 'a4');
                        const imgWidth = 210; // A4 size width in mm
                        const pageHeight = 295; // A4 size height in mm
                        const imgHeight = canvas.height * imgWidth / canvas.width;
                        let heightLeft = imgHeight;

                        let position = 0;

                        pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                        heightLeft -= pageHeight;

                        while (heightLeft >= 0) {
                            position = heightLeft - imgHeight;
                            pdf.addPage();
                            pdf.addImage(imgData, 'PNG', 0, position, imgWidth, imgHeight);
                            heightLeft -= pageHeight;
                        }

                        pdf.save('data-iis.pdf');
                    }).catch(err => {
                        console.error('Error capturing the table:', err);
                    });
                });
                
                // Fungsi button sortBy
                loadDataTableIis();
                jQuery('#search-button-iis').on('click', function() {
                    var tajarIdIis = $('#select-periode-iis').val();
                    loadDataTableIis(tajarIdIis);
                })

                var tableIis; // Deklarasi variabel global
                function loadDataTableIis(tajarIdIis = '') {
                    tableIis = jQuery('#data-table-iis').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "destroy": true,
                        "ajax": {
                            "url": "http://127.0.0.1:8000/api/data-penilaian/nilai-perangkingan/listIis",
                            "dataType": "json",
                            "type": "POST",
                            "headers": {
                                'Authorization': 'Bearer ' + token
                            },
                            "data": function (d) {
                                d.tajar_id = (tajarIdIis === '-1') ? '' : tajarIdIis; // Kirim nilai periode yang dipilih atau kosong jika 'Semua Periode' dipilih
                                d.show_top_3_iis = jQuery('#showTop3Iis').is(':checked') ? 1 : 0;
                                d.order = d.order[0] || {}; // Pastikan d.order memiliki nilai default
                                d.order.column = d.order.column || 0; // Kolom default jika tidak ada
                                d.order.dir = d.order.dir && ['asc', 'desc'].includes(d.order.dir) ? d.order.dir : 'asc'; // Nilai default untuk dir
                            }
                        },
                        "columns": [
                            { data: 'id', className: 'text-center' },
                            { data: 'nama_siswa', className: 'text-center' },
                            { data: 'nilai_akhir', className: 'text-center' },
                            { data: 'jurusan', className: 'text-center' },
                            { data: 'tahun_ajar', className: 'text-center' },
                        ],
                        "order": [[2, 'desc']], // Default sorting by 'nilai_akhir' in descending order
                        "drawCallback": function (settings) {
                            feather.replace(); // Asumsikan feather adalah plugin ikon yang digunakan
                        }
                    });

                    // Event listener untuk checkbox
                    jQuery('#showTop3Iis').change(function() {
                        if (tableIis) {
                            tableIis.ajax.reload(); // Reload data table dengan parameter baru
                        }
                    });
                }
                loadDataTableIis();


                // Show modal detail
                jQuery('.modal-detail').click(function(){
                    // show the modal
                    const el = document.querySelector("#header-detail-footer-modal-preview");
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();
                })
                
                jQuery('.btn-export-mipa').click(function() {
                    // Akses URL Export data
                    var linkto = 'http://127.0.0.1:8000/api/data-penilaian/nilai-perangkingan/export-data/export-xls-mipa';
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
                            var filename = (matches != null && matches[1] ? matches[1] : 'Export-Nilai-Rangking-Siswa-Mipa.xlsx');

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
                })

                jQuery('.btn-export-mipa-best-3').click(function() {
                    // Akses URL Export data
                    var linkto = 'http://127.0.0.1:8000/api/data-penilaian/nilai-perangkingan/export-data/export-xls-mipa/3-best';
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
                            var filename = (matches != null && matches[1] ? matches[1] : 'Export-Nilai-Rangking-Siswa-Mipa-3-Terbaik.xlsx');

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
                })

                jQuery('.btn-export-iis').click(function() {
                    // Akses URL Export data
                    var linkto = 'http://127.0.0.1:8000/api/data-penilaian/nilai-perangkingan/export-data/export-xls-iis';
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
                            var filename = (matches != null && matches[1] ? matches[1] : 'Export-Nilai-Rangking-Siswa-Iis.xlsx');

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
                })

                jQuery('.btn-export-iis-best-3').click(function() {
                    // Akses URL Export data
                    var linkto = 'http://127.0.0.1:8000/api/data-penilaian/nilai-perangkingan/export-data/export-xls-iis/3-best';
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
                            var filename = (matches != null && matches[1] ? matches[1] : 'Export-Nilai-Rangking-Siswa-Iis-3-Terbaik.xlsx');

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
                })

                jQuery('.btn-export-data').click(function() {
                    // show the modal
                    const el = document.querySelector('#header-export-footer-modal-preview');
                    const modal = tailwind.Modal.getOrCreateInstance(el);
                    modal.show();
                });
                jQuery('.btn-export').on('click', function() {
                    // Ambil nilai dari select option untuk 'Tahun Ajar', 'Export Data', dan 'Jenis Export'
                    var periode = jQuery('.form-export-periode').val();
                    var exportData = jQuery('.form-export-data').val();
                    var exportType = jQuery('.form-export-jenis-data').val();

                    // Validasi: Pastikan semua field diisi
                    if (!periode || !exportData || !exportType) {
                        alert('Pastikan semua pilihan telah diisi!');
                        return;
                    }

                    // Buat request AJAX untuk export data
                    jQuery.ajax({
                        url: 'http://127.0.0.1:8000/api/data-penilaian/nilai-perangkingan/export-data/export',
                        method: 'POST',
                        headers: {
                            'Authorization': 'Bearer ' + token, // Pastikan variabel token sudah didefinisikan dengan benar
                        },
                        data: {
                            periode: periode, // Kirim sebagai 'periode' sesuai validasi di controller
                            exportData: exportData,
                            exportType: exportType,
                        },
                        success: function(response) {
                            // Jika export type PDF, redirect ke halaman yang mengandung window.print
                            if (exportType === 'PDF') {
                                window.location.href = response.url; 
                            }
                            // Jika export type Excel, browser akan memulai download otomatis
                            else if (exportType === 'Excel') {
                                window.location.href = response.url;
                            }
                        },
                        error: function(xhr, status, error) {
                            console.error('Terjadi kesalahan:', error);
                            alert('Export data gagal. Silakan coba lagi.');
                        }
                    });
                });
                
            })
        </script>
        <!-- END: JS Assets -->
    </body>
</html>