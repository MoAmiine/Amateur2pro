<x-layouts.app title="Edit Team">

<div class="max-w-3xl mx-auto px-6 pt-28">

<h1 class="text-3xl font-bold mb-6">Edit Team</h1>

<form method="POST" action="{{ route('teams.update', $team) }}" class="space-y-6">

@csrf
@method('PUT')

{{-- NAME --}}
<div>
<label class="block mb-2 font-semibold">Team Name</label>

<input type="text"
       name="name"
       value="{{ old('name', $team->name) }}"
       class="w-full bg-slate-900 border border-white/10 p-3 rounded-lg text-white">

@error('name')
<p class="text-red-400 text-sm mt-1">{{ $message }}</p>
@enderror

</div>

{{-- DESCRIPTION --}}
<div>
<label class="block mb-2 font-semibold">Description</label>

<textarea name="description"
          rows="4"
          class="w-full bg-slate-900 border border-white/10 p-3 rounded-lg text-white">{{ old('description', $team->description) }}</textarea>

@error('description')
<p class="text-red-400 text-sm mt-1">{{ $message }}</p>
@enderror

</div>
                <select name="game" class="w-full bg-slate-900 border border-white/10 p-3 rounded-lg">
                    @foreach ($games as $game)
                        <option value="{{ $game->id }}">{{ $game->name }}</option>
                    @endforeach

                </select>

{{-- BUTTON --}}
<div class="flex gap-3">

<button class="px-6 py-3 bg-purple-600 hover:bg-purple-500 rounded-lg font-bold">
Update Team
</button>

<a href="{{ route('teams.show', $team) }}"
   class="px-6 py-3 bg-slate-700 hover:bg-slate-600 rounded-lg">
Cancel
</a>

</div>


</form>

</div>

</x-layouts.app>