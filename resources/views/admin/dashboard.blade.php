<x-layouts.admin title="Dashboard">

    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-10">
        @foreach ([
            ['label' => 'Utilisateurs', 'value' => $totalUsers,         'color' => 'purple'],
            ['label' => 'Tournois',     'value' => $totalTournois,       'color' => 'yellow'],
            ['label' => 'Équipes',      'value' => $totalEquipes,        'color' => 'blue'],
            ['label' => 'Annonces',     'value' => $totalAnnouncements,  'color' => 'green'],
        ] as $stat)
            <div class="bg-slate-900/50 border border-white/10 p-6">
                <p class="text-xs uppercase tracking-widest text-slate-500 mb-2">{{ $stat['label'] }}</p>
                <p class="font-display text-5xl font-bold text-{{ $stat['color'] }}-400">{{ $stat['value'] }}</p>
            </div>
        @endforeach
    </div>

    <div class="grid lg:grid-cols-2 gap-6">

        <div class="bg-slate-900/50 border border-white/10 p-6">
            <h2 class="font-display font-bold uppercase tracking-widest text-sm mb-4 text-slate-400">Derniers utilisateurs</h2>
            <div class="space-y-3">
                @foreach ($recentUsers as $user)
                    <div class="flex items-center justify-between py-2 border-b border-white/5">
                        <div>
                            <p class="font-semibold text-sm">{{ $user->name }}</p>
                            <p class="text-xs text-slate-500">{{ $user->email }}</p>
                        </div>
                        <span class="text-xs text-slate-600">{{ $user->created_at->diffForHumans() }}</span>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.users') }}" class="block mt-4 text-xs text-purple-400 hover:text-purple-300 uppercase tracking-widest">Voir tout →</a>
        </div>

        <div class="bg-slate-900/50 border border-white/10 p-6">
            <h2 class="font-display font-bold uppercase tracking-widest text-sm mb-4 text-slate-400">Derniers tournois</h2>
            <div class="space-y-3">
                @foreach ($recentTournois as $t)
                    <div class="flex items-center justify-between py-2 border-b border-white/5">
                        <div>
                            <p class="font-semibold text-sm">{{ $t->name }}</p>
                            <p class="text-xs text-slate-500">{{ $t->game?->name }} — {{ $t->status }}</p>
                        </div>
                        <span class="text-xs text-slate-600">{{ $t->created_at->diffForHumans() }}</span>
                    </div>
                @endforeach
            </div>
            <a href="{{ route('admin.tournois') }}" class="block mt-4 text-xs text-purple-400 hover:text-purple-300 uppercase tracking-widest">Voir tout →</a>
        </div>

    </div>

</x-layouts.admin>