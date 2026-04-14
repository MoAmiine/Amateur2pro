<!DOCTYPE html>
<html lang="fr" class="dark scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Amateur2Pro' }}</title>
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
                        sans: ['Space Grotesk', 'sans-serif'],
                        display: ['Rajdhani', 'sans-serif']
                    },
                    colors: {
                        slate: {
                            950: '#020617'
                        }
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-950 text-white antialiased selection:bg-purple-500/30">

    <nav class="fixed top-0 w-full z-50 border-b border-white/10 bg-slate-950/80 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="/" class="text-4xl font-display font-bold tracking-widest italic">A2<span
                    class="text-purple-500">P</span></a>

            <div class="flex items-center gap-8">
                <div class="hidden md:flex gap-8 text-sm font-medium uppercase tracking-wider text-slate-400">
                    <a href="{{ route('tournois') }}" class="hover:text-purple-400 transition">Tournois</a>
                    <a href="{{ route('equipes.index') }}" class="hover:text-purple-400 transition">Équipes</a>
                    <a href="#features" class="hover:text-purple-400 transition">Fonctionnalités</a>
                </div>

                @auth

                    <div class="flex items-center gap-4 border-l border-white/10 pl-6 ml-2">
                        <a href="/profil" class="flex items-center gap-3 group transition-all">
                            <div
                                class="w-9 h-9 bg-purple-600/10 border border-purple-500/30 flex items-center justify-center rounded-sm group-hover:bg-purple-600 group-hover:border-purple-400 transition-all duration-300 shadow-[0_0_15px_rgba(147,51,234,0.1)]">
                                <span
                                    class="text-sm font-display font-bold text-purple-400 group-hover:text-white uppercase">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </span>
                            </div>

                            <span
                                class="text-sm font-display font-bold  tracking-wider text-white group-hover:text-purple-400 transition">
                                {{ Auth::user()->name }}
                            </span>
                        </a>    
                    </div>
                @else
                    <div class="flex items-center gap-6">
                        <a href="{{ route('login.index') }}"
                            class="text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-white transition">Connexion</a>
                        <a href="{{ route('register.index') }}"
                            class="px-6 py-2 bg-purple-600 hover:bg-purple-500 rounded-sm font-bold text-sm tracking-widest uppercase transition-all">Rejoindre</a>
                    </div>
                @endauth
            </div>
        </div>
    </nav>

    <main>
        {{ $slot }}
    </main>

    <footer class="py-12 border-t border-white/10 text-center text-slate-500 text-sm">
        <p>&copy; 2026 Amateur2Pro. Tous droits réservés.</p>
    </footer>

</body>

</html>
