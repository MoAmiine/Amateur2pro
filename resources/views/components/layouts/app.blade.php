<!DOCTYPE html>
<html lang="fr" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Amateur2Pro' }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Space+Grotesk:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: { extend: { fontFamily: { sans: ['Space Grotesk', 'sans-serif'], display: ['Rajdhani', 'sans-serif'] }, colors: { slate: { 950: '#020617' } } } }
        }
    </script>
</head>
<body class="bg-slate-950 text-white antialiased selection:bg-purple-500/30">

    <nav class="fixed top-0 w-full z-50 border-b border-white/10 bg-slate-950/80 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <a href="/" class="text-4xl font-display font-bold tracking-widest italic">A2<span class="text-purple-500">P</span></a>
            
            <div class="flex items-center gap-8">
                <div class="hidden md:flex gap-8 text-sm font-medium uppercase tracking-wider text-slate-400">
                    <a href="{{ route('tournois') }}" class="hover:text-purple-400 transition">Tournois</a>
                    <a href="/equipes" class="hover:text-purple-400 transition">Équipes</a>
                    <a href="#features" class="hover:text-purple-400 transition">Fonctionnalités</a>
                </div>
                
                @auth
                    <a href="/dashboard" class="text-sm font-bold text-white hover:text-purple-400 transition">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-medium uppercase hover:text-white text-slate-400 transition">Connexion</a>
                    <a href="{{ route('register') }}" class="px-6 py-2 bg-purple-600 hover:bg-purple-500 rounded-sm font-bold text-sm tracking-widest uppercase transition-all">S'inscrire</a>
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