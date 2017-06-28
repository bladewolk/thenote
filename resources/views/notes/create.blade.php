@extends('layout')
@section('body')
<h1>New note</h1>

<form action="{{route('notes.store')}}" method="POST">
    @include('notes._form', ['button_name' => 'Create'])
</form>

@endsection