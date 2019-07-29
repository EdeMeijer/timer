@extends('layouts.timer-base')

@section('content')
@parent

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tags</div>

                <div class="card-body">
                    <h2>All tags</h2>
                    <table class="table">
                        <tr>
                            <th>Tag</th>
                            <th>Create date</th>
                            <th></th>
                        </tr>
                        @foreach ($tags as $tag)
                            <tr>
                                <td>{{ $tag->description }}</td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($tag->created_at)) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('tag.delete', $tag->id) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Delete">
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tag.create') }}">
                        @csrf
                        <input type="text" name="description" placeholder="Tag description">
                        <input type="submit" value="Create new tag">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
