<!DOCTYPE html>
<html lang="fr" class="dark">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejoins Amateur2Pro</title>
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
                        display: ['Rajdhani', 'sans-serif'],
                    }
                }
            }
        }
    </script>
</head>

<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center p-6">

    <a href="/" class="absolute top-10 left-10 text-slate-400 hover:text-white transition">
        ← Retour à l'accueil
    </a>

    <div class="w-full max-w-md">
        <div class="text-center mb-10">
            <div class="text-4xl font-display font-bold tracking-widest italic mb-2">A2<span
                    class="text-purple-500">P</span></div>
            <h1 class="font-display text-3xl font-bold uppercase tracking-widest">Crée ton profil</h1>
            <p class="text-slate-400 mt-2">Prêt à dominer l'arène ?</p>
        </div>

        <form action="{{ route('register') }}" method="POST" class="space-y-6">
            @csrf
            @if ($errors->any())
                <div class="bg-red-500/10 border border-red-500/30 text-red-400 px-4 py-3 text-sm space-y-1">
                    @foreach ($errors->all() as $error)
                        <p>— {{ $error }}</p>
                    @endforeach
                </div>
            @endif
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Gamertag</label>
                <input name="name" value="{{ old('name') }}" type="text" placeholder="Ex: ProPlayer99"
                    class="w-full bg-slate-900 border border-white/10 p-4 rounded-sm outline-none focus:border-purple-500 transition-all">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Email</label>
                <input name="email" value="{{ old('email') }}" type="email" placeholder="joueur@email.com"
                    class="w-full bg-slate-900 border border-white/10 p-4 rounded-sm outline-none focus:border-purple-500 transition-all">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Mot de
                        passe</label>
                    <input name="password" type="password"
                        class="w-full bg-slate-900 border border-white/10 p-4 rounded-sm outline-none focus:border-purple-500 transition-all">
                </div>
                <div>
                    <label
                        class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Confirmer</label>
                    <input name="password_confirmation" type="password"
                        class="w-full bg-slate-900 border border-white/10 p-4 rounded-sm outline-none focus:border-purple-500 transition-all">
                </div>
            </div>

            <button
                class="w-full py-4 bg-purple-600 hover:bg-purple-500 font-bold uppercase tracking-widest transition-all">
                Créer mon compte
            </button>
        </form>

        <p class="text-center text-slate-500 mt-8 text-sm">
            Déjà membre ? <a href="/login" class="text-purple-400 hover:underline">Connecte-toi ici</a>
        </p>
    </div>

</body>

</html>
