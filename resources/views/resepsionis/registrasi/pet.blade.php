@extends('layouts.partial.main')

@section('title', 'Registrasi Pet')
@section('page-title', 'Registrasi Pet')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Registrasi Hewan Peliharaan</h6>
            </div>

            <div class="flex-auto p-6">
                {{-- Sesuaikan route action ini --}}
                <form action="#" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Pilih Pemilik</label>
                        <select name="idpemilik" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                            <option value="">-- Cari Pemilik --</option>
                            {{-- @foreach($pemilik as $p) <option value="{{ $p->id }}">{{ $p->nama }}</option> @endforeach --}}
                        </select>
                    </div>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Nama Pet</label>
                            <input type="text" name="nama_pet" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Nama hewan" />
                        </div>
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Tanggal Lahir (Estimasi)</label>
                            <input type="date" name="tanggal_lahir" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" />
                        </div>
                    </div>

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Jenis Hewan</label>
                            <select name="idjenis_hewan" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                <option value="">-- Pilih Jenis --</option>
                            </select>
                        </div>
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Ras Hewan</label>
                            <select name="idras_hewan" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                <option value="">-- Pilih Ras --</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Warna / Tanda Khusus</label>
                        <input type="text" name="warna_tanda" class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" placeholder="Contoh: Putih, ada tompel di kuping kanan" />
                    </div>

                    <div class="mt-6 text-center">
                        <button type="submit" class="inline-block w-full px-6 py-3 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-purple-700 to-pink-500 hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro ease-soft-in tracking-tight-rem sm:w-auto">
                            Simpan Data Pet
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection