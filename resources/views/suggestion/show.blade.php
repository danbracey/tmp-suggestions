@extends('layouts.app')
@section('title', $Suggestion->name  ?? 'Unknown Suggestion')
@section('content')
    <div class="container">
        <div class="row justify-content-center mb-lg-3">
            <div class="col">
                <div class="card">
                    <div class="card-header"><strong>{{$Suggestion->name ?? 'Unknown Suggestion'}}</strong></div>
                    <div class="card-body">
                        <div class="card mb-3">
                            <div class="card-header"><strong>Short Description</strong></div>
                            <div class="card-body">
                                {{$Suggestion->short_description}}
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header"><strong>Long Description</strong></div>
                            <div class="card-body">
                                {{$Suggestion->long_description}}
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        Submitted by: {{$Suggestion->getSubmitter->name}} <br>
                        Submitted on: {{$Suggestion->created_at}} @if($Suggestion->modified_at) (Last Edited: {{$Suggestion->modified_at}}) @endif
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <div class="card-header">Manage Suggestion</div>
                    <div class="card-body">
                        <a href="{{route('suggestion.edit', $Suggestion->id)}}" class="btn btn-pill btn-warning">Edit</a>
                        <a href="{{route('suggestion.destroy', $Suggestion->id)}}" class="btn btn-pill btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
