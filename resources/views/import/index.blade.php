@extends('layout')
@section('body')
    <form action="{{ route('import.do') }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label class="btn btn-primary" for="my-file-selector">
                <input id="my-file-selector" type="file" style="display:none;" name="file">
                File: <span class="label label-danger">ZIP</span>
            </label>
        </div>

        <button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Import">
            <span class="glyphicon glyphicon-import"></span>
        </button>
    </form>
@endsection