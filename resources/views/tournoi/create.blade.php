<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Tournoi | Amateur2Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Space+Grotesk:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={darkMode:'class',theme:{extend:{fontFamily:{sans:['Space Grotesk','sans-serif'],display:['Rajdhani','sans-serif']}}}}</script>
</head>
<body class="bg-slate-950 text-white min-h-screen p-6 md:p-12">

    <a href="/tournois" class="absolute top-10 left-10 text-slate-400 hover:text-white transition">← Retour</a>

    <div class="max-w-2xl mx-auto mt-16">
        
        <header class="mb-10 text-center">
            <h1 class="text-4xl font-display font-bold italic tracking-tighter mb-2">CRÉER UNE ARÈNE</h1>
            <p class="text-slate-400 font-sans">Configure ton tournoi et lance les hostilités.</p>
        </header>

        <form action="{{ route('tournament.store') }}" method="POST" class="bg-slate-900/50 p-8 border border-white/10 space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Nom du Tournoi</label>
                <input type="text" name="name" required class="w-full bg-slate-950 border border-white/10 p-4 rounded-sm focus:border-purple-500 transition-all outline-none">
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Jeu</label>
                    <select name="game_id" class="w-full bg-slate-950 border border-white/10 p-4 rounded-sm focus:border-purple-500 transition-all outline-none">
                        @foreach ($games as $game)
                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Max teams</label>
                    <input type="number" name="max_teams" placeholder="ex: 16" class="w-full bg-slate-950 border border-white/10 p-4 rounded-sm focus:border-purple-500 transition-all outline-none">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Cashprize (€)</label>
                    <input type="number" name="cashprize" class="w-full bg-slate-950 border border-white/10 p-4 rounded-sm focus:border-purple-500 transition-all outline-none">
                </div>
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Date</label>
                    <input type="date" name="date" class="w-full bg-slate-950 border border-white/10 p-4 rounded-sm focus:border-purple-500 transition-all outline-none [color-scheme:dark]">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Description</label>
                <textarea name="description" rows="4" class="w-full bg-slate-950 border border-white/10 p-4 rounded-sm focus:border-purple-500 transition-all outline-none"></textarea>
            </div>

            <button type="submit" class="w-full py-4 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase tracking-widest transition-all duration-300">
                creér le tournoi
            </button>
        </form>

    </div>
</body>
</html>