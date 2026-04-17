<x-layouts.app title="Tournoi">

<div class="max-w-6xl mx-auto px-6 pt-28 pb-20">

    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="mb-6 bg-green-500/10 border border-green-500 text-green-400 px-6 py-4 rounded-lg">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)"
            class="mb-6 bg-red-500/10 border border-red-500 text-red-400 px-6 py-4 rounded-lg">
            {{ session('error') }}
        </div>
    @endif

    <a href="{{ route('tournois') }}" class="text-slate-400 hover:text-white text-sm">
        ← Retour aux tournois
    </a>

    <div id="hero"
        class="mt-6 relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-br from-slate-900 via-slate-950 to-black p-10">

        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,rgba(168,85,247,0.4),transparent_60%)]"></div>

        <div class="relative">

            <h1 class="text-5xl font-bold uppercase tracking-widest text-white drop-shadow-lg">
                {{ $tournament->name }}
            </h1>

            <p class="mt-3 text-purple-400 font-semibold">
                🎮 {{ $tournament->game?->name }}
            </p>

            <p class="mt-2 text-slate-400 text-sm">
                Organisé par {{ $tournament->organizer->name }}
            </p>

            <div class="mt-6 flex flex-wrap gap-3 text-sm">

                <span class="px-3 py-1 bg-white/10 rounded-lg">
                    📅 {{ $tournament->date }}
                </span>

                <span class="px-3 py-1 bg-white/10 rounded-lg">
                    👥 Max {{ $tournament->max_teams }} équipes
                </span>

                <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-lg">
                    💰 {{ $tournament->cashprize}} €
                </span>

            </div>

            @auth
                @if(auth()->id() === $tournament->organizer_id)

                    <div class="mt-6">

                        <form method="POST" action="#">
                            @csrf

                            <button
                                class="px-6 py-3 bg-yellow-500 text-black font-bold uppercase rounded-lg hover:bg-yellow-400 transition">
                                Lancer le tournoi
                            </button>

                        </form>

                    </div>

                @endif
            @endauth

        </div>
    </div>

    {{-- DESCRIPTION --}}
    <div class="mt-6 bg-slate-900/40 border border-white/10 p-6 rounded-xl">
        <h2 class="font-bold mb-2">À propos du tournoi</h2>
        <p class="text-slate-400">
            {{ $tournament->description ?? 'Aucune description disponible.' }}
        </p>
    </div>

    {{-- ACTIONS --}}
    <div class="mt-6 flex flex-wrap gap-3">

        @auth

            @if (!$team)
                <p class="text-red-500">Crée une équipe d’abord</p>

            @elseif(!$isCaptain)
                <p class="text-red-500">Seul le capitaine peut inscrire l’équipe</p>

            @elseif($registered)

                <form method="POST" action="{{ route('tournois.leave', $tournament) }}"
                    onsubmit="return confirm('Voulez-vous quitter ce tournoi ?')">
                    @csrf
                    @method('DELETE')

                    <button class="px-6 py-3 bg-red-600 rounded-lg hover:bg-red-500">
                        Quitter le tournoi
                    </button>
                </form>

            @elseif($isFull)

                <button disabled class="px-6 py-3 bg-gray-600 rounded-lg">
                    Tournoi complet
                </button>

            @else

                <form method="POST" action="{{ route('tournois.register', $tournament->id) }}">
                    @csrf

                    <button class="px-6 py-3 bg-purple-600 rounded-lg hover:bg-purple-500">
                        Inscrire l’équipe
                    </button>
                </form>

            @endif

        @endauth

    </div>

    {{-- REGISTERED TEAMS --}}
    <div class="mt-10">

        <h2 class="text-xl font-bold uppercase tracking-widest mb-5">
            Équipes inscrites :         {{ $tournament->teams()->count() }} / {{ $tournament->max_teams }}

        </h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

            @forelse($tournament->teams as $team)

                <a href="{{ route('teams.show', $team) }}"
                    class="relative group bg-slate-900/40 border border-white/10 rounded-xl p-5 overflow-hidden hover:border-purple-500 transition">

                    <div class="absolute inset-0 opacity-0 group-hover:opacity-100 transition bg-gradient-to-br from-purple-600/10 to-blue-600/10"></div>

                    <div class="relative flex items-center gap-4">

                        <div class="w-14 h-14 rounded-full bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center font-bold">

                            {{ strtoupper(substr($team->name, 0, 1)) }}

                        </div>

                        <div class="flex-1">

                            <div class="text-lg font-bold group-hover:text-purple-400 transition">
                                {{ $team->name }}
                            </div>

                            <div class="text-xs text-slate-500 mt-1">
                                Capitaine: {{ $team->captain?->name ?? 'Inconnu' }}
                            </div>

                        </div>

                    </div>

                </a>

            @empty
                <p class="text-slate-400">Aucune équipe inscrite.</p>
            @endforelse

        </div>

    </div>

</div>

<script>
        const gameBackgrounds = {
            1: "https://cdn1.epicgames.com/offer/24b9b5e323bc40eea252a10cdd3b2f10/EGS_LeagueofLegends_RiotGames_S1_2560x1440-47eb328eac5ddd63ebd096ded7d0d5ab",
            2: "https://www.riotgames.com/darkroom/1440/d0807e131a84f2e42c7a303bda672789:3d02afa7e0bfb75f645d97467765b24c/valorant-offwhitelaunch-keyart.jpg",
            3: "https://gaming-cdn.com/images/products/13664/616x353/counter-strike-2-pc-game-steam-cover.jpg?v=1695885435",
            4: "https://games.gg/cdn-cgi/image/width=1920,quality=75,format=auto,fit=scale-down,metadata=none,onerror=redirect/https://assets.games.gg/1758317375594_ea_sports_fc_26_update_new_fe_b8401e4e69.jpeg",
            5: "https://cdn-www.bluestacks.com/bs-images/Top-Free-Fire-Characters-of-2025-A-Comprehensive-Guide.png",
            6: "https://static0.xdaimages.com/wordpress/wp-content/uploads/2018/06/pubg.jpg?w=1200&h=675&fit=crop"
        };

        const gameId = {{ $tournament->game_id }};
        const hero = document.getElementById('hero');

        const bg = gameBackgrounds[gameId] || "https://images.unsplash.com/photo-1542751371-adc38448a05e";

        hero.style.backgroundImage = `url('${bg}')`;
        hero.style.backgroundSize = "cover";
        hero.style.backgroundPosition = "center";
        hero.style.backgroundColor = "rgba(0,0,0,0.5)";
        hero.style.backgroundBlendMode = "darken"
    </script>

</x-layouts.app>