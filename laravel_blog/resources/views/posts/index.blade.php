@extends('demo.layout')

@section('content')

@guest
    Szia, Vendég!
    <a href="{{ route('login') }}">Bejelentkezés</a>
@endguest

@auth
    Szia, {{ Auth::user() -> name }}!
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <a href="#"
        onclick="event.preventDefault(); this.parentElement.submit();"
        >Kijelentkezés</a>
    </form>
@endauth

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
