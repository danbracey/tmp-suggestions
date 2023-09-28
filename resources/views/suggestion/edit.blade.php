@extends('layouts.app')
@section('title', 'Updating: ' . $Suggestion->name)
@section('content')
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                Unable to create suggestion due to the following validation errors:
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{route('suggestion.update', $Suggestion)}}" method="post">
            @method("PUT")
            @csrf
            <div class="form-group">
                <label style="width:100%"> Suggestion Name
                    <input type="text" name="name" class="form-control" value="{{$Suggestion->name}}">
                </label>
            </div>
            <div class="form-group">
                <label style="width:100%"> Short Description
                    <textarea type="text" name="short_description" class="form-control">{{$Suggestion->short_description}}</textarea>
                </label>
            </div>
            <div class="form-group">
                <label style="width:100%"> Long Description
                    <textarea type="text" name="long_description" class="form-control">{{$Suggestion->long_description}}</textarea>
                </label>
            </div>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>

@endsection
