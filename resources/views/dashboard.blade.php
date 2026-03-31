<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Amateur2Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Space+Grotesk:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={darkMode:'class',theme:{extend:{fontFamily:{sans:['Space Grotesk','sans-serif'],display:['Rajdhani','sans-serif']}}}}</script>
</head>
<body class="bg-slate-950 text-white flex h-screen">

    <aside class="w-64 border-r border-white/10 p-8 flex flex-col justify-between">
        <div>
            <a href="{{ route('home') }}">
            <div class="text-2xl font-display font-bold italic tracking-widest mb-12">A2<span class="text-purple-500">P</span></div>
            </a>
            <nav class="space-y-4">
                <a href="#" class="block p-3 bg-white/5 border border-purple-500 text-purple-400 font-bold uppercase tracking-widest text-sm">Dashboard</a>
                <a href="#" class="block p-3 hover:bg-white/5 text-slate-400 hover:text-white uppercase tracking-widest text-sm transition">Tournois</a>
                <a href="#" class="block p-3 hover:bg-white/5 text-slate-400 hover:text-white uppercase tracking-widest text-sm transition">Mon Équipe</a>
            </nav>
        </div>
        <div class="text-xs text-slate-500 italic">v1.0 - Alpha</div>
    </aside>

    <main class="flex-1 p-12 overflow-y-auto">
        <header class="mb-12">
            <h1 class="font-display text-4xl font-bold uppercase tracking-widest">Bienvenue, Joueur</h1>
            <p class="text-slate-400">Voici tes statistiques en temps réel.</p>
        </header>

        <div class="grid grid-cols-3 gap-6">
            <div class="p-8 border border-white/10 bg-slate-900">
                <div class="text-slate-400 text-xs uppercase tracking-widest mb-2">Tournois Joués</div>
                <div class="text-4xl font-display font-bold">12</div>
            </div>
            <div class="p-8 border border-white/10 bg-slate-900">
                <div class="text-slate-400 text-xs uppercase tracking-widest mb-2">Win Rate</div>
                <div class="text-4xl font-display font-bold text-purple-500">68%</div>
            </div>
            <div class="p-8 border border-white/10 bg-slate-900">
                <div class="text-slate-400 text-xs uppercase tracking-widest mb-2">Rang</div>
                <div class="text-4xl font-display font-bold">Gold I</div>
            </div>
        </div>

        <div class="mt-12">
            <h2 class="font-display text-2xl uppercase tracking-widest mb-6">Activités Récentes</h2>
            <div class="border border-white/10 bg-slate-900 p-6">
                <div class="text-slate-400">Aucune activité récente pour le moment.</div>
            </div>
        </div>
    </main>

</body>
</html>