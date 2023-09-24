<table class="table">
    <tr>
        <th>Suggestion Name</th>
        <th>Votes</th>
        <th>Submitted By</th>
        <th>Actions</th>
    </tr>
    @foreach($suggestions as $Suggestion)
        <tr>
            <td>{{$Suggestion->name}}</td>
            <td>{{$Suggestion->getVotes()->count('vote')}}</td>
            <td>{{$Suggestion->getSubmitter->name}}</td>
            <td><a href="{{route('suggestion.show', $Suggestion->id)}}">View</a></td>
            @auth
                @if($Suggestion->getSubmitter->id !== Auth::user()->id)
                    {{-- Check that the suggestion hasn't already been voted on by this user --}}
                    @if(\App\Models\SuggestionVote::where('suggestion_id', $Suggestion->id)->where('user_id', Auth::user()->id))
                    <td><a href="{{route('suggestion.show', $Suggestion->id)}}">&uarr;</a></td>
                    <td><a href="{{route('suggestion.show', $Suggestion->id)}}">&darr;</a></td>
                    @else
                    <i>You have already voted on this suggestion</i>
                    @endif
                @endif
            @endauth
        </tr>
    @endforeach
</table>
