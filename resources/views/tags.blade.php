@extends('layouts.timer-base')

@section('content')
@parent

<div class="container">
    <div class="row">
        <div class="col-md-12">
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
                        @forelse ($tags as $tag)
                            <tr>
                                <td>
                                    <span class="multiselect__tag display">
                                        {{ $tag->description }}
                                    </span>
                                </td>
                                <td>{{ date('d-m-Y H:i:s', strtotime($tag->created_at)) }}</td>
                                <td>
                                    <form method="POST" action="{{ route('tag.delete', $tag->id) }}">
                                        @csrf
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="submit" value="Delete" class="btn btn-outline-danger btn-sm">
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">
                                    <em>No tags found</em>
                                </td>
                            </tr>
                        @endforelse
                    </table>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('tag.create') }}">
                        @csrf
                        <input type="text" name="description" placeholder="Tag description" class="form-control"
                               required pattern=".*[^ ].*">
                        <br>
                        <input type="submit" value="Create new tag" class="btn btn-primary">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
