@extends('layouts.partial.main')

@section('title', 'Registrasi Pemilik')
@section('page-title', 'Registrasi Pemilik')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Registrasi Pemilik Baru</h6>
            </div>

            <div class="flex-auto p-6">
                {{-- Sesuaikan route action ini dengan route Anda, misal: route('resepsionis.pemilik.store') --}}
                <form action="#" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Nama Lengkap</label>
                        <input type="text" name="nama" required 
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none" 
                            placeholder="Nama lengkap pemilik" />
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Email</label>
                        <input type="email" name="email" required 
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                            placeholder="contoh@email.com" />
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Nomor WhatsApp</label>
                        <input type="text" name="no_wa" required 
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                            placeholder="08xxxxxxxx" />
                    </div>

                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Alamat</label>
                        <textarea name="alamat" rows="3" required 
                            class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none"
                            placeholder="Alamat lengkap"></textarea>
                    </div>

                    <div class="mt-6 text-center">
                        <button type="submit" class="inline-block w-full px-6 py-3 text-xs font-bold text-center text-white uppercase align-middle transition-all bg-transparent border-0 rounded-lg cursor-pointer shadow-soft-md bg-150 bg-x-25 bg-gradient-to-tl from-purple-700 to-pink-500 hover:scale-102 active:opacity-85 hover:shadow-soft-xs leading-pro ease-soft-in tracking-tight-rem sm:w-auto">
                            Daftarkan Pemilik
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection