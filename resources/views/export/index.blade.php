@extends('layout')
@section('body')
    @if ($count)
    <form action="{{ route('export.store') }}" method="POST">
        {{ csrf_field() }}
        <span>File Type</span>
        <div class="form-group">
            <input type="radio" name="format" value="txt" checked>
            <span>TXT</span>
            <input type="radio" name="format" value="xml">
            <span>XML</span>
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