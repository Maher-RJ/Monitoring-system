<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class SoilHt extends Model
{
   protected $table = 'soil_ht';

    public function node()
    {
        return $this->belongsTo('App\Node','node_id');
    }
}
