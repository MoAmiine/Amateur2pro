<x-layouts.app title="Annonces | Amateur2Pro">

<div class="max-w-7xl mx-auto px-6 pt-28 pb-20">

    <header class="mb-12">
        <h1 class="text-6xl font-display font-bold italic tracking-tighter mb-2">
            LES ANNONCES
        </h1>
        <p class="text-slate-400 text-lg">
            Toutes les actualités des tournois en temps réel.
        </p>
    </header>

    <div class="space-y-4">

        @forelse ($announcements as $announcement)

            <div class="bg-slate-900/50 border border-white/10 p-6 hover:border-purple-500/50 transition group">

                <div class="flex items-start gap-5">

                    <div class="shrink-0 mt-1">
                        @if (str_contains($announcement->text, 'commencer') || str_contains($announcement->text, 'commencé'))
                            <div class="w-10 h-10 bg-yellow-500/10 border border-yellow-500/30 flex items-center justify-center text-yellow-400 font-bold font-display text-lg">
                                !
                            </div>
                        @elseif (str_contains($announcement->text, 'terminé') || str_contains($announcement->text, 'Gagnant'))
                            <div class="w-10 h-10 bg-green-500/10 border border-green-500/30 flex items-center justify-center text-green-400 font-bold font-display text-lg">
                                W
                            </div>
                        @else
                            <div class="w-10 h-10 bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 font-bold font-display text-lg">
                                N
                            </div>
                        @endif
                    </div>

                    <div class="flex-1 min-w-0">

                        <p class="text-white font-medium leading-relaxed">
                            {{ $announcement->text }}
                        </p>

                        <div class="mt-3 flex flex-wrap items-center gap-4 text-xs text-slate-500 uppercase tracking-widest">

                            <span>
                                Par {{ $announcement->user->name }}
                            </span>

                            <span class="text-white/10">|</span>

                            <a href="{{ route('tournois.show', $announcement->tournament) }}"
                               class="text-purple-400 hover:text-purple-300 transition">
                                {{ $announcement->tournament->name }}
                            </a>

                            <span class="text-white/10">|</span>

                            <span>
                                {{ $announcement->created_at->diffForHumans() }}
                            </span>

                        </div>

                    </div>

                    <div class="shrink-0 text-right hidden sm:block">
                        <p class="text-xs text-slate-600 uppercase tracking-widest">
                            {{ $announcement->created_at->format('d M Y') }}
                        </p>
                        <p class="text-xs text-slate-700 mt-1">
                            {{ $announcement->created_at->format('H:i') }}
                        </p>
                    </div>

                </div>

            </div>

        @empty

            <div class="flex flex-col items-center justify-center py-24 text-center border border-white/5">
                <p class="text-4xl font-display font-bold italic text-white/10 mb-3">VIDE</p>
                <p class="text-slate-500">Aucune annonce pour le moment.</p>
            </div>

        @endforelse

    </div>

    @if ($announcements->hasPages())
        <div class="mt-10">
            {{ $announcements->links() }}
        </div>
    @endif

</div>

</x-layouts.app>