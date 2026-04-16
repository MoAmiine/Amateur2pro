<x-layouts.app title="Tournament">

    <div class="max-w-6xl mx-auto px-6 pt-28 pb-20">

        {{-- BACK --}}
        <a href="{{ route('tournois') }}" class="text-slate-400 hover:text-white text-sm">
            ← Back to tournaments
        </a>

        {{-- HERO --}}

        <div class="mt-6 relative overflow-hidden rounded-2xl border border-white/10 bg-gradient-to-br from-slate-900 via-slate-950 to-black p-10"
            id="hero">

            <div
                class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_top,rgba(168,85,247,0.4),transparent_60%)]">
            </div>

            <div class="relative inline-block">
    <h1 class="text-5xl font-bold uppercase tracking-widest text-white
               drop-shadow-lg relative z-10">
        {{ $tournament->name }}
    </h1>
    <br>



                <p class="mt-3 text-purple-400 font-semibold">
                    🎮 {{ $tournament->game?->name }}
                </p>

                <p class="mt-2 text-slate-400 text-sm">
                    Organized by {{ $tournament->organizer?->name }}
                </p>

                <div class="mt-6 flex gap-4 text-sm">

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

        {{-- ACTION BUTTONS --}}
        <div class="mt-6 flex gap-3">

            @auth

                {{-- OWNER BUTTONS --}}
                @if (auth()->id() === $tournament->organizer_id)
                    <a href="#"
                        class="px-5 py-2 bg-purple-600 hover:bg-purple-500 rounded-lg font-bold uppercase text-xs">
                        Edit
                    </a>

                    <form method="POST" action="#">
                        @csrf
                        @method('DELETE')

                        <button class="px-5 py-2 bg-red-600 hover:bg-red-500 rounded-lg font-bold uppercase text-xs">
                            Delete
                        </button>
                    </form>

                    {{-- VISITOR REGISTER BUTTON --}}
                @else
                    <form method="POST" action="{{ route('tournaments.register', $tournament) }}">
                        @csrf

                        <button
                            class="px-6 py-2 bg-white text-black font-bold uppercase text-xs rounded-lg hover:bg-slate-200">
                            Register Team
                        </button>
                    </form>
                @endif
            @else
                <a href="{{ route('login') }}" class="px-6 py-2 bg-white text-black font-bold uppercase text-xs rounded-lg">
                    Login to Register
                </a>

            @endauth

        </div>

        {{-- TEAMS --}}
        <div class="mt-10">

            <h2 class="text-xl font-bold uppercase tracking-widest mb-4">
                Registered Teams
            </h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                @forelse($tournament->teams as $team)
                    <div
                        class="bg-slate-900/40 border border-white/10 p-4 rounded-xl hover:border-purple-500 transition">

                        <div class="font-bold text-lg">
                            {{ $team->name }}
                        </div>

                        <div class="text-sm text-slate-400">
                            {{ $team->game?->name }}
                        </div>

                    </div>

                @empty

                    <p class="text-slate-400">No teams registered yet.</p>
                @endforelse

            </div>

        </div>

    </div>
    <script>
        const gameBackgrounds = {
            1: "https://cdn1.epicgames.com/offer/24b9b5e323bc40eea252a10cdd3b2f10/EGS_LeagueofLegends_RiotGames_S1_2560x1440-47eb328eac5ddd63ebd096ded7d0d5ab",
            2: "https://www.riotgames.com/darkroom/1440/d0807e131a84f2e42c7a303bda672789:3d02afa7e0bfb75f645d97467765b24c/valorant-offwhitelaunch-keyart.jpg",
            3: "https://gaming-cdn.com/images/products/13664/616x353/counter-strike-2-pc-game-steam-cover.jpg?v=1695885435",
            4: "https://gaming-cdn.com/images/news/articles/13774/cover/1000x563/ea-sports-fc-26-releases-on-september-26-cover68778afd733aa.jpg",
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
