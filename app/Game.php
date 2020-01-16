<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    public function developper(){
        return $this->belongsTo(Developper::class);
    }

    public function platforms(){
        return $this->belongsToMany(Platform::class);
    }
}
