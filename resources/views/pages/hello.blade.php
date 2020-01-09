@extends('layout.app')

@section('titre',' Mon titre !')

@section('content')

<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto ">
    <h1>Games : </h1>
    <div>
        @foreach($games as $game)
            <li>{{$game->name}}</li>
        @endforeach
    </div>
</div>

@endsection
