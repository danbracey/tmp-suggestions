@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center mb-lg-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Top Suggestions</div>
                    <div class="card-body">
                        <x-tables.suggestions :suggestions="$Suggestions ?? []"></x-tables.suggestions>
                    </div>
                </div>
            </div>
        </div>
        @auth
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My Suggestions <a href="{{route('suggestion.create')}}" class="btn btn-sm btn-success">&plus; Add New</a></div>
                    <div class="card-body">
                        <x-tables.suggestions :suggestions="$MySuggestions ?? []"></x-tables.suggestions>
                    </div>
                </div>
            </div>
        </div>
        @endauth
    </div>
@endsection
