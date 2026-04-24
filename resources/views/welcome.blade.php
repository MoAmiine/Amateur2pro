<x-layouts.app title="Accueil | Amateur2Pro">

    <section class="min-h-screen flex items-center pt-20">
        <div class="max-w-7xl mx-auto px-6 grid lg:grid-cols-2 gap-16 items-center">
            <div class="relative z-10">
                <h1 class="font-display text-7xl md:text-9xl font-bold italic tracking-tighter leading-[0.9] mb-8">
                    AMATEUR<span class="text-purple-500">2</span>PRO
                </h1>
                <p class="text-xl text-slate-400 font-light mb-12 max-w-lg leading-relaxed">
                    Ton terrain, ton équipe, ta légende. L'infrastructure ultime pour passer du salon au stade.
                </p>
                <div class="flex gap-4">
                    <a href="/register"
                       class="px-8 py-4 bg-white text-slate-950 font-bold tracking-widest uppercase hover:bg-slate-200 transition-all">
                        Lancer ma carrière
                    </a>
                </div>
            </div>

            <div class="relative group">
                <div class="absolute -inset-1 bg-gradient-to-r from-purple-600 to-indigo-600 blur opacity-20 group-hover:opacity-40 transition duration-1000"></div>
                <div class="relative border border-white/10 shadow-2xl">
                    <img src="https://images.unsplash.com/photo-1542751371-adc38448a05e?q=80&w=2000"
                         alt="E-sports arena"
                         class="w-full h-[600px] object-cover grayscale group-hover:grayscale-0 transition duration-700">
                </div>
            </div>
        </div>
    </section>



    <section class="py-24 border-t border-white/10">
        <div class="max-w-7xl mx-auto px-6">

            <div class="flex items-end justify-between mb-16">
                <h2 class="font-display text-5xl font-bold italic tracking-tighter text-white">
                    DERNIÈRES<br><span class="text-purple-500">ANNONCES.</span>
                </h2>
                <a href="{{ route('announcements.index') }}"
                   class="text-xs font-bold uppercase tracking-widest text-slate-400 hover:text-white transition pb-1 border-b border-white/20 hover:border-white">
                    Voir tout →
                </a>
            </div>

            <div class="grid md:grid-cols-2 gap-4">
                @forelse ($announcements as $announcement)

                    <div class="bg-slate-900/50 border border-white/10 p-6 hover:border-purple-500/50 transition group flex gap-5">

                        @if (str_contains($announcement->text, 'commencer') || str_contains($announcement->text, 'commencé'))
                            <div class="shrink-0 w-10 h-10 bg-yellow-500/10 border border-yellow-500/30 flex items-center justify-center text-yellow-400 font-display font-bold">!</div>
                        @elseif (str_contains($announcement->text, 'terminé') || str_contains($announcement->text, 'Gagnant'))
                            <div class="shrink-0 w-10 h-10 bg-green-500/10 border border-green-500/30 flex items-center justify-center text-green-400 font-display font-bold">W</div>
                        @else
                            <div class="shrink-0 w-10 h-10 bg-purple-500/10 border border-purple-500/30 flex items-center justify-center text-purple-400 font-display font-bold">N</div>
                        @endif

                        <div class="flex-1 min-w-0">
                            <p class="text-white text-sm leading-relaxed">
                                {{ $announcement->text }}
                            </p>
                            <div class="mt-3 flex flex-wrap gap-3 text-[10px] uppercase tracking-widest text-slate-500">
                                <a href="{{ route('tournois.show', $announcement->tournament) }}"
                                   class="text-purple-400 hover:text-purple-300 transition">
                                    {{ $announcement->tournament->name }}
                                </a>
                                <span class="text-white/10">|</span>
                                <span>{{ $announcement->created_at->diffForHumans() }}</span>
                            </div>
                        </div>

                    </div>

                @empty
                    <div class="col-span-2 py-16 text-center border border-white/5">
                        <p class="text-slate-600 uppercase tracking-widest text-xs">Aucune annonce pour le moment</p>
                    </div>
                @endforelse
            </div>

        </div>
    </section>


        <section id="features" class="scroll-mt-20 py-24 border-t border-white/10 bg-slate-950">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="font-display text-5xl font-bold italic tracking-tighter text-white mb-16">
                TON POTENTIEL, <br><span class="text-purple-500">OPTIMISÉ.</span>
            </h2>
            <div class="grid md:grid-cols-3 gap-4">
                <div class="p-10 bg-white/5 border border-white/10 hover:border-purple-500 transition-all duration-300">
                    <div class="text-4xl mb-6">⚡</div>
                    <h3 class="font-display text-2xl font-bold uppercase tracking-widest mb-4">Tournois</h3>
                    <p class="text-slate-400">Brackets, scores et résultats en temps réel.</p>
                </div>
                <div class="p-10 bg-white/5 border border-white/10 hover:border-purple-500 transition-all duration-300">
                    <div class="text-4xl mb-6">🛡️</div>
                    <h3 class="font-display text-2xl font-bold uppercase tracking-widest mb-4">Équipes</h3>
                    <p class="text-slate-400">Recrute, gère les rôles et centralise ton roster.</p>
                </div>
                <div class="p-10 bg-white/5 border border-white/10 hover:border-purple-500 transition-all duration-300">
                    <div class="text-4xl mb-6">📈</div>
                    <h3 class="font-display text-2xl font-bold uppercase tracking-widest mb-4">Stats</h3>
                    <p class="text-slate-400">Analyse tes perfs et grimpe dans le classement.</p>
                </div>
            </div>
        </div>
    </section>
</x-layouts.app>