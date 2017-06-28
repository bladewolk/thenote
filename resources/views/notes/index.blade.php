@extends('layout')
@section('body')
    @if ($notes->total())
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th>Short Description</th>
                <th>Pictures</th>
                <th style="width: 10%">Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($notes as $note)
                <tr>
                    <td>
                        {{ $note->id }}
                    </td>
                    <td>
                        {{ $note->description }}
                    </td>
                    <td>
                        john@example.com
                    </td>
                    {{--Actions--}}
                    <td style="width: 10%">
                        <a href="{{ route('notes.edit', $note->id) }}" class="btn btn-primary" data-toggle="tooltip" title="Edit note" data-placement="bottom">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" style="display: inline-block">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-danger" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @else
    <h1>Empty</h1>
    @endif
@endsection