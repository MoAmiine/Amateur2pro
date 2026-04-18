<x-layouts.app title="Brackets | {{ $tournament->name }}">
    <div class="max-w-7xl mx-auto px-6 pt-28 pb-20">
        
        {{-- FLASH MESSAGES --}}
        @if (session('success'))
        <div class="mb-6 bg-green-500/10 border border-green-500 text-green-400 px-6 py-4 rounded-lg">
            {{ session('success') }}
        </div>
        @endif
        
        @if (session('error'))
        <div class="mb-6 bg-red-500/10 border border-red-500 text-red-400 px-6 py-4 rounded-lg">
            {{ session('error') }}
        </div>
    @endif
    
    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-10">

        <div>
            <h1 class="text-3xl font-bold uppercase tracking-widest">
                {{ $tournament->name }}
            </h1>

            <p class="text-slate-400 text-sm mt-1">
                Brackets Overview
            </p>
        </div>

        <div>
            <span class="px-4 py-2 rounded-lg text-xs font-bold uppercase tracking-widest
                @if($tournament->status === 'live')
                    bg-green-500/10 text-green-400 border border-green-500/20
                @elseif($tournament->status === 'finished')
                    bg-blue-500/10 text-blue-400 border border-blue-500/20
                @else
                    bg-yellow-500/10 text-yellow-400 border border-yellow-500/20
                @endif
            ">
                {{ $tournament->status }}
            </span>
        </div>

    </div>

    {{-- BRACKETS --}}
    <div class="flex gap-10 overflow-x-auto pb-10">

        @forelse($matchesByRound as $round => $matches)

            <div class="min-w-[340px]">

                <h2 class="text-center text-sm uppercase tracking-widest text-slate-400 mb-6">
                    Round {{ $round }}
                </h2>

                <div class="space-y-5">

                    @foreach($matches as $match)

                        <div class="bg-slate-900 border border-white/5 rounded-xl p-4">

                            {{-- TEAM 1 --}}
                            <div class="flex justify-between items-center py-2
                                @if($match->winner_id == $match->team1_id)
                                    text-green-400
                                @endif
                            ">

                                <div class="flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-purple-500"></span>
                                    <span class="font-semibold">
                                        {{ $match->team1->name }}
                                    </span>
                                </div>

                                <span class="text-lg font-bold">
                                    {{ $match->score1 ?? 0 }}
                                </span>

                            </div>

                            <div class="border-t border-white/5 my-2"></div>

                            {{-- TEAM 2 --}}
                            <div class="flex justify-between items-center py-2
                                @if($match->winner_id == $match->team2_id)
                                    text-green-400
                                @endif
                            ">

                                <div class="flex items-center gap-2">
                                    
                                    <span class="font-semibold">
                                        {{ $match->team2->name }}
                                    </span>
                                </div>

                                <span class="text-lg font-bold">
                                    {{ $match->score2 ?? 0 }}
                                </span>

                            </div>

                            {{-- ORGANIZER SCORE FORM --}}
                            @if(auth()->id() === $tournament->organizer_id && !$match->winner_id)

                                <form method="POST" action="{{ route('matches.score', $match) }}"
                                      class="mt-4 flex gap-2">

                                    @csrf

                                    <input type="number"
                                           name="score1"
                                           placeholder="T1"
                                           class="w-full bg-slate-800 border border-white/10 rounded-lg px-2 py-1 text-sm text-white">

                                    <input type="number"
                                           name="score2"
                                           placeholder="T2"
                                           class="w-full bg-slate-800 border border-white/10 rounded-lg px-2 py-1 text-sm text-white">

                                    <button class="bg-purple-600 hover:bg-purple-700 px-4 py-1 rounded-lg text-xs font-bold uppercase">
                                        Save
                                    </button>

                                </form>

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