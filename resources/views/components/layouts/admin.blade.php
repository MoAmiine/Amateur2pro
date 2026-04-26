<!DOCTYPE html>
<html lang="fr" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} | Amateur2Pro</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Space+Grotesk:wght@300;400;500&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Space Grotesk'],
                        display: ['Rajdhani']
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-950 text-white min-h-screen flex">

    <aside class="w-64 min-h-screen bg-slate-900/60 border-r border-white/10 flex flex-col fixed top-0 left-0">

        <div class="h-20 flex items-center px-6 border-b border-white/10">
            <a href="/" class="text-3xl font-display font-bold italic tracking-widest">
                A2<span class="text-purple-500">P</span>
                <span class="text-xs text-slate-500 font-sans font-normal ml-2 uppercase tracking-widest">Admin</span>
            </a>
        </div>

        <nav class="flex-1 px-4 py-6 space-y-1">
            @php
                $links = [
                    ['route' => 'admin.dashboard', 'label' => 'Dashboard', 'icon' => '▦'],
                    ['route' => 'admin.users', 'label' => 'Utilisateurs', 'icon' => '◉'],
                    ['route' => 'admin.tournois', 'label' => 'Tournois', 'icon' => '⚡'],
                    ['route' => 'admin.equipes', 'label' => 'Équipes', 'icon' => '🛡'],
                ];
            @endphp

            @foreach ($links as $link)
                <a href="{{ route($link['route']) }}"
                    class="flex items-center gap-3 px-4 py-3 text-sm font-bold uppercase tracking-widest transition
                          {{ request()->routeIs($link['route'])
                              ? 'bg-purple-600/20 text-purple-400 border-l-2 border-purple-500'
                              : 'text-slate-400 hover:text-white hover:bg-white/5' }}">
                    <span>{{ $link['icon'] }}</span>
                    {{ $link['label'] }}
                </a>
            @endforeach
        </nav>

        <div class="px-4 py-6 border-t border-white/10 space-y-1">
            <a href="{{ route('tournois') }}"
                class="flex items-center gap-3 px-4 py-3 text-sm text-slate-500 hover:text-white uppercase tracking-widest transition">
                ← Site
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button
                    class="w-full flex items-center gap-3 px-4 py-3 text-sm text-red-500 hover:text-red-400 uppercase tracking-widest transition text-left">
                    ⏻ Déconnexion
                </button>
            </form>
        </div>

    </aside>

    <div class="ml-64 flex-1 min-h-screen">
        <header
            class="h-20 border-b border-white/10 flex items-center px-8 justify-between bg-slate-950/80 sticky top-0 z-10 backdrop-blur">
            <h1 class="font-display text-xl font-bold uppercase tracking-widest">{{ $title ?? 'Dashboard' }}</h1>
            <span class="text-xs text-slate-500 uppercase tracking-widest">{{ auth()->user()->name }}</span>
        </header>

        <main class="p-8">
            @if (session('success'))
                <div class="mb-6 bg-green-500/10 border border-green-500/30 text-green-400 px-5 py-3 text-sm">
                    {{ session('success') }}
                </div>
            @endif
            {{ $slot }}
        </main>
    </div>

</body>

</html>
