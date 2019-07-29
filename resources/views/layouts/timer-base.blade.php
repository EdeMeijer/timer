@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav mr-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('home') }}">Timer</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tags') }}">Tags</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
