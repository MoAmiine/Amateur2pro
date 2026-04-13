<x-layouts.app>

<div class="min-h-screen pt-28 pb-16 px-6 bg-gradient-to-b from-slate-950 to-black">

<div class="max-w-7xl mx-auto">

{{-- HEADER PROFILE --}}
<div class="bg-gradient-to-r from-purple-600/20 to-blue-600/20 border border-white/10 p-8 rounded-2xl mb-8 backdrop-blur">

<div class="flex items-center justify-between">

<div class="flex items-center gap-6">

<div class="w-20 h-20 bg-gradient-to-br from-purple-500 to-blue-600 rounded-2xl flex items-center justify-center text-2xl font-bold">
{{ strtoupper(substr(Auth::user()->name,0,1)) }}
</div>

<div>
<h1 class="text-2xl font-bold text-white uppercase tracking-widest">
{{ Auth::user()->name }}
</h1>

<p class="text-slate-400 text-sm">
{{ Auth::user()->email }}
</p>

<p class="text-purple-400 text-xs uppercase tracking-widest mt-1">
Member since {{ Auth::user()->created_at->format('M Y') }}
</p>

</div>

</div>

<form method="POST" action="{{ route('logout') }}">
@csrf
<button class="px-6 py-3 bg-red-600 hover:bg-red-500 text-white text-xs uppercase font-bold rounded-xl transition">
Logout
</button>
</form>

</div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

{{-- LEFT --}}
<div class="lg:col-span-2 space-y-6">

{{-- STATS --}}
<div class="grid grid-cols-3 gap-6">

<div class="bg-slate-900/60 border border-white/10 p-6 rounded-2xl hover:border-purple-500 transition">
<p class="text-3xl font-bold text-purple-500">
{{ Auth::user()->games()->count() }}
</p>
<p class="text-xs uppercase text-slate-400 mt-2">Games</p>
</div>

<div class="bg-slate-900/60 border border-white/10 p-6 rounded-2xl hover:border-purple-500 transition">
<p class="text-3xl font-bold text-purple-500">
{{ Auth::user()->teams()->count() }}
</p>
<p class="text-xs uppercase text-slate-400 mt-2">Teams</p>
</div>

<div class="bg-slate-900/60 border border-white/10 p-6 rounded-2xl hover:border-purple-500 transition">
<p class="text-3xl font-bold text-purple-500">
{{ Auth::user()->tournaments()->count() }}
</p>
<p class="text-xs uppercase text-slate-400 mt-2">Tournaments</p>
</div>

</div>

{{-- EDIT PROFILE --}}
<div class="bg-slate-900/60 border border-white/10 p-8 rounded-2xl">

<h3 class="text-xs font-bold uppercase tracking-widest text-purple-500 mb-6">
Edit Profile
</h3>

<form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
@csrf

<input 
type="text"
name="name"
value="{{ Auth::user()->name }}"
class="w-full bg-slate-950 border border-white/10 p-4 text-white rounded-xl focus:border-purple-500 outline-none">

<input 
type="email"
name="email"
value="{{ Auth::user()->email }}"
class="w-full bg-slate-950 border border-white/10 p-4 text-white rounded-xl focus:border-purple-500 outline-none">

<button class="w-full py-4 bg-gradient-to-r from-purple-600 to-blue-600 hover:opacity-90 text-white font-bold uppercase text-xs rounded-xl">
Save Changes
</button>

</form>

</div>

</div>


{{-- RIGHT --}}
<div class="space-y-6">

{{-- GAMES --}}
<div class="bg-slate-900/60 border border-white/10 p-6 rounded-2xl">

<div class="flex justify-between items-center mb-6">

<h3 class="text-xs uppercase text-purple-400 font-bold">
My Games
</h3>

<button 
onclick="openModal()" 
class="px-3 py-1 bg-purple-600 hover:bg-purple-500 text-xs rounded-lg">
+ Add
</button>

</div>

<div class="space-y-3">

@foreach(Auth::user()->games as $game)

<div class="flex items-center gap-4 bg-slate-950 p-3 rounded-xl border border-white/5 hover:border-purple-500 transition">

<img 
src="{{ $game->image }}"
class="w-14 h-10 object-cover rounded">

<div>
<p class="text-white text-xs font-bold uppercase">
{{ $game->name }}
</p>

<p class="text-slate-400 text-[10px]">
Competitive Game
</p>
</div>

</div>

@endforeach

</div>

</div>

</div>

</div>

</div>

</div>


{{-- MODAL --}}
<div id="gameModal" class="fixed inset-0 hidden items-center justify-center bg-black/80 z-50">

<div class="bg-slate-900 p-6 w-full max-w-xl border border-white/10 rounded-2xl">

<h2 class="text-white mb-4 uppercase text-xs">
Choose your games
</h2>

<form action="{{ route('profile.games') }}" method="POST">
@csrf

<div class="grid grid-cols-2 gap-4 max-h-96 overflow-y-auto">

@foreach($games as $game)

<label class="cursor-pointer">

<input 
type="checkbox"
name="games[]"
value="{{ $game->id }}"
class="hidden peer"
{{ Auth::user()->games->contains($game->id) ? 'checked' : '' }}>

<div class="border border-white/10 peer-checked:border-purple-600 rounded-xl overflow-hidden hover:scale-105 transition">

<img 
src="{{ $game->image }}"
class="w-full h-28 object-cover">

<p class="text-white text-xs p-2 uppercase">
{{ $game->name }}
</p>

</div>

</label>

@endforeach

</div>

<button class="mt-4 w-full bg-gradient-to-r from-purple-600 to-blue-600 py-3 text-white uppercase text-xs rounded-xl">
Confirm
</button>

</form>

<button 
onclick="closeModal()" 
class="mt-2 w-full bg-slate-700 py-2 text-white uppercase text-xs rounded-xl">
Close
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