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
        </tr>
    @endforeach
</table>
