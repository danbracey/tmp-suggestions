@extends('layouts.app')
@section('title', 'New Suggestion')
@section('content')
    <div class="container">
        <form action="{{route('suggestion.store')}}">
            <div class="form-group">
                <label> Suggestion Name
                    <input type="text" name="title" class="form-control">
                </label>
            </div>
            <div class="form-group">
                <label> Short Description
                    <textarea type="text" name="short_description" class="form-control"></textarea>
                </label>
            </div>
            <div class="form-group">
                <label> Long Description
                    <textarea type="text" name="long_description" class="form-control"></textarea>
                </label>
            </div>
            <input type="submit" class="btn btn-primary">
        </form>
    </div>

@endsection
