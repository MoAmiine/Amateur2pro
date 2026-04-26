<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} | Amateur2Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Space+Grotesk:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Space Grotesk', 'sans-serif'],
                        display: ['Rajdhani', 'sans-serif']
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-950 text-white min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-56 min-h-screen bg-slate-900/60 border-r border-white/10 flex flex-col fixed top-0 left-0">

        {{-- Logo --}}
        <div class="h-16 flex items-center px-5 border-b border-white/10">
            <a href="/" class="font-display text-2xl font-bold italic tracking-widest">
                A2<span class="text-purple-500">P</span>
                <span class="text-[10px] text-slate-500 font-sans font-normal ml-2 uppercase tracking-widest">Admin</span>
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 px-3 py-4 space-y-1">

            @php
                $links = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard'],
                    ['route' => 'admin.users',     'label' => 'Utilisateurs'],
                    ['route' => 'admin.tournois',  'label' => 'Tournois'],
                    ['route' => 'admin.equipes',   'label' => 'Équipes'],
                ];
            @endphp

            @foreach ($links as $link)
                @if (request()->routeIs($link['route']))
                    <a href="{{ route($link['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 text-[11px] font-bold uppercase tracking-widest border-l-2 border-purple-500 bg-purple-600/10 text-purple-400">
                         {{ $link['label'] }}
                    </a>
                @else
                    <a href="{{ route($link['route']) }}"
                       class="flex items-center gap-3 px-3 py-2.5 text-[11px] font-bold uppercase tracking-widest border-l-2 border-transparent text-slate-400 hover:text-white hover:bg-white/5 transition">
                         {{ $link['label'] }}
                    </a>    
                @endif
            @endforeach

        </nav>

        {{-- Footer --}}
        <div class="px-3 py-4 border-t border-white/10 space-y-1">

            <a href="{{ route('tournois') }}"
               class="flex items-center gap-3 px-3 py-2.5 text-[11px] text-slate-500 hover:text-white uppercase tracking-widest transition">
                ← Site
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="w-full flex items-center gap-3 px-3 py-2.5 text-[11px] text-red-500 hover:text-red-400 uppercase tracking-widest transition text-left">
                    ⏻ Déconnexion
                </button>
            </form>

        </div>

    </aside>

    {{-- Main --}}
    <div class="ml-56 flex-1 min-h-screen flex flex-col">

        {{-- Topbar --}}
        <header class="h-16 border-b border-white/10 flex items-center justify-between px-8 bg-slate-950/80 sticky top-0 z-10 backdrop-blur">
            <h1 class="font-display text-lg font-bold uppercase tracking-widest">
                {{ $title ?? 'Dashboard' }}
            </h1>
            <span class="text-[10px] text-slate-500 uppercase tracking-widest">
                {{ auth()->user()->name }}
            </span>
        </header>

        {{-- Content --}}
        <main class="p-8 flex-1">

            @if (session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/30 text-green-400 px-5 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-6 bg-red-500/10 border border-red-500/30 text-red-400 px-5 py-3 text-sm">
                    {{ session('error') }}
                </div>
            @endif

            {{ $slot }}

        </main>

    </div>

</body>
</html>