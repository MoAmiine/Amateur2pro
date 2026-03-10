<!DOCTYPE html>
<html lang="fr" class="dark scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amateur2Pro | Domine le jeu</title>

    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Space+Grotesk:wght@300;400;500&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Space Grotesk', 'sans-serif'],
                        display: ['Rajdhani', 'sans-serif'],
                    },
                    colors: {
                        slate: { 950: '#020617' }
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-slate-950 text-white antialiased selection:bg-purple-500/30">

<nav class="fixed top-0 w-full z-50 border-b border-white/10 bg-slate-950/80 backdrop-blur-xl">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            
            <div class="text-2xl font-display font-bold tracking-widest italic">A2<span class="text-purple-500">P</span></div>
            
            <div class="flex items-center gap-8">
                <div class="hidden md:flex gap-8 text-sm font-medium uppercase tracking-wider text-slate-400">
                    <a href="#features" class="hover:text-purple-400 transition">Fonctionnalités</a>
                    <a href="/login" class="hover:text-white transition">Connexion</a>
                </div>
                
                <a href="/register" class="px-6 py-2 bg-purple-600 hover:bg-purple-500 rounded-sm font-bold text-sm tracking-widest uppercase transition-all">
                    S'inscrire
                </a>
            </div>
        </div>
</nav>
    <section class="min-h-screen flex items-center pt-20">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            
            <div class="relative z-10">
                <div class="inline-flex items-center gap-2 px-4 py-2 mb-8 rounded-none border border-purple-500/30 text-purple-400 text-xs font-bold uppercase tracking-[0.2em]">
                    <span class="w-2 h-2 bg-purple-500 animate-pulse"></span>
                    Serveurs Live : Online
                </div>
                <h1 class="font-display text-7xl md:text-9xl font-bold italic tracking-tighter leading-[0.9] mb-8">
                    AMATEUR<span class="text-purple-500">2</span>PRO
                </h1>
                <p class="text-xl text-slate-400 font-light mb-12 max-w-lg leading-relaxed">
                    Ton terrain, ton équipe, ta légende. L'infrastructure ultime pour passer du salon au stade.
                </p>
                <div class="flex gap-4">
                    <a href="/register" class="px-8 py-4 bg-white text-slate-950 font-bold tracking-widest uppercase hover:bg-slate-200 transition-all">
                        Lancer ma carrière
                    </a>
                </div>
            </div>

            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-indigo-600 blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                <div class="relative border border-white/10 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=2000" alt="E-sports arena" class="w-full h-[600px] object-cover grayscale group-hover:grayscale-0 transition duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent"></div>
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="scroll-mt-20 py-24 border-t border-white/10 bg-slate-950">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-16">
                <h2 class="font-display text-5xl font-bold italic tracking-tighter text-white">
                    TON POTENTIEL, <br><span class="text-purple-500">OPTIMISÉ.</span>
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-4">
                <div class="p-10 bg-white/5 border border-white/10 hover:border-purple-500 transition-all duration-300 group">
                    <div class="text-4xl mb-6 group-hover:scale-110 transition-transform">⚡</div>
                    <h3 class="font-display text-2xl font-bold uppercase tracking-widest mb-4">Tournois Automatisés</h3>
                    <p class="text-slate-400 leading-relaxed">Brackets, scores et résultats en temps réel.</p>
                </div>

                <div class="p-10 bg-white/5 border border-white/10 hover:border-purple-500 transition-all duration-300 group">
                    <div class="text-4xl mb-6 group-hover:scale-110 transition-transform">🛡️</div>
                    <h3 class="font-display text-2xl font-bold uppercase tracking-widest mb-4">Gestion d'Équipe</h3>
                    <p class="text-slate-400 leading-relaxed">Recrute, gère les rôles et centralise ton roster.</p>
                </div>

                <div class="p-10 bg-white/5 border border-white/10 hover:border-purple-500 transition-all duration-300 group">
                    <div class="text-4xl mb-6 group-hover:scale-110 transition-transform">📈</div>
                    <h3 class="font-display text-2xl font-bold uppercase tracking-widest mb-4">Stats Avancées</h3>
                    <p class="text-slate-400 leading-relaxed">Analyse tes perfs et grimpe dans le classement.</p>
                </div>
            </div>
        </div>
    </section>
</body>
</html>