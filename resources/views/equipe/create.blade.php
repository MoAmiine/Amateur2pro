<!DOCTYPE html>
<html lang="fr" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer une Équipe | Amateur2Pro</title>
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
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-950 text-white min-h-screen p-6 md:p-12">

    <a href="{{ route('teams.index') }}" class="absolute top-10 left-10 text-slate-400 hover:text-white transition">←
        Retour</a>

    <div class="max-w-xl mx-auto mt-16">

        <header class="mb-10 text-center">
            <h1 class="text-4xl font-display font-bold italic tracking-tighter mb-2">CRÉER TA TEAM</h1>
            <p class="text-slate-400 font-sans">Recrute tes coéquipiers et prépare-toi pour le tournoi.</p>
        </header>

        <form action="{{ route('teams.store') }}" method="POST"
            class="bg-slate-900/50 p-8 border border-white/10 space-y-6">
            @csrf

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Nom de
                    l'équipe</label>
                <input type="text" name="name" required
                    class="w-full bg-slate-950 border border-white/10 p-4 rounded-sm focus:border-purple-500 transition-all outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Jeu
                    principal</label>
                <select name="game" class="w-full bg-slate-900 border border-white/10 p-3 rounded-lg">
                    @foreach ($games as $game)
                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                    @endforeach

                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Description /
                    Slogan</label>
                <textarea name="description" rows="3"
                    class="w-full bg-slate-950 border border-white/10 p-4 rounded-sm focus:border-purple-500 transition-all outline-none"></textarea>
            </div>

            <button type="submit"
                class="w-full py-4 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase tracking-widest transition-all duration-300">
                Créer l'équipe
            </button>
        </form>

    </div>
</body>

</html>
