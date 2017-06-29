@extends('layout')
@section('body')
    <h1>New note</h1>

    <form action="{{route('notes.update', $item->id)}}" method="POST"  enctype="multipart/form-data">
        {{ method_field('PATCH') }}
        @include('notes._form', ['button_name' => 'Update'])
    </form>

@endsection