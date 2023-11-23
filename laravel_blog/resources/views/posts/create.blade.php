@extends('demo.layout')

@section('content')

<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <h1>Új bejegyzés</h1>
    Cím: <input type="text" name="title" value="{{ old('title') }}"><br>

    @error('title')
    {{ $message }}
    @enderror

    Tartalom:<br>
    <textarea name="content">{{ old('content') }} </textarea><br>

    Címkék:<br>
    @foreach ($tags as $t)
        <input type="checkbox" name="tags[]" value="{{ $t -> id }}"> {{ $t -> name}}<br>
    @endforeach
    <button type="submit">Küldés</button>
</form>

@endsection
