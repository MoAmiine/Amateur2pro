<x-layouts.app title="Team Details | Amateur2Pro">

    <div class="max-w-6xl mx-auto px-6 pt-28 pb-20">

        <a href="{{ route('teams.index') }}" class="text-slate-400 hover:text-white transition text-sm">
            ← Back to Teams
        </a>

        {{-- HEADER --}}
        <div class="mt-6 bg-slate-900/40 border border-white/10 p-8 rounded-xl">

            <div class="flex items-center gap-6">

                <div
                    class="w-20 h-20 rounded-full bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center text-2xl font-bold">
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
                        Game:
                        <span class="text-purple-400 font-semibold">
                            {{ $team->game->name}}
                        </span>
                    </p>

                    <p class="text-slate-400 text-sm mt-1">
                        {{ $team->users->where('pivot.is_member', true)->count() }} Players
                    </p>

                </div>

                {{-- ACTIONS (CAPTAIN ONLY) --}}
                @auth
                    @if (auth()->id() === $team->captain_id)
                        <div class="flex gap-2">

                            <a href="{{ route('teams.edit', $team) }}"
                                class="px-4 py-2 bg-purple-600 hover:bg-purple-500 text-white text-xs uppercase font-bold rounded-lg">
                                Edit
                            </a>

                            <form method="POST" action="{{ route('teams.destroy') }}" onsubmit="return confirm('Remove this team ?')">
                                @csrf
                                @method('DELETE')

                                <button
                                    class="px-4 py-2 bg-red-600 hover:bg-red-500 text-white text-xs uppercase font-bold rounded-lg">
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

        {{-- MEMBERS (ACCEPTED ONLY) --}}
        <div class="mt-6 bg-slate-900/30 border border-white/10 p-6 rounded-xl">

            <h2 class="font-bold mb-4">Members</h2>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                @forelse ($team->users->where('pivot.is_member', true) as $user)
                    <div class="bg-slate-800/40 border border-white/10 p-4 rounded-lg flex items-center gap-3">

                        <div class="w-10 h-10 rounded-full bg-slate-700 flex items-center justify-center font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>

                        <div class="flex-1">
                            <p class="font-semibold">{{ $user->name }}</p>

                            @if ($user->id === $team->captain_id)
                                <p class="text-xs text-yellow-500">Captain</p>
                            @endif
                        </div>

                        {{-- KICK (CAPTAIN ONLY) --}}
                        @if (auth()->id() === $team->captain_id && $user->id !== $team->captain_id)
                            <form method="POST" action="{{ route('teams.members.remove', [$team, $user]) }}"
                                onsubmit="return confirm('Remove this member?')">

                                @csrf
                                @method('DELETE')

                                <button
                                    class="px-2 py-1 bg-red-600 hover:bg-red-500 text-white text-[10px] uppercase rounded">
                                    Kick
                                </button>

                            </form>
                        @endif

                    </div>

                @empty
                    <p class="text-slate-400">No members yet.</p>
                @endforelse

            </div>
        </div>

        {{-- 💌 INVITE BY EMAIL --}}
        @auth
            @if (auth()->id() === $team->captain_id)
                <div class="mt-6 bg-slate-900/30 border border-white/10 p-6 rounded-xl">

                    <h2 class="font-bold mb-4">Invite Player by Email</h2>

                    <form method="POST" action="{{ route('teams.invite', $team->id) }}" class="flex gap-3">

                        @csrf

                        <input type="email" name="email" placeholder="Enter player email..."
                            class="flex-1 bg-slate-950 border border-white/10 p-3 text-white rounded-lg focus:border-purple-500 outline-none">

                        <button
                            class="px-6 py-3 bg-purple-600 hover:bg-purple-500 text-white font-bold uppercase text-xs rounded-lg">
                            Invite
                        </button>

                    </form>

                </div>
            @endif
        @endauth

        {{-- 🟡 PENDING REQUESTS (CAPTAIN ONLY) --}}
        @auth
            @if (auth()->id() === $team->captain_id)
                <div class="mt-6 bg-slate-900/30 border border-white/10 p-6 rounded-xl">

                    <h2 class="font-bold mb-4 text-yellow-400">Pending Requests</h2>

                    @forelse ($team->users->where('pivot.is_member', false) as $user)
                        <div class="flex items-center justify-between bg-slate-800/40 p-3 rounded-lg mb-2">

                            <div>
                                <p class="font-semibold">{{ $user->name }}</p>
                                <p class="text-xs text-yellow-400">Waiting approval</p>
                            </div>

                            <form method="POST" action="{{ route('teams.members.accept', [$team, $user]) }}">

                                @csrf
                                @method('PATCH')

                                <button class="px-3 py-1 bg-green-600 hover:bg-green-500 text-xs uppercase rounded">
                                    Accept
                                </button>

                            </form>

                        </div>

                    @empty
                        <p class="text-slate-400">No pending requests.</p>
                    @endforelse

                </div>
            @endif
        @endauth

        {{-- JOIN BUTTON --}}
        <div class="mt-6 flex gap-3">

            @auth

                @php
                    $membership = $team->users->where('id', auth()->id())->first();
                @endphp

                @if (!$membership)
                    <form method="POST" action="{{ route('teams.join', $team) }}">
                        @csrf

                        <button class="px-5 py-2 bg-white text-black font-bold rounded-lg hover:bg-slate-200">
                            Join Team
                        </button>
                    </form>
                @else
                    @if ($membership->pivot->is_member == false)
                        <button disabled class="px-5 py-2 bg-yellow-600 text-black rounded-lg">
                            Pending Approval
                        </button>
                    @else
                        <form method="POST" action="{{ route('teams.leave', $team) }}">
                            @csrf
                            @method('DELETE')

                            <button class="px-5 py-2 bg-red-600 text-white font-bold rounded-lg hover:bg-red-500">
                                Quit Team
                            </button>
                        </form>
                    @endif
                @endif

            @endauth

        </div>

    </div>

</x-layouts.app>
