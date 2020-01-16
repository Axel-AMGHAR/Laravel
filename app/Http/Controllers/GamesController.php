<?php

namespace App\Http\Controllers;
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
}
