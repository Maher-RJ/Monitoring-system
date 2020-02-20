<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Node extends Model
{

    public function ph()
    {
        return $this->hasMany('App\Ph');
    }

    public function WindSpeed()
    {
        return $this->hasMany('App\WindSpeed');
    }

    public function WeatherHt()
    {
        return $this->hasMany('App\WeatherHt');
    }

    public function SoilHt()
    {
        return $this->hasMany('App\SoilHt');
    }

    public function Light()
    {
        return $this->hasMany(Light::class,'node_id');
    }
}
