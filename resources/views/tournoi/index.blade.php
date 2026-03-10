<x-layouts.app title="Tournois | Amateur2Pro">
    
    <div class="max-w-7xl mx-auto px-6 pt-28 pb-20">
        
<header class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
    <div>
        <h1 class="text-6xl font-display font-bold italic tracking-tighter mb-2">LES ARÈNES</h1>
        <p class="text-slate-400 text-lg">Choisis ton tournoi, rejoins ton équipe et domine le classement.</p>
    </div>
    
    <a href="{{ route('tournois.create') }}" class="whitespace-nowrap px-8 py-3 bg-white text-slate-950 font-bold uppercase tracking-widest hover:bg-purple-500 hover:text-white transition-all duration-300">
        Créer un tournoi
    </a>
</header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <div class="bg-slate-900/50 border border-white/10 hover:border-purple-500 transition-all duration-300 group flex flex-col h-full">
                <div class="h-48 overflow-hidden relative">
                    <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e" class="w-full h-full object-cover opacity-60 group-hover:scale-110 transition duration-700">
                    <div class="absolute top-4 right-4 bg-purple-600 px-3 py-1 text-[10px] font-bold uppercase tracking-widest animate-pulse">Live</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="font-display text-2xl font-bold uppercase tracking-widest mb-4">Valorant Open Cup</h3>
                    
                    <div class="mt-auto">
                        <div class="flex justify-between text-sm text-slate-400 mb-6">
                            <span>Cashprize: 500€</span>
                            <span>5v5</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 py-3 border border-white/20 hover:border-white text-white font-bold uppercase tracking-widest text-xs transition">Détails</button>
                            <button class="flex-1 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase tracking-widest text-xs transition">S'inscrire</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-900/50 border border-white/10 hover:border-purple-500 transition-all duration-300 group flex flex-col h-full">
                <div class="h-48 overflow-hidden relative bg-slate-800 flex items-center justify-center">
                    <span class="text-slate-600 font-bold tracking-widest uppercase">Soon</span>
                    <div class="absolute top-4 right-4 bg-slate-700 px-3 py-1 text-[10px] font-bold uppercase tracking-widest">À venir</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="font-display text-2xl font-bold uppercase tracking-widest mb-4">League of Legends</h3>
                    
                    <div class="mt-auto">
                        <div class="flex justify-between text-sm text-slate-400 mb-6">
                            <span>Cashprize: 1200€</span>
                            <span>5v5</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 py-3 border border-white/20 hover:border-white text-white font-bold uppercase tracking-widest text-xs transition">Détails</button>
                            <button class="flex-1 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase tracking-widest text-xs transition">S'inscrire</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-slate-900/50 border border-white/10 hover:border-purple-500 transition-all duration-300 group flex flex-col h-full">
                <div class="h-48 overflow-hidden relative bg-slate-800 flex items-center justify-center">
                    <span class="text-slate-600 font-bold tracking-widest uppercase">Soon</span>
                    <div class="absolute top-4 right-4 bg-slate-700 px-3 py-1 text-[10px] font-bold uppercase tracking-widest">À venir</div>
                </div>
                <div class="p-6 flex flex-col flex-grow">
                    <h3 class="font-display text-2xl font-bold uppercase tracking-widest mb-4">CS2 Pro League</h3>
                    
                    <div class="mt-auto">
                        <div class="flex justify-between text-sm text-slate-400 mb-6">
                            <span>Cashprize: 2500€</span>
                            <span>5v5</span>
                        </div>
                        <div class="flex gap-2">
                            <button class="flex-1 py-3 border border-white/20 hover:border-white text-white font-bold uppercase tracking-widest text-xs transition">Détails</button>
                            <button class="flex-1 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase tracking-widest text-xs transition">S'inscrire</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>