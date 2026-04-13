<h2>You are invited to join a team</h2>

<p>
You have been invited to join 
<strong>{{ $invitation->team->name }}</strong>
</p>

<a href="{{ route('teams.accept',$invitation->token) }}">
Join Team
</a>