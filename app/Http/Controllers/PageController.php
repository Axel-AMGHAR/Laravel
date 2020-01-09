<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PageController extends Controller
{
    public function games(){

        $games = DB::table('games')->get();

        return view('pages.hello', [
            'games' => $games
        ]);
    }
}
