@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <ul class="navbar-nav mr-auto">
                        @foreach ($nav->getItems() as $item)
                            <li class="nav-item{{ $item->isActive() ? ' active' : '' }}">
                                <a class="nav-link" href="{{ route($item->getRoute()) }}">
                                    {{ $item->getName() }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </nav>
            </div>
        </div>
    </div>
@endsection
