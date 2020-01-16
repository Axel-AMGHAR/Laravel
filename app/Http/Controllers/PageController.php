<?php

namespace App\Http\Controllers;

use App\Developper;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function  hello(){
        echo 'hello world';
    }
    public function games(){

        $games = Game::get();

        return view('pages.game', [
            'games' => $games
        ]);
    }

    public function devs(){

        $developpers = Developper::with('games.platforms')
            ->has('games')
            ->get();

        return view('pages.developper', [
            'developpers' => $developpers
        ]);
    }
}
