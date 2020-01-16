@extends('layout.app')
@section('titre',' Mon titre !')
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto ">
        <h1>Developpers : </h1>
        <div>
            @foreach($developpers as $deveopper)
                <li>
                    Jeux développés par {{$deveopper->name}} :
                    <ul>
                        @foreach($deveopper->games as $game)
                        <li>{{ $game->name }} dispo sur
                            {{ $game->platforms->pluck('name')->implode(', ') }}
                        </li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </div>
    </div>
@endsection

