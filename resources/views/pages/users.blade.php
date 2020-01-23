@extends('layout.app')

@section('titre',' Users !')

@section('content')

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto ">
        <h1>Users : </h1>
        <div>
            @foreach($users as $user)
                <li>{{$user->name}} dev by {{ $user->email}}</li>
            @endforeach

            {{$users->links()}}
        </div>
    </div>

@endsection
