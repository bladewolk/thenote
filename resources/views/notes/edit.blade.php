@extends('layout')
@section('body')
    <h1>New note</h1>
    <form action="{{route('notes.update', $item->id)}}" method="POST"  enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @include('notes._form', ['button_name' => 'Update'])
    </form>
@endsection
@section('scripts')
    <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.css" rel="stylesheet">
    <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.4/summernote.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>
@endsection