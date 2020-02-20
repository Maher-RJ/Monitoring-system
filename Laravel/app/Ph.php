<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Ph extends Model
{
   protected $table = 'ph';

    public function node()
    {
        return $this->belongsTo('App\Node','node_id');
    }
}
