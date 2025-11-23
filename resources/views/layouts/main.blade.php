<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    
    {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
</head>
<body
    x-data="{ 
        page: 'dashboard', 
        loaded: true, 
        darkMode: $persist(false), 
        stickyMenu: false, 
        sidebarToggle: false, 
        scrollTop: false 
    }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}"
    class="font-sans text-base font-normal text-gray-900 dark:text-gray-100"
>
    <div x-show="!loaded" x-transition class="fixed top-0 left-0 flex items-center justify-center w-screen h-screen bg-white z-999999 dark:bg-black">
        <div class="w-16 h-16 border-4 border-solid rounded-full animate-spin border-primary border-t-transparent"></div>
    </div>
    <div class="flex h-screen overflow-hidden">
        
        @include('layouts.partial.sidebar')
        <div class="relative flex flex-col flex-1 overflow-x-hidden overflow-y-auto">
            
            @include('layouts.partial.header')
            <main>
                {{-- <div class="p-4 mx-auto max-w-screen-2xl md:p-6 2xl:p-10">
                    {{ $slot }}
                </div> --}}
            </main>
            </div>
        </div>
    </body>
</html>