<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Light extends Model
{
   protected $table = 'light';

    public function nodes()
    {
        return $this->belongsTo(Node::class,'node_id');
    }
}
