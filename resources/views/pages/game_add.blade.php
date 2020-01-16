@extends('layout.app')

@section('titre',' Ajout d\'un jeu')

@section('content')

    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto ">

        <h1>Ajout d'un jeu :</h1>
        <form action="{{ route('game_add_post') }}" method="post">
            @csrf
            <label for="">Game</label>
            @if($errors->has('name'))
                <input type="text" name="name" placeholder="{{ $errors->first('name') }}" class="form-control is-invalid">
            @else
                <input type="text" name="name" value="{{ old('name', 'test') }}" class="form-control">
            @endif

            <label for="">Developpeur</label>
            <select name="developper_id" class="form-control" >
                @foreach($developpers as $developper)
                    <option value="{{ $developper->id }}"
                            @if(old('developper_id') == $developper->id) selected @endif>
                        {{ $developper->name }}
                    </option>
                @endforeach
            </select>
            @if($errors->has('developper_id'))
                <div>{{$errors->first('name')}}</div>
            @endif

            <label for="">PEGI :</label>

            @if($errors->has('pegi'))
                <input type="text" name="pegi"  placeholder="{{$errors->first('pegi')}}" class="form-control is-invalid">
            @else
                <input type="text" name="pegi" value="{{ old('pegi')}}"  class="form-control">
            @endif

            <label for="">Sortie physique
                <input type="checkbox" name="physical_release" @if (old('physical_release')) checked @endif />
                <div>{{old('physical_release')}}</div>
            </label><br>
            <input type="submit" value="save" class="btn btn-primary">

        </form>
    </div>

@endsection
