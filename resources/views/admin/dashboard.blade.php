{{-- Di bagian sidebar, ganti link logout --}}
<aside class="sidebar">
    <h2 class="sidebar-logo">RSHP</h2>
    <ul class="sidebar-menu">
        <li><a href="{{ route('admin.dashboard') }}" class="active">Dashboard</a></li>
        <li><a href="{{ route('admin.jenis-hewan.index') }}">Jenis Hewan</a></li>
        <li><a href="{{ route('admin.pemilik.index') }}">Pemilik</a></li>
        <li><a href="{{ route('admin.ras-hewan.index') }}">Ras Hewan</a></li>
        <li><a href="{{ route('admin.kategori.index') }}">Kategori</a></li>
        <li><a href="{{ route('admin.kategori-klinis.index') }}">Kategori Klinis</a></li>
        <li><a href="{{ route('admin.tindakan-terapi.index') }}">Tindakan & Terapi</a></li>
        <li><a href="{{ route('admin.user.index') }}">Manajemen User</a></li>
        <li><a href="{{ route('admin.role.index') }}">Manajemen Role</a></li>
        <li><a href="{{ route('admin.pet.index') }}">Data Hewan Peliharaan</a></li>
        <li><a href="{{ route('admin.role-user.index') }}">Penetapan Role User</a></li>
        {{-- Ganti link logout dengan form POST --}}
        <li>
            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                @csrf
                <button type="submit" class="logout-btn" style="width: 100%; text-align: left; background: none; border: none; cursor: pointer; padding: 12px 20px; color: #ff4b5c; font-weight: bold;">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</aside>

@extends('layouts.sidebar')