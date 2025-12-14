@extends('layouts.partial.main')

@section('title', 'Dashboard Dokter')
@section('page-title', 'Dashboard')

@section('content')
<div class="flex flex-wrap -mx-3">
    
    {{-- Card 1: Pasien Hari Ini --}}
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Pasien Hari Ini</p>
                            <h5 class="mb-0 font-bold">
                                {{ $pasienHariIni }}
                                <span class="text-sm leading-normal font-weight-bolder text-lime-500">Orang</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="fas fa-users text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Card 2: Menunggu --}}
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Menunggu</p>
                            <h5 class="mb-0 font-bold">
                                {{ $pasienMenunggu }}
                                <span class="text-sm leading-normal text-orange-500 font-weight-bolder">Antrian</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="fas fa-clock text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Card 3: Selesai --}}
    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Selesai Diperiksa</p>
                            <h5 class="mb-0 font-bold">
                                {{ $pasienSelesai }}
                                <span class="text-sm leading-normal text-green-500 font-weight-bolder">Pasien</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="fas fa-check-circle text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Card 4: Total Semua --}}
    <div class="w-full max-w-full px-3 sm:w-1/2 sm:flex-none xl:w-1/4">
        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="flex-auto p-4">
                <div class="flex flex-row -mx-3">
                    <div class="flex-none w-2/3 max-w-full px-3">
                        <div>
                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Total Riwayat</p>
                            <h5 class="mb-0 font-bold">
                                {{ $totalPasien }}
                                <span class="text-sm leading-normal text-blue-500 font-weight-bolder">Total</span>
                            </h5>
                        </div>
                    </div>
                    <div class="px-3 text-right basis-1/3">
                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500">
                            <i class="fas fa-folder-open text-lg relative top-3.5 text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="mt-6">
    <div class="p-6 bg-white border-0 shadow-soft-xl rounded-2xl">
        <h6 class="font-bold">Selamat Datang, Dokter!</h6>
        <p class="text-sm text-slate-500">
            Anda memiliki <strong class="text-purple-600">{{ $pasienMenunggu }}</strong> pasien yang menunggu pemeriksaan hari ini.
            Silakan akses menu <a href="{{ route('dokter.detail-rekam-medis.index') }}" class="text-blue-500 underline">Detail Rekam Medis</a> untuk memulai pemeriksaan.
        </p>
    </div>
</div>
@endsection