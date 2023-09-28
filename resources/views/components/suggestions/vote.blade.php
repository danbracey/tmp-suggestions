@if(Auth::check() && $suggestion->getSubmitter->id !== Auth::user()->id)
    @if(!\App\Models\SuggestionVote::where('suggestion_id', $suggestion->id)->where('user_id', Auth::user()->id)->first())
        <a href="{{route('suggestion.vote.up', $suggestion->id)}}" class="btn btn-pill btn-success">&uarr;</a>
        <a href="{{route('suggestion.vote.down', $suggestion->id)}}" class="btn btn-pill btn-danger">&darr;</a>
    @else
        <a href="{{route('suggestion.vote.remove', $suggestion->id)}}" class="btn btn-pill btn-secondary">Remove Vote</a>
    @endif
@endif

