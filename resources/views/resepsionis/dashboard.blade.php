@extends('layouts.partial.main')

@section('title', 'Dashboard Resepsionis')
@section('page-title', 'Dashboard')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Dashboard Resepsionis</h6>
            </div>
            <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none">
                        <a href="{{ route('resepsionis.registrasi.pemilik') }}">
                            <div class="relative flex flex-col min-w-0 break-words transition-all bg-white shadow-soft-xl rounded-2xl bg-clip-border hover:shadow-soft-2xl">
                                <div class="flex-auto p-4 text-center">
                                    <div class="inline-block w-12 h-12 mb-2 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                                        <i class="fas fa-user-plus text-lg relative top-3.5 text-white"></i>
                                    </div>
                                    <h6 class="mb-1 font-bold">Registrasi Pemilik</h6>
                                    <span class="text-xs text-slate-400">Daftarkan pemilik hewan baru</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none">
                        <a href="{{ route('resepsionis.registrasi.index_pet') }}">
                            <div class="relative flex flex-col min-w-0 break-words transition-all bg-white shadow-soft-xl rounded-2xl bg-clip-border hover:shadow-soft-2xl">
                                <div class="flex-auto p-4 text-center">
                                    <div class="inline-block w-12 h-12 mb-2 text-center rounded-lg bg-gradient-to-tl from-blue-600 to-cyan-400">
                                        <i class="fas fa-paw text-lg relative top-3.5 text-white"></i>
                                    </div>
                                    <h6 class="mb-1 font-bold">Registrasi Pet</h6>
                                    <span class="text-xs text-slate-400">Daftarkan hewan peliharaan</span>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/3 sm:flex-none">
                        <a href="{{ route('resepsionis.registrasi.temudokter') }}">
                            <div class="relative flex flex-col min-w-0 break-words transition-all bg-white shadow-soft-xl rounded-2xl bg-clip-border hover:shadow-soft-2xl">
                                <div class="flex-auto p-4 text-center">
                                    <div class="inline-block w-12 h-12 mb-2 text-center rounded-lg bg-gradient-to-tl from-orange-600 to-yellow-400">
                                        <i class="fas fa-clipboard-list text-lg relative top-3.5 text-white"></i>
                                    </div>
                                    <h6 class="mb-1 font-bold">Antrian Dokter</h6>
                                    <span class="text-xs text-slate-400">Lihat atau tambah antrian</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection