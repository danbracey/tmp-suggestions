<table class="table">
    <tr>
        <th>Suggestion Name</th>
        <th>Votes</th>
        <th>Status</th>
        <th>Submitted By</th>
        <th>Actions</th>
    </tr>
    @foreach($suggestions as $Suggestion)
        <tr>
            <td>{{$Suggestion->name}}</td>
            <td>{{$Suggestion->getVotes()->sum('vote')}}</td>
            @switch($Suggestion->status)
                @case(1)
                    <td>Open</td>
                @break
                @case(2)
                    <td><span style="color: green; font-weight: bolder">Approved</span></td>
                @break
                @case(3)
                    <td><span style="color: red; font-weight: bolder">Denied</span></td>
                @break
            @endswitch
            <td>{{$Suggestion->getSubmitter->name}}</td>
            <td>
                <a href="{{route('suggestion.show', $Suggestion->id)}}" class="btn btn-pill btn-info">&#128269;</a>
                @auth
                <x-suggestions.vote :suggestion="$Suggestion"/>
                @endauth
            </td>
        </tr>
    @endforeach
</table>
