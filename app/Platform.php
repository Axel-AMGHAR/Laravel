<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    public function games(){
        return $this->belongsToMany(Game::class);
    }
}
