<x-layouts.app title="Équipes | Amateur2Pro">
    
    <div class="max-w-7xl mx-auto px-6 pt-28 pb-20">
        
        <header class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h1 class="text-6xl font-display font-bold italic tracking-tighter mb-2">LES ÉQUIPES</h1>
                <p class="text-slate-400 text-lg">Découvre les rosters et trouve ton binôme de choc.</p>
            </div>
            
            <a href="{{ route('equipes.create') }}" class="px-8 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase tracking-widest transition-all duration-300">
                Créer une équipe
            </a>
        </header>

        <div class="mb-10 bg-slate-900/30 p-4 border border-white/5 flex flex-wrap gap-4">
            <input type="text" placeholder="Rechercher une équipe..." class="flex-grow bg-slate-950 border border-white/10 p-3 text-white focus:border-purple-500 transition-all outline-none">
            <select class="bg-slate-950 border border-white/10 p-3 text-white focus:border-purple-500 transition-all outline-none">
                @foreach ($games as $game)
                <option value="{{ $game->id }}">{{ $game->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach ($teams as $team)
                
            <div class="bg-slate-900/50 border border-white/10 p-6 hover:border-purple-500 transition-all duration-300 group">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-600 rounded-full flex items-center justify-center font-bold text-xl">{{ strtoupper(substr($team->name, 0, 1)) }}</div>
                    <div>
                        <h3 class="font-bold uppercase tracking-widest">{{ $team->name }}</h3>
                        <span class="text-[10px] text-purple-400 uppercase tracking-widest">{{ $team->description }}</span>
                    </div>
                </div>
                <div class="text-slate-400 text-sm mb-6">
                    <p>{{ $team->users->count() }} / 5</p>
                    <p>Capitaine: {{ $team->captain->name }}</p>
                </div>
                <div class="flex gap-2">
                    <a href="{{ route('teams.show', $team) }} "class="flex-1 py-2 border border-white/10 hover:border-white text-xs uppercase font-bold transition text-center">Voir</a>
                    @if(!$team->users->contains(auth()->user()->id))
                    <button class="flex-1 py-2 bg-white text-slate-950 text-xs uppercase font-bold transition hover:bg-slate-200">Rejoindre</button>
                    @else
                    <button class="flex-1 py-2 bg-gray-400 text-slate-950 text-xs uppercase font-bold transition hover:bg-slate-200 cursor-not-allowed">Membre</button>
                    @endif
                </div>
            </div>
            @endforeach

        </div>
    </div>
</x-layouts.app>