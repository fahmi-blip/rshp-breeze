@extends('layouts.partial.main')

@section('title', 'Dashboard Dokter')
@section('page-title', 'Dashboard')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Selamat Datang, Dokter {{ Auth::user()->nama ?? '' }}</h6>
            </div>
            <div class="flex-auto p-6">
                <div class="flex flex-wrap -mx-3">
                    <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 sm:flex-none xl:mb-0 xl:w-1/4">
                        <div class="relative flex flex-col min-w-0 break-words bg-white shadow-soft-xl rounded-2xl bg-clip-border">
                            <div class="flex-auto p-4">
                                <div class="flex flex-row -mx-3">
                                    <div class="flex-none w-2/3 max-w-full px-3">
                                        <div>
                                            <p class="mb-0 font-sans text-sm font-semibold leading-normal">Pasien Hari Ini</p>
                                            <h5 class="mb-0 font-bold">0 <span class="text-sm leading-normal text-lime-500 font-weight-bolder">Orang</span></h5>
                                        </div>
                                    </div>
                                    <div class="px-3 text-right basis-1/3">
                                        <div class="inline-block w-12 h-12 text-center rounded-lg bg-gradient-to-tl from-green-600 to-lime-400">
                                            <i class="fas fa-user-injured text-lg relative top-3.5 text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                
                <div class="pt-4 mt-6 border-t">
                    <p class="text-slate-500">Silakan pilih menu <strong>Detail Rekam Medis</strong> di sidebar untuk mulai memeriksa data pasien.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection