@extends('layout')
@section('body')
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
        <tr>
            <td>
                <input type="checkbox">
                {{rand(0,9)}}
            </td>
            <td>
                {{str_random(50)}}
            </td>
            <td>
                john@example.com
            </td>
            {{--Actions--}}
            <td style="width: 10%">
                <button class="btn btn-danger" data-toggle="tooltip" title="Drop note" data-placement="bottom">
                    <span class="glyphicon glyphicon-trash"></span>
                </button>
                <button class="btn btn-primary" data-toggle="tooltip" title="Edit note" data-placement="bottom">
                    <span class="glyphicon glyphicon-pencil"></span>
                </button>
            </td>
        </tr>
        </tbody>
    </table>
@endsection