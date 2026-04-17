<x-layouts.app title="Brackets | {{ $tournament->name }}">

<div class="max-w-7xl mx-auto px-6 pt-28 pb-20">

    {{-- HEADER --}}
    <div class="mb-12 flex items-center justify-between">

        <div>
            <h1 class="text-3xl font-bold uppercase tracking-wider">
                {{ $tournament->name }}
            </h1>

            <p class="text-slate-400 mt-2 text-sm uppercase tracking-widest">
                Tournament Brackets
            </p>
        </div>



    </div>


    {{-- BRACKETS --}}
    <div class="flex gap-12 overflow-x-auto pb-10">

        @forelse($matchesByRound as $round => $matches)

        <div class="min-w-[320px]">

            {{-- ROUND HEADER --}}
            <div class="mb-6 text-center">

                <h2 class="text-lg font-bold uppercase tracking-widest text-purple-400">
                    Round {{ $round }}
                </h2>

                <div class="h-[2px] bg-purple-500/20 mt-2"></div>

            </div>

            {{-- MATCHES --}}
            <div class="space-y-6">

                @foreach($matches as $match)

                <div class="bg-slate-900/60 border border-white/5 rounded-xl p-4 hover:border-purple-500/30 transition">

                    {{-- TEAM 1 --}}
                    <div class="
                        flex justify-between items-center 
                        px-3 py-2 rounded-lg
                        {{ $match->winner_id == $match->team1_id ? 'bg-green-500/10 border border-green-500/20' : 'bg-slate-800/50' }}
                    ">
                        <span class="font-semibold text-sm">
                            {{ $match->team1->name }}
                        </span>

                        <span class="text-slate-400 font-bold">
                            {{ $match->score1 ?? '-' }}
                        </span>
                    </div>

                    {{-- VS --}}
                    <div class="text-center text-slate-500 text-xs my-2 uppercase tracking-widest">
                        VS
                    </div>

                    {{-- TEAM 2 --}}
                    <div class="
                        flex justify-between items-center 
                        px-3 py-2 rounded-lg
                        {{ $match->winner_id == $match->team2_id ? 'bg-green-500/10 border border-green-500/20' : 'bg-slate-800/50' }}
                    ">
                        <span class="font-semibold text-sm">
                            {{ $match->team2->name }}
                        </span>

                        <span class="text-slate-400 font-bold">
                            {{ $match->score2 ?? '-' }}
                        </span>
                    </div>

                    {{-- WINNER --}}
                    @if($match->winner)
                    <div class="mt-3 text-center">

                        <span class="text-xs text-green-400 uppercase tracking-widest">
                            Winner
                        </span>

                        <div class="font-bold text-sm mt-1">
                            {{ $match->winner->name }}
                        </div>

                    </div>
                    @endif

                </div>

                @endforeach

            </div>

        </div>

        @empty

        <div class="text-slate-400">
            No matches generated yet
        </div>

        @endforelse

    </div>

</div>

</x-layouts.app>