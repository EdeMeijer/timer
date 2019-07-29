@extends('layouts.timer-base')

@section('head')
    @parent

    <script type="application/json" id="tags-data">{!! json_encode($tagJsonData) !!}</script>
@endsection

@section('content')
    @parent

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Timer</div>

                    @if (session('status'))
                        <div class="card-body">
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        </div>
                    @endif

                    <div class="card-body">
                        <h2>Current entry</h2>

                        @if ($current === null)
                            <p>
                                No active entry. Start a new one!
                            </p>
                            <form method="POST" action="{{ route('entry.create') }}">
                                @csrf
                                <input class="form-control" type="text" name="description" placeholder="Description">
                                <br>
                                <tags></tags>
                                <br>
                                <input type="submit" value="Start new entry" class="btn btn-success">
                            </form>
                        @else
                            <table class="table">
                                <tr>
                                    <th>Started at</th>
                                    <th>Description</th>
                                    <th>Tags</th>
                                </tr>
                                <tr>
                                    <td>
                                        {{ date('d-m-Y H:i:s', strtotime($current->start_date)) }}
                                    </td>
                                    <td>
                                        {{ $current->description }}
                                    </td>
                                    <td>
                                        @foreach ($current->tags as $tag)
                                            <span class="multiselect__tag display">{{ $tag->description }}</span>
                                        @endforeach
                                    </td>
                                </tr>
                            </table>
                            <form method="POST" action="{{ route('entry.stopCurrent') }}">
                                @csrf
                                <input type="submit" value="Stop tracking" class="btn btn-danger">
                            </form>
                        @endif
                    </div>
                    <div class="card-body">
                        <h2>History</h2>

                        <table class="table">
                            <tr>
                                <th>Start time</th>
                                <th>End time</th>
                                <th>Description</th>
                                <th>Tags</th>
                                <th></th>
                            </tr>
                            @forelse ($history as $entry)
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
                                    <td>
                                        @foreach ($entry->tags as $tag)
                                            <span class="multiselect__tag display">{{ $tag->description }}</span>
                                        @endforeach
                                    </td>
                                    <td>
                                        <form method="POST" action="{{ route('entry.delete', $entry->id) }}">
                                            @csrf
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="submit" value="Delete" class="btn btn-outline-danger btn-sm">
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">
                                        <em>No entries found</em>
                                    </td>
                                </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
