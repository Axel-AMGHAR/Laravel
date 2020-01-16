@extends('layout.app')

@section('titre',' Mon titre !')

@section('content')

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto ">
        <h1>{{ $game->name }} </h1>
        <div> dev by {{$game->developper->name}}</div>
        <div>Dispo sur {{ $game->platforms->pluck('name')->implode(', ')}}</div>
    </div>

@endsection
