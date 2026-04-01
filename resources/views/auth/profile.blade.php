<x-layouts.app>
    <div class="min-h-screen pt-32 pb-12 px-6">
        <div class="max-w-4xl mx-auto">
            
            <div class="flex items-center gap-6 mb-12 border-b border-white/5 pb-8">
                <div class="w-20 h-20 bg-purple-600/10 border border-purple-500/30 flex items-center justify-center rounded-sm shadow-[0_0_30px_rgba(147,51,234,0.1)]">
                    <span class="text-3xl font-display font-bold text-purple-400 uppercase">
                        {{ substr(Auth::user()->name, 0, 1) }}
                    </span>
                </div>
                <div>
                    <h1 class="text-4xl font-display font-bold uppercase tracking-tighter italic">
                        {{ Auth::user()->name }}
                    </h1>
                    <p class="text-slate-500 text-sm uppercase tracking-widest mt-1">Membre depuis {{ Auth::user()->created_at->format('M Y') }}</p>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="md:col-span-2 space-y-6">
                    <div class="bg-slate-900/50 border border-white/5 p-8 rounded-sm">
                        <h3 class="text-xs font-bold uppercase tracking-[0.3em] text-purple-500 mb-6">Informations du Compte</h3>
                        
                        <div class="space-y-4">
                            <div>
                                <label class="block text-[10px] uppercase tracking-widest text-slate-500 mb-2">Nom d'utilisateur</label>
                                <div class="w-full bg-slate-950 border border-white/10 p-4 font-display font-bold uppercase text-white">
                                    {{ Auth::user()->name }}
                                </div>
                            </div>

                            <div>
                                <label class="block text-[10px] uppercase tracking-widest text-slate-500 mb-2">Adresse Email</label>
                                <div class="w-full bg-slate-950 border border-white/10 p-4 text-slate-300">
                                    {{ Auth::user()->email }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="bg-purple-600/5 border border-purple-500/20 p-6 rounded-sm">
                        <h3 class="text-[10px] font-bold uppercase tracking-widest text-purple-400 mb-4">Statut</h3>
                        <div class="flex items-center gap-2 text-green-500">
                            <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                            <span class="text-xs font-bold uppercase tracking-widest">Compte Vérifié</span>
                        </div>
                    </div>

                    <div class="bg-slate-900/50 border border-white/5 p-6 rounded-sm">
                        <h3 class="text-[10px] font-bold uppercase tracking-widest text-slate-500 mb-4">Actions</h3>
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full py-3 border border-red-500/20 hover:bg-red-500/10 text-red-500 text-[10px] font-bold uppercase tracking-widest transition-all">
                                Déconnexion Sécurisée
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-layouts.app>