@extends('layouts.partial.main')

@section('title', 'Dashboard Perawat')
@section('page-title', 'Dashboard')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Halo, Perawat {{ Auth::user()->nama ?? '' }}</h6>
            </div>
            <div class="flex-auto p-6">
                <p class="text-slate-500">Selamat datang di panel Perawat RSHP. Anda dapat mengelola input TTV dan data awal pemeriksaan pasien melalui menu <strong>Rekam Medis</strong>.</p>
            </div>
        </div>
    </div>
</div>
@endsection