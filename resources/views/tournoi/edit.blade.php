<x-layouts.app title="Edit Tournament">

<div class="max-w-2xl mx-auto pt-28 pb-20">

    <h1 class="text-4xl font-bold uppercase mb-10">
        Edit Tournament
    </h1>

    <form method="POST"
          action="{{ route('tournois.update', $tournament) }}"
          class="bg-slate-900/40 border border-white/10 p-8 space-y-6 rounded-xl">

        @csrf
        @method('PUT')

        <div>
            <label class="text-xs uppercase text-slate-400">Name</label>
            <input type="text"
                   name="name"
                   value="{{ $tournament->name }}"
                   class="w-full mt-2 p-3 bg-slate-950 border border-white/10 rounded-lg">
        </div>

        <div>
            <label class="text-xs uppercase text-slate-400">Game</label>

            <select name="game_id"
                    class="w-full mt-2 p-3 bg-slate-950 border border-white/10 rounded-lg">

                @foreach($games as $game)
                    <option value="{{ $game->id }}"
                        @selected($tournament->game_id == $game->id)>
                        {{ $game->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div>
            <label class="text-xs uppercase text-slate-400">Max Teams</label>
            <input type="number"
                   name="max_teams"
                   value="{{ $tournament->max_teams }}"
                   class="w-full mt-2 p-3 bg-slate-950 border border-white/10 rounded-lg">
        </div>

        <div>
            <label class="text-xs uppercase text-slate-400">Cashprize</label>
            <input type="number"
                   name="cashprize"
                   value="{{ $tournament->cashprize }}"
                   class="w-full mt-2 p-3 bg-slate-950 border border-white/10 rounded-lg">
        </div>

        <div>
            <label class="text-xs uppercase text-slate-400">Date</label>
            <input type="date"
                   name="date"
                   value="{{ $tournament->date }}"
                   class="w-full mt-2 p-3 bg-slate-950 border border-white/10 rounded-lg">
        </div>

        <div>
            <label class="text-xs uppercase text-slate-400">Description</label>
            <textarea name="description"
                      class="w-full mt-2 p-3 bg-slate-950 border border-white/10 rounded-lg">
                {{ $tournament->description }}
            </textarea>
        </div>

        <button class="w-full py-3 bg-purple-600 hover:bg-purple-500 font-bold uppercase rounded-lg">
            Update Tournament
        </button>

    </form>

</div>

</x-layouts.app>