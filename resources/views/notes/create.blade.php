@extends('layout')
@section('body')
<h1>New note</h1>

<form action="{{route('notes.store')}}" method="POST"  enctype="multipart/form-data">
    @include('notes._form', ['button_name' => 'Create'])
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