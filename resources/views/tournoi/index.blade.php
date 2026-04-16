<x-layouts.app title="Tournois | Amateur2Pro">

    <div class="max-w-7xl mx-auto px-6 pt-28 pb-20">

        <header class="mb-12 flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h1 class="text-6xl font-display font-bold italic tracking-tighter mb-2">LES ARÈNES</h1>
                <p class="text-slate-400 text-lg">Choisis ton tournoi, rejoins ton équipe et domine le classement.</p>
            </div>

            <a href="{{ route('tournois.create') }}"
                class="whitespace-nowrap px-8 py-3 bg-white text-slate-950 font-bold uppercase tracking-widest hover:bg-purple-500 hover:text-white transition-all duration-300">
                Créer un tournoi
            </a>
        </header>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach ($tournament as $t)
                <div
                    class="bg-slate-900/50 border border-white/10 hover:border-purple-500 transition-all duration-300 group flex flex-col h-full">
                    <div class="h-48 overflow-hidden relative">
                        <img src="
                    @switch($t->game_id)
                        @case(1)
                            https://cdn1.epicgames.com/offer/24b9b5e323bc40eea252a10cdd3b2f10/EGS_LeagueofLegends_RiotGames_S1_2560x1440-47eb328eac5ddd63ebd096ded7d0d5ab
                            @break
                        @case(2)
                            https://www.riotgames.com/darkroom/1440/d0807e131a84f2e42c7a303bda672789:3d02afa7e0bfb75f645d97467765b24c/valorant-offwhitelaunch-keyart.jpg  
                        @break
                        @case(3)
                            https://gaming-cdn.com/images/products/13664/616x353/counter-strike-2-pc-game-steam-cover.jpg?v=1695885435
                        @break
                        @case(4)
                            https://games.gg/cdn-cgi/image/width=1920,quality=75,format=auto,fit=scale-down,metadata=none,onerror=redirect/https://assets.games.gg/1758317375594_ea_sports_fc_26_update_new_fe_b8401e4e69.jpeg
                        @break
                        @case(5)
                            https://cdn-www.bluestacks.com/bs-images/Top-Free-Fire-Characters-of-2025-A-Comprehensive-Guide.png
                        @break
                        @case(6)
                            https://static0.xdaimages.com/wordpress/wp-content/uploads/2018/06/pubg.jpg?w=1200&h=675&fit=crop
                        @break
                        @default
                            
                    @endswitch
                    "
                            class="w-full h-full object-cover opacity-60 group-hover:scale-110 transition duration-700">
                        <div
                            class="absolute top-4 right-4 bg-purple-600 px-3 py-1 text-[10px] font-bold uppercase tracking-widest animate-pulse">
                            Live</div>
                    </div>
                    <div class="p-6 flex flex-col flex-grow">
                        <h3 class="font-display text-2xl font-bold uppercase tracking-widest mb-4">{{ $t->name }}
                        </h3>

                        <div class="mt-auto">
                            <div class="flex justify-between text-sm text-slate-400 mb-6">
                                <span>Cashprize: {{ $t->cashprize }}€</span>
                                <span>Max teams : {{ $t->max_teams }}</span>
                            </div>
                            <div class="flex gap-2">
                                <a href="{{ route('tournois.show', $t) }}"
                                    class="flex-1 py-3 border border-white/20 hover:border-white text-white font-bold uppercase tracking-widest text-xs transition text-center">
                                    Détails
                                </a> 
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach


        </div>
    </div>
</x-layouts.app>
