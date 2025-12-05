@extends('layouts.partial.main')

@section('title', 'Antrian Temu Dokter')
@section('page-title', 'Temu Dokter')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        
        {{-- Tampilkan Alert Sukses --}}
        @if(session('success'))
            <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                <span class="font-medium">Berhasil!</span> {{ session('success') }}
            </div>
        @endif

        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            
            <div class="flex items-center justify-between p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <div>
                    <h6 class="font-bold">Antrian Hari Ini ({{ date('d M Y') }})</h6>
                    <p class="mb-0 text-xs text-slate-400">Pantau antrian dan kelola status pemeriksaan.</p>
                </div>
                <a href="{{ route('resepsionis.registrasi.temudokter.create') }}" class="inline-block px-6 py-3 text-xs font-bold text-center text-white uppercase align-middle transition-all rounded-lg cursor-pointer bg-gradient-to-tl from-purple-700 to-pink-500 leading-pro ease-soft-in tracking-tight-rem shadow-soft-md bg-150 bg-x-25 hover:scale-102 active:opacity-85 hover:shadow-soft-xs">
                    <i class="mr-2 fas fa-plus"></i> Tambah Antrian
                </a>
            </div>

            <div class="flex-auto px-0 pt-0 pb-2">
                <div class="p-0 overflow-x-auto">
                    <table class="items-center w-full mb-0 align-top border-gray-200 text-slate-500">
                        <thead class="align-bottom">
                            <tr>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Nama Pet / Pemilik</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Dokter</th>
                                <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Waktu Daftar</th>
                                <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($temuDokter as $index => $item)
                            <tr>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <span class="text-xs font-semibold leading-tight text-slate-400">{{ $index + 1 }}</span>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <div class="px-3 py-1">
                                        <h6 class="mb-0 text-sm font-semibold leading-tight">{{ $item->nama_pet }}</h6>
                                        <p class="mb-0 text-xs leading-tight text-slate-400">
                                            Pemilik: {{ $item->nama_pemilik }}
                                        </p>
                                    </div>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="px-3 mb-0 text-xs font-semibold leading-tight">{{ $item->nama_dokter }}</p>
                                </td>
                                <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <p class="px-3 mb-0 text-xs font-semibold leading-tight">
                                        {{ \Carbon\Carbon::parse($item->waktu_daftar)->timezone('Asia/Jakarta')->format('d M Y') }}<br>
                                        {{ \Carbon\Carbon::parse($item->waktu_daftar)->timezone('Asia/Jakarta')->format('H:i:s') }}
                                    </p>

                                </td>
                                <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                    <form action="{{ route('resepsionis.registrasi.temudokter.updateStatus', $item->idreservasi_dokter) }}" method="POST">
                                        @csrf @method('PUT')
                                        <select name="status" onchange="this.form.submit()" 
                                            class="text-xs font-semibold leading-tight rounded px-2 py-1 
                                            {{ $item->status == '1' ? 'bg-yellow-100 text-yellow-800' : '' }}
                                            {{ $item->status == '2' ? 'bg-blue-100 text-blue-800' : '' }}
                                            {{ $item->status == '3' ? 'bg-green-100 text-green-800' : '' }}
                                            border-none">
                                            <option value="1" {{ $item->status == '1' ? 'selected' : '' }}>Menunggu</option>
                                            <option value="2" {{ $item->status == '2' ? 'selected' : '' }}>Diperiksa</option>
                                            <option value="3" {{ $item->status == '3' ? 'selected' : '' }}>Selesai</option>
                                        </select>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="py-6 text-center text-slate-400">
                                    <div class="flex flex-col items-center justify-center">
                                        <i class="mb-2 text-3xl fas fa-clipboard-list text-slate-300"></i>
                                        <span class="text-sm">Belum ada antrian untuk hari ini.</span>
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Detail --}}
<div id="detailModal" class="fixed inset-0 z-50 hidden overflow-y-auto bg-opacity-50 bg-slate-900">
    <div class="flex items-center justify-center min-h-screen px-4">
        <div class="relative w-full max-w-lg bg-white rounded-lg shadow-xl">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-bold text-slate-700">Detail Antrian</h3>
                    <button onclick="closeDetail()" class="text-slate-400 hover:text-slate-700">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="space-y-3">
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Nama Pet:</p>
                        <p id="modal_pet" class="text-sm text-slate-700"></p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Pemilik:</p>
                        <p id="modal_pemilik" class="text-sm text-slate-700"></p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Dokter:</p>
                        <p id="modal_dokter" class="text-sm text-slate-700"></p>
                    </div>
                    <div>
                        <p class="text-xs font-semibold text-slate-500">Keluhan:</p>
                        <p id="modal_keluhan" class="text-sm text-slate-700"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showDetail(pet, pemilik, dokter, keluhan) {
    document.getElementById('modal_pet').textContent = pet;
    document.getElementById('modal_pemilik').textContent = pemilik;
    document.getElementById('modal_dokter').textContent = dokter;
    document.getElementById('modal_keluhan').textContent = keluhan;
    document.getElementById('detailModal').classList.remove('hidden');
}

function closeDetail() {
    document.getElementById('detailModal').classList.add('hidden');
}
</script>
@endsection