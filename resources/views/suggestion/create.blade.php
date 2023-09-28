@extends('layouts.app')
@section('title', 'New Suggestion')
@section('content')
    <div class="container">
        <div class="row justify-content-center mb-lg-3">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Create new Suggestion</div>
                    <div class="card-body">
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

                        <form action="{{route('suggestion.store')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label style="width:100%"> Suggestion Name
                                    <input type="text" name="name" class="form-control">
                                </label>
                            </div>
                            <div class="form-group">
                                <label style="width:100%"> Short Description
                                    <textarea type="text" name="short_description" class="form-control"></textarea>
                                </label>
                            </div>
                            <div class="form-group">
                                <label style="width:100%"> Long Description
                                    <textarea type="text" name="long_description" class="form-control"></textarea>
                                </label>
                            </div>
                            <input type="submit" class="btn btn-primary">
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
