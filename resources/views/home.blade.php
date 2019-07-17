@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                </div>

                {{--<example-component></example-component>--}}
                <div class="card-body">
                    <h2>
                        Current entry
                    </h2>

                    @if ($current === null)
                        <p>
                            No active entry. Start a new one!
                        </p>
                        <form method="POST" action="{{ route('entry.create') }}">
                            @csrf
                            <input type="text" name="description" placeholder="Describe it">
                            <input type="submit" value="Start new entry">
                        </form>
                    @else
                        <table class="table">
                            <tr>
                                <th>Started at</th>
                                <th>Description</th>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    {{ date('d-m-Y H:i:s', strtotime($current->start_date)) }}
                                </td>
                                <td>
                                    {{ $current->description }}
                                </td>
                                <td>
                                    <form method="POST" action="{{ route('entry.stopCurrent') }}">
                                        @csrf
                                        <input type="submit" value="Stop tracking">
                                    </form>
                                </td>
                            </tr>
                        </table>
                    @endif
                </div>
                <div class="card-body">
                    <h2>History</h2>
                    <table class="table">
                        <tr>
                            <th>Start time</th>
                            <th>End time</th>
                            <th>Description</th>
                        </tr>
                        @foreach ($history as $entry)
                            <tr>
                                <td>
                                    {{ date('d-m-Y H:i:s', strtotime($entry->start_date)) }}
                                </td>
                                <td>
                                    @if ($entry->end_date === null)
                                        N/A
                                    @else
                                        {{ date('d-m-Y H:i:s', strtotime($entry->end_date)) }}
                                    @endif
                                </td>
                                <td>
                                    {{ $entry->description }}
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
