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
            <td>{{$Suggestion->getVotes()->sum('vote')}}</td>
            <td>{{$Suggestion->getSubmitter->name}}</td>
            <td>
                <a href="{{route('suggestion.show', $Suggestion->id)}}" class="btn btn-pill btn-info">&#128269;</a>
                @auth
                    @if($Suggestion->getSubmitter->id !== Auth::user()->id)
                        {{-- Check that the suggestion hasn't already been voted on by this user --}}
                        @if(\App\Models\SuggestionVote::where('suggestion_id', $Suggestion->id)->where('user_id', Auth::user()->id))
                        <a href="{{route('suggestion.vote.up', $Suggestion->id)}}" class="btn btn-pill btn-success">&uarr;</a>
                        <a href="{{route('suggestion.vote.down', $Suggestion->id)}}" class="btn btn-pill btn-danger">&darr;</a>
                        @else
                        <i>You have already voted on this suggestion</i>
                        @endif
                    @endif
                    @can('manage suggestions')
                        <a href="{{route('suggestion.edit', $Suggestion->id)}}" class="btn btn-pill btn-warning">Edit</a>
                        <a href="{{route('suggestion.destroy', $Suggestion->id)}}" class="btn btn-pill btn-danger">Delete</a>
                    @endcan
                @endauth
            </td>
        </tr>
    @endforeach
</table>
