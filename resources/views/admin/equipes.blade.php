<x-layouts.admin title="Équipes">

    <div class="bg-slate-900/50 border border-white/10 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/10 text-xs uppercase tracking-widest text-slate-500">
                    <th class="text-left px-6 py-4">Équipe</th>
                    <th class="text-left px-6 py-4">Jeu</th>
                    <th class="text-left px-6 py-4">Capitaine</th>
                    <th class="text-left px-6 py-4">Membres</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($equipes as $team)
                    <tr class="border-b border-white/5 hover:bg-white/2 transition">
                        <td class="px-6 py-4 font-semibold">{{ $team->name }}</td>
                        <td class="px-6 py-4 text-purple-400">{{ $team->game?->name }}</td>
                        <td class="px-6 py-4 text-slate-400">{{ $team->captain?->name }}</td>
                        <td class="px-6 py-4 text-slate-400">{{ $team->users()->count() }}</td>
                        <td class="px-6 py-4">
                            <div class="flex gap-2 justify-end">
                                <a href="{{ route('teams.show', $team) }}"
                                   class="px-3 py-1 text-xs font-bold uppercase border border-white/10 text-slate-400 hover:text-white hover:border-white transition">
                                    Voir
                                </a>
                                <form method="POST" action="{{ route('admin.equipes.destroy', $team) }}"
                                      onsubmit="return confirm('Supprimer {{ $team->name }} ?')">
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