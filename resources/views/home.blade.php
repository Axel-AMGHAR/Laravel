@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Dashboard</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        @auth
                            je suis co {{ Auth::user() }}
                            {{ Auth::user()->name }}
                        @elseauth
                            je suis pas co
                        @endauth
                        @if (Auth::user()->role == 1)
                            <br/> vous etes un client
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
