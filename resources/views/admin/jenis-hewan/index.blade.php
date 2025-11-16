{{-- resources/views/admin/jenis-hewan/index.blade.php --}}

@extends('layouts.sidebar')

@section('title', 'Daftar Jenis Hewan')
@section('page_name', 'jenis-hewan')

@section('breadcrumb')
<div x-data="{ pageName: `Jenis Hewan`}">
  <nav class="mb-6 flex" aria-label="Breadcrumb">
    <ol class="inline-flex items-center space-x-1 md:space-x-3">
      <li class="inline-flex items-center">
        <a href="{{ route('admin.dashboard') }}" class="text-theme-sm inline-flex items-center font-medium text-gray-700 hover:text-brand-500">
          <svg class="mr-2.5 h-3 w-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="m19.707 9.293-2-2-7-7a1 1 0 0 0-1.414 0l-7 7-2 2a1 1 0 0 0 1.414 1.414L2 10.414V18a2 2 0 0 0 2 2h3a1 1 0 0 0 1-1v-4a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1v4a1 1 0 0 0 1 1h3a2 2 0 0 0 2-2v-7.586l.293.293a1 1 0 0 0 1.414-1.414Z"/>
          </svg>
          Dashboard
        </a>
      </li>
      <li>
        <div class="flex items-center">
          <svg class="h-6 w-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path>
          </svg>
          <span class="text-theme-sm ml-1 font-medium text-gray-400 md:ml-2" x-text="pageName"></span>
        </div>
      </li>
    </ol>
  </nav>
</div>
@endsection

@section('content')
<div class="rounded-2xl border border-gray-200 bg-white p-6 shadow-sm">
  <div class="mb-6 flex items-center justify-between">
    <h2 class="text-title-md font-semibold text-gray-900">Daftar Jenis Hewan</h2>
    <a href="{{ route('admin.jenis-hewan.create') }}" 
       class="inline-flex items-center gap-2 rounded-lg bg-brand-500 px-5 py-2.5 text-sm font-medium text-white hover:bg-brand-600 focus:outline-none focus:ring-4 focus:ring-brand-300">
      <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
      </svg>
      Tambah Jenis Hewan
    </a>
  </div>

  <div class="overflow-x-auto">
    <table class="w-full text-left text-sm text-gray-500">
      <thead class="bg-gray-50 text-xs uppercase text-gray-700">
        <tr>
          <th scope="col" class="px-6 py-3">No</th>
          <th scope="col" class="px-6 py-3">Nama Jenis Hewan</th>
          <th scope="col" class="px-6 py-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        @forelse ($jenisHewan as $index => $hewan)
        <tr class="border-b bg-white hover:bg-gray-50">
          <td class="px-6 py-4">{{ $index + 1 }}</td>
          <td class="px-6 py-4 font-medium text-gray-900">{{ $hewan->nama_jenis_hewan }}</td>
          <td class="px-6 py-4">
            <div class="flex items-center gap-2">
              {{-- <a href="{{ route('admin.jenis-hewan.edit', $hewan->idjenis_hewan) }}"  --}}
                 class="inline-flex items-center gap-1 rounded-lg bg-success-500 px-3 py-2 text-xs font-medium text-white hover:bg-success-600">
                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                </svg>
                Edit
              </a>
              {{-- <form action="{{ route('admin.jenis-hewan.destroy', $hewan->idjenis_hewan) }}" method="POST" class="inline"> --}}
                @csrf
                @method('DELETE')
                <button type="submit" 
                        onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"
                        class="inline-flex items-center gap-1 rounded-lg bg-error-500 px-3 py-2 text-xs font-medium text-white hover:bg-error-600">
                  <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                  </svg>
                  Hapus
                </button>
              </form>
            </div>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="3" class="px-6 py-4 text-center text-gray-500">Tidak ada data jenis hewan.</td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>
</div>
@endsection