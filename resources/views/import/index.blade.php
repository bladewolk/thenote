@extends('layout')
@section('body')
    <form action="{{ route('import.store') }}">
        <div class="form-group">
            <label class="btn btn-primary" for="my-file-selector">
                <input id="my-file-selector" type="file" style="display:none;">
                File to import
            </label>
        </div>

        <button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Import">
            <span class="glyphicon glyphicon-import"></span>
        </button>
    </form>


@endsection