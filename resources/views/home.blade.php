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
                    <h2>Timer entries</h2>
                    <table class="table">
                        <tr>
                            <th>Start time</th>
                            <th>End time</th>
                            <th>Description</th>
                        </tr>
                        @foreach ($entries as $entry)
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
