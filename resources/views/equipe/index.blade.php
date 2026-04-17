<x-layouts.app title="Équipes | Amateur2Pro">

<div class="max-w-7xl mx-auto px-6 pt-28 pb-20">

    {{-- SUCCESS / ERROR --}}
    @if (session('success'))
        <div class="mb-6 bg-green-500/10 border border-green-500 text-green-400 px-6 py-4">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-6 bg-red-500/10 border border-red-500 text-red-400 px-6 py-4">
            {{ session('error') }}
        </div>
    @endif

    {{-- HEADER --}}
    <header class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h1 class="text-6xl font-display font-bold italic tracking-tighter mb-2">
                LES ÉQUIPES
            </h1>
            <p class="text-slate-400 text-lg">
                Découvre les rosters et trouve ton binôme de choc.
            </p>
        </div>

        <a href="{{ route('teams.create') }}"
           class="px-8 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase tracking-widest">
            Créer une équipe
        </a>
    </header>

    {{-- SEARCH + FILTER --}}
    <form method="GET"
          class="mb-10 bg-slate-900/30 p-4 border border-white/5 flex flex-wrap gap-4">

        <input type="text"
               name="search"
               value="{{ request('search') }}"
               placeholder="Rechercher une équipe..."
               class="flex-grow bg-slate-950 border border-white/10 p-3 text-white focus:border-purple-500 outline-none">

        <select name="game_id"
                class="bg-slate-950 border border-white/10 p-3 text-white focus:border-purple-500 outline-none">

            <option value="">Tous les jeux</option>

            @foreach ($games as $game)
                <option value="{{ $game->id }}"
                    {{ request('game_id') == $game->id ? 'selected' : '' }}>
                    {{ $game->name }}
                </option>
            @endforeach

        </select>

        <button type="submit"
                class="px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase text-xs">
            Search
        </button>

    </form>

    {{-- GRID --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        @forelse ($teams as $team)

            <div class="bg-slate-900/50 border border-white/10 p-6 hover:border-purple-500 transition group">

                {{-- TEAM HEADER --}}
                <div class="flex items-center gap-4 mb-6">

                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-600 rounded-full flex items-center justify-center font-bold text-xl">
                        {{ strtoupper(substr($team->name, 0, 1)) }}
                    </div>

                    <div>
                        <h3 class="font-bold uppercase tracking-widest">
                            {{ $team->name }}
                        </h3>

                        <span class="text-[10px] text-purple-400 uppercase tracking-widest">
                            {{ $team->game->name }}
                        </span>
                    </div>

                </div>

                {{-- INFO --}}
                <div class="text-slate-400 text-sm mb-6">
                    <p>{{ $team->users->count() }} / 5 players</p>
                    <p>Capitaine: {{ $team->captain->name }}</p>
                </div>

                {{-- ACTIONS --}}
                <div class="flex gap-2">

                    <a href="{{ route('teams.show', $team) }}"
                       class="flex-1 py-2 border border-white/10 hover:border-white text-xs uppercase font-bold text-center transition">
                        Voir
                    </a>

                    @auth
                        @if (!$team->users->contains(auth()->id()))

                            <form method="POST" action="{{ route('teams.join', $team) }}" class="flex-1">
                                @csrf

                                <button class="w-full py-2 bg-white text-slate-950 text-xs uppercase font-bold hover:bg-slate-200">
                                    Rejoindre
                                </button>
                            </form>

                        @else
                            <button disabled
                                    class="flex-1 py-2 bg-gray-400 text-slate-950 text-xs uppercase font-bold cursor-not-allowed">
                                Membre
                            </button>
                        @endif
                    @endauth

                </div>

            </div>

        @empty

            {{-- EMPTY STATE --}}
            <div class="col-span-full flex flex-col items-center justify-center py-24 text-center">

                <div class="text-6xl mb-4">👥</div>

                <h2 class="text-2xl font-bold text-white mb-2">
                    Aucune équipe trouvée
                </h2>

                <p class="text-slate-400 mb-6">
                    Crée la première équipe et commence l’aventure !
                </p>

                <a href="{{ route('teams.create') }}"
                   class="px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase">
                    Créer une équipe
                </a>

            </div>

        @endforelse

    </div>

</div>

</x-layouts.app>