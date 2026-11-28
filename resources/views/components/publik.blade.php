@props(['title' => ''])
<!DOCTYPE html>
<html lang="id"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>{{ $title ?: 'Telkom Property' }} — Telkom Property</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">@vite('resources/css/app.css')</head>
<body class="flex min-h-screen flex-col bg-mist font-sans text-ink">
<header class="sticky top-0 z-20 border-b border-line bg-white/95 backdrop-blur">
    <div class="wrap flex h-[76px] items-center gap-10">
        <a href="{{ route('beranda') }}" class="flex items-center gap-2.5">
            <img src="{{ asset('images/logo.png') }}" alt="Telkom Property" class="h-9 w-9 object-contain">
            <span class="leading-tight"><span class="block font-bold">Telkom Property</span><span class="block text-[11px] text-gray-400">PT Graha Sarana Duta</span></span>
        </a>
        <nav class="flex items-center gap-2 text-sm font-medium">
            @foreach ([['beranda', 'Beranda', 'beranda'], ['katalog', 'Katalog Aset', 'katalog*'], ['prioritas', 'Peringkat Prioritas', 'prioritas*']] as [$r, $l, $p])
                <a href="{{ route($r) }}" class="rounded-lg px-3.5 py-2 transition {{ request()->routeIs($p) ? 'bg-tel/10 font-semibold text-tel' : 'text-gray-600 hover:bg-gray-100' }}">{{ $l }}</a>
            @endforeach
        </nav>
        <a href="{{ auth()->check() ? route('dashboard') : route('login') }}" class="btn ml-auto">
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M20 21a8 8 0 1 0-16 0M12 11a4 4 0 1 0 0-8 4 4 0 0 0 0 8z"/></svg>
            {{ auth()->check() ? 'Panel Admin' : 'Masuk Admin' }}
        </a>
    </div>
</header>
<main class="flex-1">{{ $slot }}</main>
<footer class="bg-ink text-sm text-white/60">
    <div class="wrap flex gap-16 py-14">
        <div class="flex-1 space-y-3">
            <p class="flex items-center gap-2 text-base font-bold text-white"><img src="{{ asset('images/logo.png') }}" alt="" class="h-7 w-7 object-contain">Telkom Property</p>
            <p class="max-w-sm text-xs leading-relaxed">Sistem pendukung keputusan prioritas pemanfaatan aset properti idle PT Graha Sarana Duta, Area Jawa Timur Bagian Timur.</p>
        </div>
        @foreach (['Navigasi' => [['beranda', 'Beranda'], ['katalog', 'Katalog Aset'], ['prioritas', 'Peringkat Prioritas']], 'Unduhan' => [['katalog.pdf', 'Katalog Aset (PDF)'], ['prioritas.pdf', 'Peringkat Prioritas (PDF)']], 'Akses' => [['login', 'Masuk Admin']]] as $judul => $links)
            <div class="w-48 space-y-3"><p class="font-semibold text-white">{{ $judul }}</p>
                <ul class="space-y-2 text-xs">@foreach ($links as [$r, $l])<li><a href="{{ route($r) }}" class="hover:text-white">{{ $l }}</a></li>@endforeach</ul>
            </div>
        @endforeach
    </div>
    <div class="wrap flex justify-between border-t border-white/10 py-6 text-xs"><span>© {{ date('Y') }} PT Graha Sarana Duta — Telkom Property</span><span>Peringkat adalah bahan pertimbangan, bukan keputusan akhir.</span></div>
</footer>
</body></html>
