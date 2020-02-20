<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class WeatherHt extends Model
{
   protected $table = 'weather_ht';

    public function node()
    {
        return $this->belongsTo('App\Node','node_id');
    }
}
