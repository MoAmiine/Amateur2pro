<x-layouts.app title="Team Details | Amateur2Pro">

<div class="max-w-6xl mx-auto px-6 pt-28 pb-20">

    <a href="{{ route('equipes.index') }}"
       class="text-slate-400 hover:text-white transition text-sm">
        ← Back to Teams
    </a>

    {{-- HEADER --}}
    <div class="mt-6 bg-slate-900/40 border border-white/10 p-8 rounded-xl">

        <div class="flex items-center gap-6">

            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center text-2xl font-bold">
                {{ strtoupper(substr($team->name, 0, 1)) }}
            </div>

            <div class="flex-1">

                <h1 class="text-4xl font-bold uppercase tracking-widest">
                    {{ $team->name }}
                </h1>

                <p class="text-purple-400 mt-1">
                    Captain:
                    <span class="text-white font-semibold">
                        {{ $team->captain?->name ?? 'No captain' }}
                    </span>
                </p>

                <p class="text-slate-400 text-sm mt-1">
                    {{ $team->users->count() }} / 5 Players
                </p>

            </div>

            @auth
                @if(auth()->user()->id === $team->captain_id)

                    <div class="flex gap-2">

                        <a href="#"
                           class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white text-xs uppercase font-bold transition rounded-lg">
                            Edit
                        </a>

                        <form method="POST" action="#">
                            @csrf
                            @method('DELETE')

                            <button class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-xs uppercase font-bold transition rounded-lg">
                                Delete
                            </button>
                        </form>

                    </div>

                @endif
            @endauth

        </div>
    </div>

    {{-- DESCRIPTION --}}
    <div class="mt-6 bg-slate-900/30 border border-white/10 p-6 rounded-xl">

        <h2 class="font-bold mb-2">About Team</h2>

        <p class="text-slate-400">
            {{ $team->description ?? 'No description available.' }}
        </p>

    </div>

    {{-- MEMBERS --}}
    <div class="mt-6 bg-slate-900/30 border border-white/10 p-6 rounded-xl">

        <h2 class="font-bold mb-4">Members</h2>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

            @forelse ($team->users as $user)

                <div class="bg-slate-800/40 border border-white/10 p-4 rounded-lg flex items-center gap-3">

                    <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center font-bold">
                        {{ strtoupper(substr($user->name, 0, 1)) }}
                    </div>

                    <div class="flex-1">
                        <p class="font-semibold">{{ $user->name }}</p>
                        <p class="text-xs text-slate-400">{{ $user->email }}</p>
                    </div>

                    @if(auth()->user()->id === $team->captain_id)

                        <form method="POST" action="#">
                            @csrf
                            @method('DELETE')

                            <button class="text-red-500 hover:text-red-400 text-xs">
                                Remove
                            </button>
                        </form>

                    @endif

                </div>

            @empty
                <p class="text-slate-400">No members yet.</p>
            @endforelse

        </div>
    </div>

    {{-- 💌 INVITE BY EMAIL (REPLACED ADD PLAYER BUTTON) --}}
    @auth
        @if(auth()->user()->id === $team->captain_id)

        <div class="mt-6 bg-slate-900/30 border border-white/10 p-6 rounded-xl">

            <h2 class="font-bold mb-4">Invite Player by Email</h2>

            {{-- SUCCESS / ERROR --}}
            @if(session('success'))
                <p class="text-green-400 mb-3">{{ session('success') }}</p>
            @endif

            @if(session('error'))
                <p class="text-red-400 mb-3">{{ session('error') }}</p>
            @endif

            {{-- FORM --}}
            <form method="POST" action="{{ route('teams.invite', $team->id) }}" class="flex gap-3">

                @csrf

                <input type="email"
                       name="email"
                       placeholder="Enter player email..."
                       class="flex-1 bg-slate-950 border border-white/10 p-3 text-white rounded-lg focus:border-purple-500 outline-none">

                <button class="px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase text-xs rounded-lg transition">
                    Invite
                </button>

            </form>

            <p class="text-xs text-slate-500 mt-2">
                The user will be directly added to the team if email exists.
            </p>

        </div>

        @endif
    @endauth

    {{-- JOIN BUTTON (NON CAPTAIN) --}}
    <div class="mt-6 flex gap-3">

        @auth

            @if(auth()->user()->id !== $team->captain_id)

                @if(!$team->users->contains(auth()->user()->id))

                    <form method="POST" action="#">
                        @csrf
                        <button class="px-5 py-2 bg-white text-black font-bold rounded-lg hover:bg-slate-200 transition">
                            Join Team
                        </button>
                    </form>

                @else

                    <button disabled class="px-5 py-2 bg-slate-700 text-slate-400 rounded-lg">
                        Already Member
                    </button>

                @endif

            @endif

        @endauth

    </div>

</div>

</x-layouts.app>