<x-layouts.app>

    <div class="min-h-screen pt-32 pb-12 px-6">
        <div class="max-w-4xl mx-auto">
            
            <form action="{{ route('profile.update') }}" method="POST">
                @csrf
                @method('POST')

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <div class="md:col-span-2 space-y-6">
                        <div class="bg-slate-900/50 border border-white/5 p-8 rounded-sm">
                            <h3 class="text-xs font-bold uppercase tracking-widest text-purple-500 mb-6 italic">Mon Profil</h3>
                            <div class="space-y-4">
                                <input type="text" name="name" value="{{ Auth::user()->name }}" class="w-full bg-slate-950 border border-white/10 p-4 text-white outline-none focus:border-purple-500 transition-all">
                                <input type="email" name="email" value="{{ Auth::user()->email }}" class="w-full bg-slate-950 border border-white/10 p-4 text-slate-400 outline-none focus:border-purple-500 transition-all">
                            </div>
                        </div>

                        <button type="submit" class="w-full py-4 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase tracking-widest text-xs transition-all">
                            Sauvegarder tout
                        </button>
                    </div>

                    <div class="bg-slate-900/50 border border-white/5 p-6 rounded-sm h-fit">
                        <div class="flex items-center justify-between mb-4">
                            <span class="text-[10px] font-bold uppercase text-purple-400 tracking-widest">Mes Jeux</span>
                            <button type="button" onclick="openModal()" class="text-[10px] bg-white/5 border border-white/10 px-2 py-1 text-white hover:bg-purple-600 transition-all italic">
                                + Ajouter
                            </button>
                        </div>
                        <div class="space-y-2">
                            @foreach(Auth::user()->games as $game)
                                <div class="text-[9px] text-slate-400 uppercase bg-slate-950/50 p-2 border border-white/5 italic">
                                    {{ $game->name }}
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div id="gameModal" class="fixed inset-0 z-[100] hidden items-center justify-center p-6 bg-black/90 backdrop-blur-sm">
                    
                    <div class="bg-slate-900 border border-white/10 w-full max-w-lg p-6 rounded-sm shadow-2xl relative">
                        <div class="flex justify-between items-center mb-6 border-b border-white/5 pb-2">
                            <h2 class="text-white font-bold uppercase italic tracking-widest">Choisir vos Jeux</h2>
                            <button type="button" onclick="closeModal()" class="text-slate-500 hover:text-white text-2xl leading-none">&times;</button>
                        </div>

                        <div class="grid grid-cols-2 gap-3 max-h-80 overflow-y-auto pr-2">
                            @foreach($games as $game)
                                <label class="relative cursor-pointer">
                                    <input type="checkbox" name="games[]" value="{{ $game->id }}" class="peer hidden"
                                        {{ Auth::user()->games->contains($game->id) ? 'checked' : '' }}>
                                    
                                    <div class="relative aspect-video rounded-sm overflow-hidden border-2 border-white/5 peer-checked:border-purple-600 transition-all">
                                        <img src="{{ $game->image }}" class="w-full h-full object-cover opacity-40 peer-checked:opacity-100">
                                        <span class="absolute bottom-1 left-2 text-[8px] font-bold uppercase text-white bg-black/50 px-1">{{ $game->name }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>

                        <button type="button" onclick="closeModal()" class="mt-6 w-full py-3 bg-purple-600 text-white font-bold uppercase tracking-widest text-[10px]">
                            Confirmer la sélection
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <script>
    function openModal() {
        const modal = document.getElementById('gameModal');
        if(modal) {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }
    }

    function closeModal() {
        const modal = document.getElementById('gameModal');
        if(modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }

    window.onclick = function(event) {
        const modal = document.getElementById('gameModal');
        if (event.target == modal) {
            closeModal();
        }
    }
</script>
</x-layouts.app>