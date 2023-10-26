@extends('demo.layout')

@section('content')

@if (Session::has('post-created'))
    <span class="text-lg text-green-500">Bejegyzés létrehozva!</span>
@endif

@if (Session::has('post-updated'))
    <span class="text-lg text-green-500">Bejegyzés módosítva!</span>
@endif

<ul>
@foreach ($posts as $p)
    <li>{{ $p -> title }} ({{ $p -> user -> name }})</li>
@endforeach
</ul>
@endsection
