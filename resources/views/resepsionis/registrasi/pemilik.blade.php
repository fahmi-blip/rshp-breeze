@extends('layouts.partial.main')

@section('title', 'Registrasi Pemilik')
@section('page-title', 'Registrasi Pemilik')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white shadow-soft-xl rounded-2xl">

            <div class="p-6 pb-0 mb-0 bg-white rounded-t-2xl">
                <h6 class="font-bold">Form Registrasi Pemilik Baru</h6>
            </div>

            <div class="flex-auto p-6">

                {{-- Success Alert --}}
                @if (session('success'))
                    <div class="p-4 mb-4 text-sm text-white bg-green-500 rounded-lg">
                        {{ session('success') }}
                    </div>
                @endif

                {{-- Error Alert --}}
                @if (session('error'))
                    <div class="p-4 mb-4 text-sm text-white bg-red-500 rounded-lg">
                        {{ session('error') }}
                    </div>
                @endif

                {{-- List Error --}}
                @if ($errors->any())
                    <div class="p-4 mb-4 text-sm text-white bg-red-600 rounded-lg">
                        <ul class="ml-4 list-disc">
                            @foreach ($errors->all() as $err)
                                <li>{{ $err }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('resepsionis.registrasi.pemilik.store') }}" method="POST">
                    @csrf

                    {{-- Nama --}}
                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama') }}"
                            class="text-sm block w-full rounded-lg border 
                            @error('nama') border-red-500 @else border-gray-300 @enderror
                            px-3 py-2"
                            placeholder="Nama lengkap pemilik" required>
                    </div>

                    {{-- Email --}}
                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="text-sm block w-full rounded-lg border
                            @error('email') border-red-500 @else border-gray-300 @enderror
                            px-3 py-2"
                            placeholder="contoh@email.com" required>
                    </div>

                    {{-- Password --}}
                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Password</label>
                        <input type="password" name="password"
                            class="text-sm block w-full rounded-lg border
                            @error('password') border-red-500 @else border-gray-300 @enderror
                            px-3 py-2" required>
                    </div>

                    {{-- WhatsApp --}}
                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Nomor WhatsApp</label>
                        <input type="text" name="no_wa" value="{{ old('no_wa') }}"
                            minlength="10" maxlength="20" pattern="[0-9]+"
                            class="text-sm block w-full rounded-lg border
                            @error('no_wa') border-red-500 @else border-gray-300 @enderror
                            px-3 py-2"
                            placeholder="08xxxxxxxx" required>
                    </div>

                    {{-- Alamat --}}
                    <div class="mb-4">
                        <label class="mb-2 ml-1 text-xs font-bold text-slate-700">Alamat</label>
                        <textarea name="alamat" rows="3"
                            class="text-sm block w-full rounded-lg border
                            @error('alamat') border-red-500 @else border-gray-300 @enderror
                            px-3 py-2" required>{{ old('alamat') }}</textarea>
                    </div>

                    {{-- Submit --}}
                    <div class="mt-6 text-center">
                        <button type="submit"
                            class="px-6 py-3 text-xs font-bold text-white uppercase transition rounded-lg bg-gradient-to-tl from-purple-700 to-pink-500 hover:scale-105">
                            Daftarkan Pemilik
                        </button>
                    </div>

                </form>
            </div>

        </div>
    </div>
</div>
@endsection
