<table class="table">
    <tr>
        <th>Suggestion Name</th>
        <th>Votes</th>
        <th>Submitted By</th>
        <th>Actions</th>
    </tr>
    @foreach($suggestions as $Suggestion)
        <tr>{{$Suggestion->name}}</tr>
        <tr>{{$Suggestion->getVotes()}}</tr>
        <tr>{{$Suggestion->getSubmitter()}}</tr>
        <tr><a href="#">View</a></tr>
    @endforeach
</table>
