<x-layouts.app title="Tournament">

    <div class="max-w-6xl mx-auto px-6 pt-28 pb-20">

        {{-- BACK --}}
        <a href="{{ route('tournois') }}" class="text-slate-400 hover:text-white text-sm">
            ← Back to tournaments
        </a>

        {{-- HERO --}}
        <div id="hero"
            class="mt-6 relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-br from-slate-900 via-slate-950 to-black p-10">

            <div
                class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,rgba(168,85,247,0.4),transparent_60%)]">
            </div>

            <div class="relative">

                <h1 class="text-5xl font-bold uppercase tracking-widest text-white drop-shadow-lg">
                    {{ $tournament->name }}
                </h1>

                <p class="mt-3 text-purple-400 font-semibold">
                    🎮 {{ $tournament->game?->name }}
                </p>

                <p class="mt-2 text-slate-400 text-sm">
                    Organized by {{ $tournament->organizer?->name }}
                </p>

                <div class="mt-6 flex flex-wrap gap-3 text-sm">

                    <span class="px-3 py-1 bg-white/10 rounded-lg">
                        📅 {{ $tournament->date }}
                    </span>

                    <span class="px-3 py-1 bg-white/10 rounded-lg">
                        👥 Max {{ $tournament->max_teams }} Teams
                    </span>

                    <span class="px-3 py-1 bg-green-500/20 text-green-400 rounded-lg">
                        💰 {{ $tournament->cashprize ?? 0 }} €
                    </span>

                </div>

            </div>
        </div>

        {{-- DESCRIPTION --}}
        <div class="mt-6 bg-slate-900/40 border border-white/10 p-6 rounded-xl">
            <h2 class="font-bold mb-2">About Tournament</h2>
            <p class="text-slate-400">
                {{ $tournament->description ?? 'No description available.' }}
            </p>
        </div>

        {{-- ACTIONS --}}
        <div class="mt-6 flex flex-wrap gap-3">

            @auth

                @if (!$team)
                    <p class="text-red-500">Create a team first</p>
                @elseif(!$isCaptain)
                    <p class="text-red-500">Only captain can register</p>
                @elseif($registered)
                    <form method="POST" action="{{ route('tournaments.leave', $tournament) }}" onsubmit="return confirm('You want to leave this tournament ?')">
                        @csrf
                        @method('DELETE')

                        <button class="px-6 py-3 bg-red-600 rounded-lg hover:bg-red-500">
                            Leave Tournament
                        </button>
                    </form>
                @elseif($isFull)
                    <button disabled class="px-6 py-3 bg-gray-600 rounded-lg">
                        Tournament Full
                    </button>
                @else
                    <form method="POST" action="{{ route('tournaments.register', $tournament->id) }}">
                        @csrf

                        <button class="px-6 py-3 bg-purple-600 rounded-lg hover:bg-purple-500">
                            Register Team
                        </button>
                    </form>
                @endif

            @endauth

        </div>

        {{-- REGISTERED TEAMS --}}
        <div class="mt-10">

            <h2 class="text-xl font-bold uppercase tracking-widest mb-5">
                Registered Teams
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-5">

                @forelse($tournament->teams as $team)
                    <a href="{{ route('teams.show', $team) }}"
                        class="relative group bg-slate-900/40 border border-white/10 rounded-xl p-5 overflow-hidden hover:border-purple-500 transition">

                        {{-- hover glow --}}
                        <div
                            class="absolute inset-0 opacity-0 group-hover:opacity-100 transition bg-gradient-to-br from-purple-600/10 to-blue-600/10">
                        </div>

                        <div class="relative flex items-center gap-4">

                            {{-- LOGO --}}
                            <div
                                class="w-14 h-14 rounded-full bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center overflow-hidden font-bold">

                                {{ strtoupper(substr($team->name, 0, 1)) }}


                            </div>

                            {{-- INFO --}}
                            <div class="flex-1">

                                <div class="text-lg font-bold group-hover:text-purple-400 transition">
                                    {{ $team->name }}
                                </div>

                                <div class="text-sm text-slate-400">
                                    🎮 {{ $team->game?->name }}
                                </div>

                                <div class="text-xs text-slate-500 mt-1">
                                    Captain: {{ $team->captain?->name ?? 'Unknown' }}
                                </div>

                            </div>

                        </div>

                    </a>

                @empty

                    <p class="text-slate-400">No teams registered yet.</p>
                @endforelse

            </div>

        </div>

    </div>

    {{-- BACKGROUND SCRIPT --}}
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
