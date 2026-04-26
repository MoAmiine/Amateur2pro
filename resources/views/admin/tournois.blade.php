<x-layouts.admin title="Tournois">

    <div class="bg-slate-900/50 border border-white/10 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/10 text-xs uppercase tracking-widest text-slate-500">
                    <th class="text-left px-6 py-4">Nom</th>
                    <th class="text-left px-6 py-4">Jeu</th>
                    <th class="text-left px-6 py-4">Organisateur</th>
                    <th class="text-left px-6 py-4">Statut</th>
                    <th class="text-left px-6 py-4">Équipes</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tournois as $t)
                    <tr class="border-b border-white/5 hover:bg-white/2 transition">
                        <td class="px-6 py-4 font-semibold">{{ $t->name }}</td>
                        <td class="px-6 py-4 text-purple-400">{{ $t->game?->name }}</td>
                        <td class="px-6 py-4 text-slate-400">{{ $t->organizer?->name }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs px-2 py-1 border
                                @switch($t->status)
                                    @case('open')        border-green-500/30  text-green-400  @break
                                    @case('in_progress') border-yellow-500/30 text-yellow-400 @break
                                    @case('finished')    border-slate-500/30  text-slate-400  @break
                                    @default             border-white/10      text-slate-400
                                @endswitch">
                                {{ $t->status }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-slate-400">{{ $t->teams()->count() }} / {{ $t->max_teams }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2 justify-end">
                                <a href="{{ route('tournois.show', $t) }}"
                                   class="px-3 py-1 text-xs font-bold uppercase border border-white/10 text-slate-400 hover:text-white hover:border-white transition">
                                    Voir
                                </a>
                                <form method="POST" action="{{ route('admin.tournois.destroy', $t) }}"
                                      onsubmit="return confirm('Supprimer {{ $t->name }} ?')">
                                    @csrf @method('DELETE')
                                    <button class="px-3 py-1 text-xs font-bold uppercase border border-red-500/30 text-red-400 hover:bg-red-500/10 transition">
                                        Supprimer
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</x-layouts.admin>