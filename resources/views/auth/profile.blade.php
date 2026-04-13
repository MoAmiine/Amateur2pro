<x-layouts.app>

<div class="min-h-screen pt-32 pb-12 px-6">

<div class="max-w-6xl mx-auto">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- LEFT --}}
        <div class="lg:col-span-2 space-y-6">

            {{-- USER INFO --}}
            <div class="bg-slate-900/50 border border-white/5 p-8 rounded-sm">

                <h3 class="text-xs font-bold uppercase tracking-widest text-purple-500 mb-6 italic">
                    Informations Utilisateur
                </h3>

                <div class="grid grid-cols-2 gap-6 text-sm">

                    <div>
                        <p class="text-slate-400 text-[10px] uppercase">Nom</p>
                        <p class="text-white font-bold">{{ Auth::user()->name }}</p>
                    </div>

                    <div>
                        <p class="text-slate-400 text-[10px] uppercase">Email</p>
                        <p class="text-white font-bold">{{ Auth::user()->email }}</p>
                    </div>

                    <div>
                        <p class="text-slate-400 text-[10px] uppercase">Membre depuis</p>
                        <p class="text-white font-bold">
                            {{ Auth::user()->created_at->format('d M Y') }}
                        </p>
                    </div>

                    <div>
                        <p class="text-slate-400 text-[10px] uppercase">Statut</p>
                        <p class="text-purple-500 font-bold">Utilisateur</p>
                    </div>

                </div>
            </div>

            {{-- STATS --}}
            <div class="grid grid-cols-3 gap-4">

                <div class="bg-slate-900/50 border border-white/5 p-4 text-center">
                    <p class="text-purple-500 text-xl font-bold">
                        {{ Auth::user()->games()->count() }}
                    </p>
                    <p class="text-[9px] uppercase text-slate-400">Jeux</p>
                </div>

                <div class="bg-slate-900/50 border border-white/5 p-4 text-center">
                    <p class="text-purple-500 text-xl font-bold">
                        {{ Auth::user()->teams()->count() }}
                    </p>
                    <p class="text-[9px] uppercase text-slate-400">Equipes</p>
                </div>

                <div class="bg-slate-900/50 border border-white/5 p-4 text-center">
                    <p class="text-purple-500 text-xl font-bold">
                        {{ Auth::user()->tournaments()->count() }}
                    </p>
                    <p class="text-[9px] uppercase text-slate-400">Tournois</p>
                </div>

            </div>

            {{-- EDIT PROFILE --}}
            <div class="bg-slate-900/50 border border-white/5 p-8 rounded-sm">

                <h3 class="text-xs font-bold uppercase tracking-widest text-purple-500 mb-6 italic">
                    Modifier Profil
                </h3>

                <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                    @csrf

                    <input type="text"
                           name="name"
                           value="{{ Auth::user()->name }}"
                           class="w-full bg-slate-950 border border-white/10 p-4 text-white focus:border-purple-500 outline-none">

                    <input type="email"
                           name="email"
                           value="{{ Auth::user()->email }}"
                           class="w-full bg-slate-950 border border-white/10 p-4 text-white focus:border-purple-500 outline-none">

                    <button class="w-full py-4 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase text-xs">
                        Sauvegarder
                    </button>

                </form>

                {{-- 🚪 LOGOUT --}}
                <form method="POST" action="{{ route('logout') }}" class="mt-4">
                    @csrf

                    <button type="submit"
                            class="w-full py-4 bg-red-600 hover:bg-red-500 text-white font-bold uppercase text-xs transition">
                        Se déconnecter
                    </button>
                </form>

            </div>

        </div>

        {{-- RIGHT SIDE --}}
        <div class="bg-slate-900/50 border border-white/5 p-6 rounded-sm h-fit">

            <div class="flex justify-between mb-4">
                <span class="text-[10px] uppercase text-purple-400">
                    Mes Jeux
                </span>

                <button type="button"
                        onclick="openModal()"
                        class="text-[10px] bg-white/5 px-2 py-1 hover:bg-purple-600">
                    + Ajouter
                </button>
            </div>

            <div class="space-y-3">

                @foreach(Auth::user()->games as $game)

                    <div class="flex items-center gap-3 bg-slate-950 p-2 border border-white/5">

                        <img src="{{ $game->image }}"
                             class="w-12 h-8 object-cover rounded">

                        <span class="text-[10px] text-white uppercase">
                            {{ $game->name }}
                        </span>

                    </div>

                @endforeach

            </div>

        </div>

    </div>

</div>
</div>

{{-- MODAL --}}
<div id="gameModal" class="fixed inset-0 hidden items-center justify-center bg-black/80 z-50">

<div class="bg-slate-900 p-6 w-full max-w-lg border border-white/10">

    <h2 class="text-white mb-4 uppercase text-xs">
        Choisir vos jeux
    </h2>

    <form action="{{ route('profile.update') }}" method="POST">
        @csrf

        <div class="grid grid-cols-2 gap-4 max-h-80 overflow-y-auto">

            @foreach($games as $game)

                <label class="cursor-pointer">

                    <input type="checkbox"
                           name="games[]"
                           value="{{ $game->id }}"
                           class="hidden peer"
                           {{ Auth::user()->games->contains($game->id) ? 'checked' : '' }}>

                    <div class="border border-white/10 peer-checked:border-purple-600">

                        <img src="{{ $game->image }}"
                             class="w-full h-24 object-cover">

                        <p class="text-white text-[10px] p-2">
                            {{ $game->name }}
                        </p>

                    </div>

                </label>

            @endforeach

        </div>

        <button class="mt-4 w-full bg-purple-600 py-3 text-white uppercase text-xs">
            Confirmer
        </button>

    </form>

    <button type="button"
            onclick="closeModal()"
            class="mt-2 w-full bg-slate-700 py-2 text-white uppercase text-xs">
        Fermer
    </button>

</div>

</div>

<script>
function openModal(){
    document.getElementById('gameModal').style.display = "flex"
}

function closeModal(){
    document.getElementById('gameModal').style.display = "none"
}
</script>

</x-layouts.app>