@extends('welcome')
@section('content')
    <form type="POST" action="/generate">
        <input type="text" name="name">
        <button type="submit">Click</button>
    </form>
@endsection
