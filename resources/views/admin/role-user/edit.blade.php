@extends('layouts.partial.main')

@section('title', 'Edit Role User')
@section('page-title', 'Edit Role User')

@section('content')
<div class="flex flex-wrap -mx-3">
    <div class="flex-none w-full max-w-full px-3">
        <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-soft-xl rounded-2xl bg-clip-border">
            <div class="p-6 pb-0 mb-0 bg-white border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                <h6 class="font-bold">Form Edit Role User</h6>
            </div>
            <div class="flex-auto p-6">
                {{-- Asumsi ID RoleUser adalah $roleUser->id --}}
                <form action="{{ route('admin.role-user.update', $roleUser->idrole_user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-wrap -mx-3">
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="iduser" class="mb-2 ml-1 text-xs font-bold text-slate-700">User</label>
                            <select name="iduser" id="iduser" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                @foreach($user as $u)
                                    <option value="{{ $u->iduser }}" {{ old('iduser', $roleUser->iduser) == $u->iduser ? 'selected' : '' }}>
                                        {{ $u->nama }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full max-w-full px-3 mb-4 md:w-1/2 md:flex-none">
                            <label for="idrole" class="mb-2 ml-1 text-xs font-bold text-slate-700">Role</label>
                            <select name="idrole" id="idrole" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                                @foreach($role as $r)
                                    <option value="{{ $r->idrole }}" {{ old('idrole', $roleUser->idrole) == $r->idrole ? 'selected' : '' }}>
                                        {{ $r->nama_role }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="status" class="mb-2 ml-1 text-xs font-bold text-slate-700">Status</label>
                        <select name="status" id="status" required class="focus:shadow-soft-primary-outline text-sm leading-5.6 ease-soft block w-full appearance-none rounded-lg border border-solid border-gray-300 bg-white bg-clip-padding px-3 py-2 font-normal text-gray-700 outline-none transition-all placeholder:text-gray-500 focus:border-fuchsia-300 focus:outline-none">
                            <option value="1" {{ old('status', $roleUser->status) == '1' ? 'selected' : '' }}>Aktif</option>
                            <option value="0" {{ old('status', $roleUser->status) == '0' ? 'selected' : '' }}>Non Aktif</option>
                        </select>
                    </div>

                    <div class="flex items-center justify-end mt-6">
                        <a href="{{ route('admin.role-user.index') }}" class="inline-block px-6 py-3 mb-0 mr-2 text-xs font-bold text-center align-middle transition-all bg-transparent border rounded-lg cursor-pointer text-slate-700 border-slate-700 leading-pro ease-soft-in shadow-soft-xs hover:scale-102 active:opacity-85 hover:bg-slate-700 hover:text-white hover:shadow-soft-xs">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="inline-block px-6 py-3 mb-0 text-xs font-bold text-center text-white uppercase align-middle transition-all border-0 rounded-lg cursor-pointer hover:scale-102 active:opacity-85 hover:shadow-soft-xs bg-gradient-to-tl from-purple-700 to-pink-500 leading-pro ease-soft-in tracking-tight-rem shadow-soft-md bg-150 bg-x-25">
                            <i class="fas fa-save"></i> Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection