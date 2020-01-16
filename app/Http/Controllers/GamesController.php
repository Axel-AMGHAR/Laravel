<?php

namespace App\Http\Controllers;
use App\Developper;
use App\Game;
use Illuminate\Http\Request;

class GamesController extends Controller
{
    public function getGame($game_id){
        $game = Game::where('id', $game_id)->first();

        return view('pages.game_details', [
            'game' => $game
        ]);
    }

    public function addGame(){
        return view('pages.game_add', [
            'developpers' => Developper::get()
        ]);
    }

    public function postAddGame(Request $request){

        $this->validate($request, [
            'name' => 'required',
            'pegi' => 'numeric',
            'physical_release' => 'boolean',
            'developper_id' => 'required|exists:developpers,id'
        ]);
        $game = new Game();
        $game->name = $request->input('name');
        $game->pegi = $request->input('pegi');
        $game->developper_id = $request->input('developper_id');
        $game->physical_release = $request->filled('physical_release');

        $game->save();

        return redirect()->back();
    }
}
