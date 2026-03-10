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
                <option>Tous les jeux</option>
                <option>Valorant</option>
                <option>League of Legends</option>
            </select>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-slate-900/50 border border-white/10 p-6 hover:border-purple-500 transition-all duration-300 group">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-blue-600 rounded-full flex items-center justify-center font-bold text-xl">N</div>
                    <div>
                        <h3 class="font-bold uppercase tracking-widest">Night Wolves</h3>
                        <span class="text-[10px] text-purple-400 uppercase tracking-widest">Diamond Rank</span>
                    </div>
                </div>
                <div class="text-slate-400 text-sm mb-6">
                    <p>Membres: 5/5</p>
                    <p>Capitaine: Kael</p>
                </div>
                <div class="flex gap-2">
                    <button class="flex-1 py-2 border border-white/10 hover:border-white text-xs uppercase font-bold transition">Voir</button>
                    <button class="flex-1 py-2 bg-white text-slate-950 text-xs uppercase font-bold transition hover:bg-slate-200">Rejoindre</button>
                </div>
            </div>

            <div class="bg-slate-900/50 border border-white/10 p-6 hover:border-purple-500 transition-all duration-300 group">
                <div class="flex items-center gap-4 mb-6">
                    <div class="w-16 h-16 bg-gradient-to-br from-emerald-500 to-green-600 rounded-full flex items-center justify-center font-bold text-xl">A</div>
                    <div>
                        <h3 class="font-bold uppercase tracking-widest">Apex Legends</h3>
                        <span class="text-[10px] text-emerald-400 uppercase tracking-widest">Gold Rank</span>
                    </div>
                </div>
                <div class="text-slate-400 text-sm mb-6">
                    <p>Membres: 3/5</p>
                    <p>Capitaine: Zero</p>
                </div>
                <div class="flex gap-2">
                    <button class="flex-1 py-2 border border-white/10 hover:border-white text-xs uppercase font-bold transition">Voir</button>
                    <button class="flex-1 py-2 bg-white text-slate-950 text-xs uppercase font-bold transition hover:bg-slate-200">Rejoindre</button>
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>