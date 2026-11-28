@props(['title' => ''])
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?: 'SPK Aset Idle' }} — Telkom Property</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-mist font-sans text-ink">
@php
    $ic = fn ($d) => '<svg class="h-5 w-5 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.6"><path stroke-linecap="round" stroke-linejoin="round" d="'.$d.'"/></svg>';
    $menu = [
        ['dashboard', 'Dashboard Utilisasi', 'dashboard', 'M3 13h8V3H3v10zm0 8h8v-6H3v6zm10 0h8V11h-8v10zm0-18v6h8V3h-8z'],
        ['wilayah.index', 'Data Wilayah', 'wilayah*', 'M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0zM15 11a3 3 0 11-6 0 3 3 0 016 0z'],
        ['aset.index', 'Data Aset', 'aset*', 'M3 21h18M5 21V7l7-4 7 4v14M9 21v-6h6v6'],
        ['kriteria.index', 'Kriteria', 'kriteria*', 'M4 6h16M4 12h10M4 18h6'],
        ['penilaian', 'Penilaian Alternatif', 'penilaian', 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
        ['perhitungan.index', 'Perhitungan', 'perhitungan*', 'M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z'],
        ['peringkat', 'Peringkat Prioritas', 'peringkat', 'M5 3v18M5 4h11l-2 4 2 4H5'],
        ['profil', 'Profil Saya', 'profil*', 'M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z'],
    ];
@endphp
<aside class="fixed inset-y-0 left-0 flex w-[248px] flex-col border-r border-line bg-white">
    <a href="{{ route('dashboard') }}" class="flex h-[76px] items-center gap-2.5 border-b border-line px-5">
        <img src="{{ asset('images/logo.png') }}" alt="Telkom Property" class="h-9 w-9 object-contain">
        <span class="leading-tight"><span class="block font-bold">Telkom Property</span><span class="block text-[11px] text-gray-400">SPK Aset Idle · Admin</span></span>
    </a>
    <p class="px-6 pb-2 pt-5 text-[11px] font-semibold uppercase tracking-widest text-gray-400">Menu</p>
    <nav class="flex-1 space-y-1 px-3 text-sm font-medium">
        @foreach ($menu as [$route, $label, $pattern, $icon])
            <a href="{{ route($route) }}" class="flex items-center gap-3 rounded-lg px-3 py-2.5 transition {{ request()->routeIs($pattern) ? 'bg-tel/10 font-semibold text-tel' : 'text-gray-600 hover:bg-gray-100' }}">{!! $ic($icon) !!}{{ $label }}</a>
        @endforeach
    </nav>
    <a href="{{ route('beranda') }}" class="btn-o m-4">Lihat situs publik ↗</a>
</aside>
<div class="ml-[248px]">
    <header class="sticky top-0 z-10 flex h-[76px] items-center justify-between border-b border-line bg-white/95 px-8 backdrop-blur">
        <div><p class="eyebrow">Panel Admin</p><h1 class="text-xl font-bold">{{ $title }}</h1></div>
        <form method="POST" action="{{ route('logout') }}" class="flex items-center gap-3 text-sm">
            @csrf
            <span class="grid h-9 w-9 place-items-center rounded-full bg-tel/10 font-semibold text-tel">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</span>
            <span class="font-medium">{{ auth()->user()->name }}</span><button class="btn-o ml-2">Keluar</button>
        </form>
    </header>
    <main class="space-y-6 p-8">
        @if (session('ok')) <div class="rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">{{ session('ok') }}</div> @endif
        @foreach (['hapus', 'hitung'] as $k) @error($k) <div class="rounded-lg bg-red-50 px-4 py-3 text-sm text-tel">{{ $message }}</div> @enderror @endforeach
        {{ $slot }}
    </main>
</div>
</body>
</html>
