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

        $game = Game::create($request->all());


        //modifier des données

        /*
        $data = nouvelles donnees
        $game->fill($data);
        $game->save();
        */


        // Méthode longue sans mettre guarded dans le model
/*        $game = new Game();
        $game->name = $request->input('name');
        $game->pegi = $request->input('pegi');
        $game->developper_id = $request->input('developper_id');
        $game->physical_release = $request->filled('physical_release');

        $game->save();*/


/*        $developper = Developper::find($request->input('developper_id'));
        $game->developper()->associate($developper);*/

    /*
     *      relation n:n
     *      foreach ($game->platforms as $platform){
            $platform->pivot->
        }*/

        /*
         * $game->platforms()->sync([2,3]);
         * ajoute des platformes
         */
        return redirect()->back();
    }
}
