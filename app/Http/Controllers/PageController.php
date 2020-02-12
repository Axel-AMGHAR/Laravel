<?php

namespace App\Http\Controllers;

use App\Rights;
use App\User;
use App\Developper;
use App\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{

    public function test(){
        $user_id = User::select('id')->where('id', 103)->first();
        $permTab = ['del.structure', 'add.user'];
        $perm = 'add.uer';
        $role = 'responsable';
        echo 'Res : ' . json_encode(Rights::authCanAtLeast($permTab));
    }

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
        dd($developpers);
        return view('pages.developper', [
            'developpers' => $developpers
        ]);
    }

    public function users(){

        $users = User::get();
        return view('pages.users',[
            'users'=> $users,
        ]);
    }
    public function users_param($page = 1){

        $users = User::paginate(10);
        return view('pages.users',[
            'users'=> $users,
        ]);
    }
}
