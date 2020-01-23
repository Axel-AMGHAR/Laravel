<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    // propriétés authorisées
/*    protected $fillable = ['name','developper_id','pegi','physical_release'];*/
    //propriétès bannies
    protected $guarded= ['id'];

    public function developper(){
        return $this->belongsTo(Developper::class);
    }

    public function platforms(){
        return $this->belongsToMany(Platform::class);
    }
}
