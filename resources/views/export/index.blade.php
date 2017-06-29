@extends('layout')
@section('body')
    @if ($count)
    <form action="{{ route('export.do') }}" method="POST">
        {{ csrf_field() }}
        <span>File Type</span>
        <div class="form-group">
            <input id="format_one" type="radio" name="format" value="txt" checked>
            <label for="format_one">TXT</label>
            <input id="format_two" type="radio" name="format" value="xml">
            <label for="format_two">XML</label>
        </div>
        <div class="form-group">
            <button class="btn btn-success" data-toggle="tooltip" data-placement="bottom" title="Export">
                <span class="glyphicon glyphicon-export"></span>
            </button>
        </div>
    </form>
    @else
        <h1>Nothing to export</h1>
    @endif
@endsection