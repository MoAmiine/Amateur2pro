<!DOCTYPE html>
<html lang="fr" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion | Amateur2Pro</title>
    <link href="https://fonts.googleapis.com/css2?family=Rajdhani:wght@600;700&family=Space+Grotesk:wght@300;400;500&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>tailwind.config={darkMode:'class',theme:{extend:{fontFamily:{sans:['Space Grotesk','sans-serif'],display:['Rajdhani','sans-serif']}}}}</script>
</head>
<body class="bg-slate-950 text-white min-h-screen flex items-center justify-center p-6">

    <a href="/" class="absolute top-10 left-10 text-slate-400 hover:text-white transition">← Retour</a>

    <div class="w-full max-w-sm">
        <div class="text-center mb-10">
            <div class="text-4xl font-display font-bold italic mb-2">A2<span class="text-purple-500">P</span></div>
            <h1 class="font-display text-2xl font-bold uppercase tracking-widest">Connexion</h1>
        </div>

        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Email</label>
                <input name="email" value="{{ old('email') }}" type="email" class="w-full bg-slate-900 border border-white/10 p-4 rounded-sm focus:border-purple-500 outline-none transition-all">
            </div>
            <div>
                <label class="block text-xs font-bold uppercase tracking-widest text-slate-400 mb-2">Mot de passe</label>
                <input name="password" type="password" class="w-full bg-slate-900 border border-white/10 p-4 rounded-sm focus:border-purple-500 outline-none transition-all">
            </div>
            <button class="w-full py-4 bg-purple-600 hover:bg-purple-500 font-bold uppercase tracking-widest transition-all">
                Accéder au Dashboard
            </button>
        </form>

        <p class="text-center text-slate-500 mt-8 text-sm">
            Pas de compte ? <a href="/register" class="text-purple-400 hover:underline">Inscris-toi</a>
        </p>
    </div>
</body>
</html>