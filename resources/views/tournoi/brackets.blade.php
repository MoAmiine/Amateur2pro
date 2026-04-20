<x-layouts.app title="Brackets | {{ $tournament->name }}">

<div class="max-w-7xl mx-auto px-6 pt-28 pb-20">

    {{-- TOP BAR --}}
    <div class="flex justify-between items-center mb-8">

        <a 
            href="{{ route('tournois.show',$tournament) }}"
            class="bg-slate-800 hover:bg-slate-700
            px-5 py-2 rounded-lg text-sm font-semibold
            border border-white/10 transition"
        >
            ← Back to Tournament
        </a>

        <span class="px-4 py-2 rounded-lg text-xs font-bold uppercase
            @if($tournament->status == 'live')
                bg-green-500/10 text-green-400 border border-green-500/20
            @elseif($tournament->status == 'finished')
                bg-blue-500/10 text-blue-400 border border-blue-500/20
            @else
                bg-yellow-500/10 text-yellow-400 border border-yellow-500/20
            @endif
        ">
            {{ $tournament->status }}
        </span>

    </div>


    {{-- HEADER --}}
    <div class="mb-10">

        <h1 class="text-3xl font-bold uppercase tracking-widest">
            {{ $tournament->name }}
        </h1>

        <p class="text-slate-400 text-sm mt-1">
            Tournament Brackets
        </p>

    </div>


    {{-- TOURNAMENT WINNER --}}
    @if($tournament->winner)

    <div class="mb-10 bg-gradient-to-r from-purple-600/20 to-blue-600/20
    border border-purple-500/20 rounded-xl p-6 text-center">

        <p class="text-sm uppercase tracking-widest text-slate-400">
            Tournament Champion
        </p>

        <h2 class="text-3xl font-bold text-purple-400 mt-2">
            {{ $tournament->winner->name }}
        </h2>

    </div>

    @endif


    {{-- BRACKETS --}}
    <div class="flex gap-10 overflow-x-auto pb-10">

        @foreach($matchesByRound as $round => $matches)

        <div class="min-w-[320px]">

            <h2 class="text-center text-sm uppercase tracking-widest 
            text-slate-400 mb-6">

                @if($matches->count() == 1)
                    Final
                @else
                    Round {{ $round }}
                @endif

            </h2>


            <div class="space-y-6">

                @foreach($matches as $match)

                <div class="bg-slate-900 border border-white/5 
                rounded-xl p-4">

                    {{-- TEAM 1 --}}
                    <div class="flex justify-between items-center py-2
                    @if($match->winner_id == $match->team1_id)
                        text-green-400 font-bold
                    @endif">

                        <span>
                            {{ $match->team1->name }}
                        </span>

                        <span class="text-lg">
                            {{ $match->score1 ?? 0 }}
                        </span>

                    </div>


                    <div class="border-t border-white/5 my-2"></div>


                    {{-- TEAM 2 --}}
                    <div class="flex justify-between items-center py-2
                    @if($match->winner_id == $match->team2_id)
                        text-green-400 font-bold
                    @endif">

                        <span>
                            {{ $match->team2->name ?? 'TBD' }}
                        </span>

                        <span class="text-lg">
                            {{ $match->score2 ?? 0 }}
                        </span>

                    </div>


                    {{-- SCORE FORM --}}
                    @if(
                        auth()->id() == $tournament->organizer_id 
                        && !$match->winner_id
                        && $match->team2_id
                    )

                    <form 
                        method="POST"
                        action="{{ route('matches.score', $match) }}"
                        class="mt-4 flex gap-2"
                    >

                        @csrf

                        <input
                            type="number"
                            name="score1"
                            class="w-full bg-slate-800 border border-white/10 
                            rounded-lg px-2 py-1 text-sm"
                        >

                        <input
                            type="number"
                            name="score2"
                            class="w-full bg-slate-800 border border-white/10 
                            rounded-lg px-2 py-1 text-sm"
                        >

                        <button
                            class="bg-purple-600 hover:bg-purple-700
                            px-4 py-1 rounded-lg text-xs font-bold uppercase"
                        >
                            Save
                        </button>

                    </form>

                    @endif

                </div>

                @endforeach

            </div>

        </div>

        @endforeach

    </div>

</div>

</x-layouts.app>