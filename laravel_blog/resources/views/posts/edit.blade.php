@extends('demo.layout')

@section('content')

<form method="POST" action="{{ route('posts.update', [
    'post' => $post
]) }}">
    @csrf
    @method('PATCH')

    <h1>{{ $post -> title }} szerkesztése</h1>
    Cím: <input type="text" name="title" value="{{ old('title', $post -> title) }}"><br>

    @error('title')
    {{ $message }}
    @enderror

    Tartalom:<br>
    <textarea name="content">{{ old('content', $post -> content) }} </textarea><br>
    Szerző:
    <select name="author_id">
        @foreach ($users as $u)
        <option value="{{ $u -> id }}"
            {{ old('author_id', $post -> author_id) === $u -> id ? 'selected' : ''}}
        >{{ $u -> name }}</option>
        @endforeach
    </select><br>

    Címkék:<br>
    @foreach ($tags as $t)
        <input type="checkbox" name="tags[]" value="{{ $t -> id }}"> {{ $t -> name}}<br>
    @endforeach
    <button type="submit">Küldés</button>
</form>

@endsection
