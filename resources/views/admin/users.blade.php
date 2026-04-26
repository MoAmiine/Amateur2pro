<x-layouts.admin title="Utilisateurs">

    <div class="bg-slate-900/50 border border-white/10 overflow-x-auto">
        <table class="w-full text-sm">
            <thead>
                <tr class="border-b border-white/10 text-xs uppercase tracking-widest text-slate-500">
                    <th class="text-left px-6 py-4">Utilisateur</th>
                    <th class="text-left px-6 py-4">Email</th>
                    <th class="text-left px-6 py-4">Rôle</th>
                    <th class="text-left px-6 py-4">Statut</th>
                    <th class="text-left px-6 py-4">Inscrit</th>
                    <th class="px-6 py-4"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr class="border-b border-white/5 hover:bg-white/2 transition">
                        <td class="px-6 py-4 font-semibold">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-slate-400">{{ $user->email }}</td>
                        <td class="px-6 py-4">
                            <span class="text-xs px-2 py-1 border
                                {{ $user->role?->name === 'administrateur'
                                    ? 'border-purple-500/30 text-purple-400'
                                    : 'border-white/10 text-slate-400' }}">
                                {{ $user->role?->name ?? 'N/A' }}
                            </span>
                        </td>
                        <td class="px-6 py-4">
                            @if ($user->suspended)
                                <span class="text-xs text-red-400 uppercase tracking-widest">Suspendu</span>
                            @else
                                <span class="text-xs text-green-400 uppercase tracking-widest">Actif</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-slate-500 text-xs">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4">
                            @if (auth()->id() !== $user->id)
                                <div class="flex gap-2 justify-end">
                                    <form method="POST" action="{{ route('admin.users.suspend', $user) }}">
                                        @csrf @method('PATCH')
                                        <button class="px-3 py-1 text-xs font-bold uppercase border-
                                        @if($user->suspended)
                                        border-green-500/30 text-green-400 hover:bg-green-500/10
                                            @else{
                                        border-yellow-500/30 text-yellow-400 hover:bg-yellow-500/10
                                            @endif
                                            transition">
                                            @if($user->suspended)
                                                Réactiver
                                            @else
                                                Suspendre
                                            @endif
                                        </button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>





</x-layouts.admin>