<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class WindSpeed extends Model
{
   protected $table = 'wind_speed';

    public function node()
    {
        return $this->belongsTo('App\Node','node_id');
    }
}
