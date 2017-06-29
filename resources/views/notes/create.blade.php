@extends('layout')
@section('body')
<h1>New note</h1>

<form action="{{route('notes.store')}}" method="POST"  enctype="multipart/form-data">
    @include('notes._form', ['button_name' => 'Create'])
</form>

@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
@endsection