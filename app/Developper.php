<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Developper extends Model
{
    public function games(){
        return $this->hasMany(Game::class)->select('name');
    }
}
